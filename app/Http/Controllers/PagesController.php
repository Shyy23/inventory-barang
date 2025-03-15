<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Item;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan berbagai statistik dan data.
     *
     * @return \Illuminate\View\View
     */
    public function dashboardAdmin()
    {
        // Menghitung jumlah Data dari Tabel
        $jumlahSiswa = Student::count();
        $jumlahBarang = Item::count();
        $jumlahPinjamanTertunda = Loan::where('loan_status', 'pending')->count();
        $jumlahBarangDipinjam = Loan::where('loan_status', 'borrowed')->count();

        // Mengambil barang yang baru saja diperbarui (berdasarkan updated_at)
        $barangBaruDipinjam = Item::latest()->first('updated_at');

        // Mengambil barang yang paling sering dipinjam menggunakan relasi `item_loan` di model `Item`
        $barangSeringDipinjam = Item::withCount('item_loan')
            ->orderBy('item_loan_count', 'desc')
            ->first();

        // Mengambil 5 barang dengan stok paling sedikit
        $barangStokMauHabis = DB::table('vitems')->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Mengambil 5 barang dengan stok paling banyak
        $barangStokTerbanyak = Item::orderBy('stock', 'desc')
            ->take(5)
            ->get();

        // Mengambil 5 pinjaman tertunda terbaru dari view `vloan_pending`
        $pinjamanTertunda = DB::table('vloan_pending')
            ->orderBy('loan_date', 'desc')
            ->take(5)
            ->get();

        // Mengambil 5 aktivitas terbaru dari view `vloan_details`
        $aktivitasTerbaru = DB::table('vloans')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // Menghitung jumlah siswa per kelas menggunakan view `vstudents`
        $jumlahSiswaKelas = DB::table('vstudents')
            ->select('class_name', DB::raw('COUNT(*) as total'))
            ->groupBy('class_name')
            ->orderBy('class_name')
            ->get();

        // Memproses tanggal pinjaman tertunda agar mudah digunakan di Blade
        foreach ($pinjamanTertunda as $pinjaman) {
            $pinjaman->loan_date = Carbon::parse($pinjaman->loan_date);
        }

        // Memproses tanggal aktivitas terbaru agar mudah digunakan di Blade
        foreach ($aktivitasTerbaru as $aktivitas) {
            $aktivitas->updated_at = Carbon::parse($aktivitas->updated_at);
        }

        // Mengirim semua data ke view `admins.dashboard`
        return view('admins.dashboard', compact(
            'jumlahSiswa',
            'jumlahBarang',
            'jumlahPinjamanTertunda',
            'jumlahBarangDipinjam',
            'barangBaruDipinjam',
            'barangSeringDipinjam',
            'barangStokTerbanyak',
            'barangStokMauHabis',
            'aktivitasTerbaru',
            'pinjamanTertunda',
            'jumlahSiswaKelas'
        ));
    }

    public function home(){
    $classes = DB::table('vclasses')->get();
      return view('home', compact('classes'));  
    }
}