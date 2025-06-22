<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Traits\UpdateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use UpdateHelper;
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'students' => 'required|array',
                'students.*.class' => 'required_if:students.*.selected,1|exists:classes,class_id',
                'slug_class' => 'required|string',
            ]);

            $updates = [];
            $studentIds = [];

            foreach ($request->students as $studentId => $data) {
                if (!empty($data['selected'])) {
                    $studentIds[] = $studentId;
                    $updates[$studentId] = $data['class'];
                }
            }

            // Update kelas siswa
            if (!empty($studentIds)) {
                $updateData = [
                    'class_id' => $this->buildCaseStatement($updates, 'nisn')
                ];
                Student::whereIn('nisn', $studentIds)->update($updateData);
            }

            // Ambil slug_class dari request
            $slug_class = $request->input('slug_class');

            // Redirect ke halaman kelas dengan slug
            return redirect()
                ->route('classes.students', ['slug_class' => $slug_class])
                ->with('success', 'Kelas siswa berhasil diperbarui');
        } catch (\Exception $e) {
            // Jika error, tetap kirim slug_class agar bisa kembali ke halaman yang benar
            $slug_class = $request->input('slug_class', 'default-slug');
            return redirect()
                ->route('classes.students', ['slug_class' => $slug_class])
                ->with('error', 'Gagal memperbarui kelas siswa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {


        try {
            // Validasi
            $request->validate([
                'students' => 'required|array',
                'students.*' => 'exists:students,nisn',
                'slug_class' => 'required|string',
            ]);

            $studentIds = $request->input('students');
            $slug_class = $request->input('slug_class');

            // Ambil user_id dari students yang dipilih
            $userIds = Student::
                whereIn('nisn', $studentIds)
                ->pluck('user_id')
                ->toArray();

            // Hapus dalam transaksi untuk keamanan data
            DB::transaction(function () use ($studentIds, $userIds) {
                // Hapus dari tabel students
                Student::whereIn('nisn', $studentIds)->delete();

                // Hapus dari tabel users
                if (!empty($userIds)) {
                    User::whereIn('user_id', $userIds)->delete();
                }
            });

            return redirect()
                ->route('classes.students', ['slug_class' => $slug_class])
                ->with('success', 'Siswa dan akun terkait berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('classes.students', ['slug_class' => $request->input('slug_class', 'default')])
                ->with('error', 'Gagal menghapus siswa: ' . $e->getMessage());
        }
    }
}
