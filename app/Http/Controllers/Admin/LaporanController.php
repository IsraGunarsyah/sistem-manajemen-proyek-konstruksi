<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Fungsi untuk menampilkan daftar pekerjaan beserta user yang menginput
    public function index(Request $request)
{
    // Fetch the distinct kota values
    $kotas = Pekerjaan::distinct()->pluck('kota');

    // Get the selected kota from the request
    $kota = $request->get('kota');

    // Query pekerjaans based on selected kota, if any
    $pekerjaans = Pekerjaan::query();

    if ($kota) {
        $pekerjaans = $pekerjaans->where('kota', $kota);
    }

    // Get the pekerjaans after applying the filter
    $pekerjaans = $pekerjaans->get();

    return view('admin.laporan.index', compact('pekerjaans', 'kotas', 'kota'));
}


    // Fungsi untuk menampilkan detail progres dari pekerjaan
    public function show(Pekerjaan $pekerjaan)
    {
        // Ambil semua progress yang terkait dengan pekerjaan
        $progress = $pekerjaan->progresses; // Variabel 'progresses' dari relasi di model
    
        return view('admin.laporan.detail', compact('pekerjaan', 'progress'));
    }
    
    // Fungsi untuk menampilkan detail berdasarkan ID
    public function showDetail($id)
    {
        $pekerjaan = Pekerjaan::with('progress.user')->findOrFail($id);
    
        return view('admin.laporan.detail', compact('pekerjaan'));
    }
}
