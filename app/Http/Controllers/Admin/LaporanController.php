<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Fungsi untuk menampilkan daftar pekerjaan beserta user yang menginput
    public function index()
    {
        // Ambil data pekerjaan dan user yang menginput
        $pekerjaans = Pekerjaan::with('user')->get(); // Pastikan relasi 'user' ada di model Pekerjaan

        return view('admin.laporan.index', compact('pekerjaans'));
    }

    // Fungsi untuk menampilkan detail progres dari pekerjaan
    public function show(Pekerjaan $pekerjaan)
    {
        // Ambil semua progress yang terkait dengan pekerjaan
        $progress = $pekerjaan->progresses; // Variabel 'progresses' dari relasi di model
    
        return view('admin.laporan.detail', compact('pekerjaan', 'progress'));
    }
    
    public function showDetail($id)
    {
        $pekerjaan = Pekerjaan::with('progress.user')->findOrFail($id);
    
        return view('admin.laporan.detail', compact('pekerjaan'));
    }
    

}
