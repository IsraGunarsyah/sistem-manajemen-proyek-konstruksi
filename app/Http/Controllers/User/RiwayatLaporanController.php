<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Auth;

class RiwayatLaporanController extends Controller
{
    // Menampilkan semua pekerjaan yang telah selesai
    public function index()
    {
        // Ambil pekerjaan yang sudah selesai dan milik pengguna yang login
        $pekerjaans = Pekerjaan::where('status', 'Selesai')
                               ->where('user_id', Auth::user()->id) // Filter pekerjaan berdasarkan user yang login
                               ->get();

        return view('user.pekerjaan.riwayat-laporan', compact('pekerjaans'));
    }

    // Menampilkan detail progres dari pekerjaan yang selesai
    public function detail($id)
    {
        $pekerjaan = Pekerjaan::with('progress') // Mengambil data progres terkait
                              ->where('id', $id)
                              ->where('status', 'Selesai')
                              ->where('user_id', Auth::user()->id) // Pastikan hanya pemilik pekerjaan yang bisa melihat
                              ->firstOrFail();

        return view('user.pekerjaan.detail-riwayat', compact('pekerjaan'));
    }
}
