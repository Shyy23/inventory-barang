<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\LoanLog;
use App\Models\Student;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboardAdmin()
    {

        $jumlahSiswa = Student::count();
        $jumlahBarang = Item::count();
        $jumlahPinjamanTertunda = LoanLog::where('loan_status', 'delayed')->count();
        $jumlahBarangDipinjam = LoanLog::where('loan_status','borrowed')->count();
        $barangBaruDipinjam = Item::latest()->first('updated_at');
        // $barangSeringDipinjam = Item::withCount('loan_details')->orderBy('pinjaman_count', 'desc')->first();
        $barangStokMauHabis = Item::where('stock', '<', 5)->first();
        $barangStokTerbanyak = Item::orderBy('stock', 'desc')->first();
        $chartLabels = Item::pluck('item_name');
        $chartData =  Item::pluck('stock');

        $aktivitasTerbaru = LoanLog::latest()->take(5)->get();

        return view('admins.dashboard', compact('jumlahSiswa', 'jumlahBarang', 'jumlahPinjamanTertunda', 'jumlahBarangDipinjam', 'barangBaruDipinjam',  'barangStokTerbanyak', 'barangStokMauHabis', 'chartLabels', 'chartData', 'aktivitasTerbaru'));
    }
}
