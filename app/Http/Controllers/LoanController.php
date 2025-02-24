<?php

namespace App\Http\Controllers;

use App\Models\ClassLoan;
use App\Models\Loan;
use App\Models\LoanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LoanController extends Controller
{
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
    { {
            // Validasi data
            $validated = $request->validate([
                'nisn' => 'required|exists:students,nisn',
                'return_time' => 'required|date_format:H:i',
                'item_id' => 'required|exists:items,item_id',
                'item_quantity' => 'required|integer|min:1',
                'loan_description' => 'nullable|string',
                'loan_type' => 'required|in:individu,kelas',
                'unit_id' => 'nullable|exists:item_units,unit_id',
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
            ]);

            DB::beginTransaction();

            try {
                // Step 1: Simpan data ke tabel loans
                $loan = Loan::create([
                    'nisn' => $validated['nisn'],
                    'return_time' => $validated['return_time'],
                    'loan_type' => $validated['loan_type'],
                    'loan_status' => 'delayed' // Sesuaikan dengan status awal yang diperlukan
                ]);

                // Step 2: Simpan ke loan_details
                LoanDetail::create([
                    'loan_id' => $loan->loan_id,
                    'item_id' => $validated['item_id'],
                    'unit_id' => $validated['unit_id'] ?? null,
                    'item_quantity' => $validated['item_quantity'],
                    'loan_description' => $validated['loan_description']
                ]);

                // Step 3: Jika peminjaman kelas
                if ($validated['loan_type'] === 'kelas') {
                    ClassLoan::create([
                        'loan_id' => $loan->loan_id,
                        'class_id' => $validated['class_id'],
                        'subject_id' => $validated['subject_id']
                    ]);
                }

                DB::commit();

                return redirect()->back()->with('success', 'Peminjaman berhasil diajukan!');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
    }

    public function delayedLoan()
    {
        $loans = DB::table('vloan_delayed')->get()->map(function ($loan) {
            $loan->loan_date = Carbon::parse($loan->loan_date);
            $loan->return_time = Carbon::parse($loan->return_time);
            return $loan;
        });
        return view('loans.delayed-loan', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $user = auth()->user(); // Ambil user yang login

        $loan->update([
            'loan_status' => 'borrowed',
            'approved_by' => $user->nip // Sesuaikan dengan nama kolom NIP di tabel users
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Loan $loan)
    {
        $loan->update([
            'loan_status' => 'rejected',
            'approved_by' => null // Reset approved_by jika di reject
        ]);

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
            ->orderBy('return_time', 'asc')
            ->get()->map(function ($loan) {
                $loan->loan_date = Carbon::parse($loan->loan_date);
                $loan->return_time = Carbon::parse($loan->return_time);
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
