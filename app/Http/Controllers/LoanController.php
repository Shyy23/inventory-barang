<?php

namespace App\Http\Controllers;

use App\Models\ClassLoan;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Traits\Loggable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LoanController extends Controller
{
    use Loggable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // dd($request->all());
            // Validasi data
            $validated = $request->validate([
                'nisn' => 'required|exists:students,nisn',
                'item_id' => 'required|exists:items,item_id',
                'item_quantity' => [
                    'required',
                    'integer',
                    'min:1',
                    function ($attribute, $value, $fail) use ($request){
                        if($request->input('unit_id') && $value !== "1"){
                            $fail('Jumlah item harus 1 untuk peminjaman unit.');
                        }
                    }
                ],
                'loan_description' => 'nullable|string',
                'loan_type' => 'required|in:individu,kelas',
                'unit_id' => [
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('item_type') === 'unit';
                    }),
                    'exists:item_units,unit_id'
                ],
                'class_id' => [
                    'nullable', // Tidak wajib jika loan_type bukan kelas
                    Rule::requiredIf(function () use ($request) {
                        return $request->loan_type === 'kelas';
                    }),
                    'exists:classes,class_id'
                ],
                'subject_id' => [
                    'nullable', // Tidak wajib jika loan_type bukan kelas
                    Rule::requiredIf(function () use ($request) {
                        return $request->loan_type === 'kelas';
                    }),
                    'exists:subjects,subject_id'
                ]
            ],
            [
                'unit_id.required' => 'Unit harus dipilih ',
                'unit_id.exists' => 'Unit yang dipilih tidak valid.',
            ]);
        

            DB::beginTransaction();

            try {
                // Step 1: Simpan data ke tabel loans
                $loan = Loan::create([
                    'nisn' => $validated['nisn'],
                    'loan_type' => $validated['loan_type'],
                    'loan_status' => 'pending' // Sesuaikan dengan status awal yang diperlukan
                ]);

                $this->logLoanActivity(
                    $loan->loan_id,
                    'loan_created',
                    'info',
                    json_encode([
                        'type' => $validated['loan_type'],
                        'items' => [
                            'item_id' => $validated['item_id'],
                            'quantity' => $validated['item_quantity']
                        ]
                    ])
                );


                // Step 2: Simpan ke loan_details
                LoanDetail::create([
                    'loan_id' => $loan->loan_id,
                    'item_id' => $validated['item_id'],
                    'unit_id' => $validated['unit_id'] ?? null,
                    'item_quantity' => $validated['item_quantity'] ?? 1,
                    'loan_description' => $validated['loan_description']
                ]);


                // Step 3: Jika peminjaman kelas
                if ($validated['loan_type'] === 'kelas') {
                    ClassLoan::create([
                        'loan_id' => $loan->loan_id,
                        'class_id' => $validated['class_id'],
                        'subject_id' => $validated['subject_id']
                    ]);

                    $this->logLoanActivity(
                        $loan->loan_id,
                        'class_loan_created',
                        'info',
                        json_encode([
                            'class_id' => $validated['class_id'],
                            'subject_id' => $validated['subject_id']
                        ]),
                    );
                }

                DB::commit();

                return redirect()->back()->with('success', 'Peminjaman berhasil diajukan!');

            } catch (\Exception $e) {
                DB::rollBack();
                // Log Error jika terjadi
                $this->logLoanActivity(
                    null,
                    'loan_creation_failed',
                    'error',
                    json_encode([
                        'error' => $e->getMessage(),
                        'input' => $request->except('password')
                    ]),
                );
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
    }

    public function pendingLoan()
    {
        $loans = DB::table('vloan_pending')->get();
        return view('loans.pending-loan', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $user = auth()->user(); // Ambil user yang login

        $validated = request()->validate([
            'due_date' => 'required|date|after:now'
        ]);

        // Hitung loan date otomatis
        $loanDate = Carbon::now();

        $loan->update([
            'is_approved' => true,
            'loan_status' => 'borrowed',
            'approved_by' => $user->nip,
            'loan_date' => $loanDate,
            'due_date' => $validated['due_date']
        ]);

        // Log Persetujuan
        $this->logLoanActivity(
            $loan->loan_id,
            'loan_approved',
            'info',
            json_encode([
                'approver' => $user->nip,
                'new_status' => 'borrowed',
                'loan_date' => $loanDate->toDateTimeString(),
                'due_date' => $validated['due_date']
            ]),
        );
        return back()->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Loan $loan)
    {

        $oldStatus = $loan->loan_status;
        $loan->update([
            'is_approved' => false,
            'loan_status' => 'rejected',
            'approved_by' => null // Reset approved_by jika di reject
        ]);

        // Log Penolakan
        $this->logLoanActivity(
            $loan->loan_id,
            'loan_rejected',
            'warning',
            json_encode([
                'previous_status' => $oldStatus,
                'reason' => request('rejection_reason') ?? 'Tidak disebutkan'
            ])
        );

        return back()->with('success', 'Peminjaman berhasil ditolak');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $loans = DB::table('vloans')->where('loan_status', '=', 'borrowed')->load('approver');
        return view('loans.show', compact('loans'));
    }

    public function monitoring()
    {
        // Ambil data peminjaman dengan status 'borrowed'
        $loans = DB::table('vloans')
            ->where('loan_status', 'borrowed')
            ->orderBy('due_date', 'asc')
            ->get()->map(function ($loan) {
                $loan->loan_date = Carbon::parse($loan->loan_date)->translatedFormat('l, d F Y H:i');
                $loan->due_date = Carbon::parse($loan->due_date)->translatedFormat('l, d F Y H:i');
                return $loan;
            });
        ;

        return view('loans.monitoring', compact('loans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
