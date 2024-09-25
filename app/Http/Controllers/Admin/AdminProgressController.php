<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;

class AdminProgressController extends Controller
{
    // Menampilkan dokumentasi dari progress pekerjaan
    public function showDokumentasi($id)
    {
        // Cari progress berdasarkan ID
        $progress = Progress::findOrFail($id);
        
        // Pastikan progress memiliki file foto dokumentasi
        if (!$progress->foto) {
            return redirect()->back()->with('error', 'Tidak ada dokumentasi untuk progress ini.');
        }

        // Mengirim data progress ke view
        return view('admin.laporan.dokumentasi', compact('progress'));
    }
}
