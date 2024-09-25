<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pekerjaan;
use Carbon\Carbon;
class DashboardController extends Controller
{
    

    public function index()
    {
        // Mengambil data pekerjaan aktif berdasarkan bulan
        $activeData = Pekerjaan::selectRaw('MONTH(tanggal_mulai) as bulan, COUNT(*) as jumlah')
            ->where('status', '!=', 'Selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('jumlah', 'bulan')
            ->toArray();
    
        // Mengambil data pekerjaan selesai berdasarkan bulan
        $completedData = Pekerjaan::selectRaw('MONTH(tanggal_mulai) as bulan, COUNT(*) as jumlah')
            ->where('status', 'Selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('jumlah', 'bulan')
            ->toArray();
    
        // Membuat array untuk bulan (Januari - Desember)
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->translatedFormat('F'); // Menggunakan nama bulan bahasa setempat
        })->toArray();
    
        // Memastikan bahwa setiap bulan diisi dengan 0 jika tidak ada pekerjaan
        $activeData = array_replace(array_fill(1, 12, 0), $activeData);
        $completedData = array_replace(array_fill(1, 12, 0), $completedData);
    
        return view('admin.dashboard', compact('months', 'activeData', 'completedData'));
    }
    
    
}
