<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Progress;


class PekerjaanController extends Controller
{
    // Menampilkan halaman pekerjaan
    public function index()
    {
        // Di sini Anda bisa mengambil data pekerjaan dari database jika diperlukan
        return view('user.pekerjaan.index');
    }

    // Menangani penyimpanan pekerjaan baru
   public function store(Request $request)
{
    // Validasi inputan
    $request->validate([
        'nama_pekerjaan' => 'required|string|max:255',
        'jenis_pekerjaan' => 'nullable|string|max:255',
        'lokasi' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal_mulai' => 'required|date',
        'kondisi_cuaca' => 'nullable|string|max:255',
        'tanggal_waktu_pengerjaan' => 'nullable|date',
        'foto' => 'nullable|image|max:2048',
        'subkontraktor' => 'nullable|string|max:255',
        'status' => 'required|string|max:50',
    ]);

    // Upload foto jika ada
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('uploads/pekerjaan', 'public');
    }

    // Simpan data pekerjaan ke database
    Pekerjaan::create([
        'nama_pekerjaan' => $request->nama_pekerjaan,
        'jenis_pekerjaan' => $request->jenis_pekerjaan,
        'lokasi' => $request->lokasi,
        'deskripsi' => $request->deskripsi,
        'tanggal_mulai' => $request->tanggal_mulai,
        'kondisi_cuaca' => $request->kondisi_cuaca,
        'tanggal_waktu_pengerjaan' => $request->tanggal_waktu_pengerjaan,
        'foto' => $fotoPath,
        'subkontraktor' => $request->subkontraktor,
        'status' => $request->status,
        'user_id' => auth()->user()->id, // Menyimpan ID pengguna yang sedang login
    ]);
    
    return redirect()->route('user.pekerjaan.index')->with('success', 'Data pekerjaan berhasil disimpan.');
}


public function edit($id)
{
    $pekerjaan = Pekerjaan::findOrFail($id);
    return view('user.pekerjaan.pekerjaan-edit', compact('pekerjaan'));
}

// Memperbarui data progress
public function update(Request $request, $id)
{
    $pekerjaan = Pekerjaan::findOrFail($id);

    // Validasi data
    $request->validate([
        'tanggal_waktu_pengerjaan' => 'nullable|date',
        'jenis_pekerjaan' => 'nullable|string|max:255',
        'kondisi_cuaca' => 'nullable|string|max:255',
        'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:10240', // Validasi multiple file
    ]);

    // Jika ada foto yang diupload
    if ($request->hasFile('foto')) {
        $fotoPaths = [];

        // Loop untuk menyimpan setiap gambar
        foreach ($request->file('foto') as $file) {
            $fotoPath = $file->store('uploads/pekerjaan', 'public');
            $fotoPaths[] = $fotoPath; // Simpan path ke array
        }

        // Simpan foto-foto dalam format JSON di database
        $pekerjaan->foto = json_encode($fotoPaths);
    }

    // Update data pekerjaan
    $pekerjaan->update([
        'jenis_pekerjaan' => $request->jenis_pekerjaan,
        'kondisi_cuaca' => $request->kondisi_cuaca,
        'tanggal_waktu_pengerjaan' => $request->tanggal_waktu_pengerjaan,
    ]);

    return redirect()->route('user.pekerjaan.progress-lapangan')->with('success', 'Progress berhasil diperbarui.');
}


public function progressLapangan()
{
    $pekerjaans = Pekerjaan::where('user_id', auth()->user()->id)->get(); // Filter berdasarkan user_id
    return view('user.pekerjaan.progress-lapangan', compact('pekerjaans'));
}


// Fungsi untuk menampilkan form tambah progress
public function tambahProgressForm($id)
{
    $pekerjaan = Pekerjaan::findOrFail($id);
    return view('user.pekerjaan.tambah-progress', compact('pekerjaan'));
}

// Fungsi untuk menyimpan progress baru
public function simpanProgress(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'tanggal_waktu_pengerjaan' => 'required|date',
        'kondisi_cuaca' => 'required|string|max:255',
        'foto' => 'nullable|array',
        'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        'jenis_pekerjaan' => 'required|string|max:255',
    ]);

    // Temukan pekerjaan berdasarkan ID
    $pekerjaan = Pekerjaan::findOrFail($id);

    // Simpan foto jika ada
    $fotoPaths = [];
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $fotoPath = $file->store('uploads/progress', 'public');
            $fotoPaths[] = $fotoPath;
        }
    }

    // Tambah progress baru ke database
    $pekerjaan->progress()->create([
        'tanggal_waktu_pengerjaan' => $request->tanggal_waktu_pengerjaan,
        'kondisi_cuaca' => $request->kondisi_cuaca,
        'foto' => json_encode($fotoPaths),
        'jenis_pekerjaan' => $request->jenis_pekerjaan, // Add this line to save the jenis pekerjaan
    ]);

    // Flash message untuk notifikasi
    return redirect()->route('user.pekerjaan.detail-progress', $pekerjaan->id)
                     ->with('success', 'Progress berhasil ditambahkan.');
}



public function detailProgress($id)
{
    $pekerjaan = Pekerjaan::findOrFail($id);
    $progresses = $pekerjaan->progress()->get();  // Ambil semua progress terkait pekerjaan ini

    return view('user.pekerjaan.detail-progress', compact('pekerjaan', 'progresses'));
}


public function markAsSelesai($id)
{
    // Temukan pekerjaan berdasarkan ID
    $pekerjaan = Pekerjaan::findOrFail($id);

    // Ubah status pekerjaan menjadi "Selesai"
    $pekerjaan->status = 'Selesai';
    $pekerjaan->save();

    // Ubah status semua progress yang terkait menjadi "Selesai"
    Progress::where('pekerjaan_id', $id)->update(['status' => 'Selesai']);

    return redirect()->route('user.pekerjaan.detail-progress', $id)->with('success', 'Pekerjaan dan Progress telah ditandai sebagai selesai.');
}

// PekerjaanController.php

public function editProgress($id, $progressId)
{
    $pekerjaan = Pekerjaan::findOrFail($id);
    $progress = Progress::findOrFail($progressId);

    return view('user.pekerjaan.edit-progress', compact('pekerjaan', 'progress'));
}


public function updateProgress(Request $request, $pekerjaanId, $progressId)
{
    $progress = Progress::findOrFail($progressId);

    $validated = $request->validate([
        'tanggal_waktu_pengerjaan' => 'required|date',
        'kondisi_cuaca' => 'required|string',
        'jenis_pekerjaan' => 'required|string',
        'status' => 'required|string',
        // Tambahkan validasi lainnya sesuai kebutuhan
    ]);

    $progress->update($validated);

    return redirect()->route('user.pekerjaan.detail-progress', $pekerjaanId)
                     ->with('success', 'Progress berhasil diperbarui.');
}



}
