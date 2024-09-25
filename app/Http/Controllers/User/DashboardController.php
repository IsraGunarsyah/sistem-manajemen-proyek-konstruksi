<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan; // pastikan Anda sudah meng-import model Pekerjaan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengambil ID user yang sedang login

class DashboardController extends Controller
{
    // Fungsi index untuk menampilkan dashboard pengawas
    public function index()
    {
        // Ambil semua pekerjaan yang statusnya belum selesai dan milik pengguna yang sedang login
        $pekerjaans = Pekerjaan::where('status', '!=', 'Selesai')
                               ->where('user_id', Auth::user()->id) // Filter berdasarkan user_id
                               ->get();

        // Kirim data pekerjaan ke view
        return view('user.dashboard', compact('pekerjaans'));
    }

    // Fungsi untuk menyelesaikan pekerjaan
    public function markAsComplete($id)
    {
        // Cari pekerjaan berdasarkan ID
        $pekerjaan = Pekerjaan::findOrFail($id);

        // Pastikan pekerjaan milik user yang login
        if ($pekerjaan->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyelesaikan pekerjaan ini.');
        }

        // Ubah status pekerjaan menjadi selesai
        $pekerjaan->status = 'Selesai';
        $pekerjaan->save();

        // Kembalikan dengan pesan sukses
        return redirect()->back()->with('success', 'Pekerjaan berhasil diselesaikan.');
    }
}
