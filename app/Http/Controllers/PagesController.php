<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\LoanLog;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboardAdmin()
    {

        $jumlahSiswa = Student::count();
        $jumlahBarang = Item::count();
        $jumlahPinjamanTertunda = LoanLog::where('loan_status', 'delayed')->count();
        $jumlahBarangDipinjam = LoanLog::where('loan_status', 'borrowed')->count();
        $barangBaruDipinjam = Item::latest()->first('updated_at');
        // Untuk mengambil barang yang sering dipinjam dari relasi method item_loan di model Item
        $barangSeringDipinjam = Item::withCount('item_loan')->orderBy('item_loan_count', 'desc')->first();
        $barangStokMauHabis = Item::orderBy('stock', 'asc')->take(5)->get();
        $barangStokTerbanyak = Item::orderBy('stock', 'desc')->take(5)->get();

        $pinjamanTertunda = DB::table('vloan_delayed')->orderBy('loan_date', 'desc')->take(5)->get();
        $aktivitasTerbaru = DB::table('vloan_details')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        $jumlahSiswaKelas = DB::table('vstudents')->select('class_name', DB::raw('COUNT(*) as total'))->groupBy('class_name')->orderBy('class_name')->get();

        foreach ($pinjamanTertunda as $pinjaman) {
            $pinjaman->loan_date = Carbon::parse($pinjaman->loan_date);
        }
        foreach ($aktivitasTerbaru as $aktivitas) {
            $aktivitas->updated_at = Carbon::parse($aktivitas->updated_at);
        }

        return view('admins.dashboard', compact('jumlahSiswa', 'jumlahBarang', 'jumlahPinjamanTertunda', 'jumlahBarangDipinjam', 'barangBaruDipinjam', 'barangSeringDipinjam', 'barangStokTerbanyak', 'barangStokMauHabis', 'aktivitasTerbaru', 'pinjamanTertunda',  'jumlahSiswaKelas'));
    }
}
