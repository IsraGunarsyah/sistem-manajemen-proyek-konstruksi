@extends('user.layouts.app')

@section('title', 'Detail Progress')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Detail Progress - {{ $pekerjaan->nama_pekerjaan }}</h1>

<!-- Button Kembali -->
<a href="{{ route('user.pekerjaan.progress-lapangan') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 mb-4 inline-block">
    Kembali
</a>

<!-- Cek apakah pekerjaan sudah selesai -->
@if ($pekerjaan->status == 'Selesai')
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        Pekerjaan ini telah selesai, tidak bisa menambah atau mengedit progress baru.
    </div>
@else
    <!-- Tombol "Tambah Progress" hanya muncul jika pekerjaan belum selesai -->
    <a href="{{ route('user.pekerjaan.tambah-progress', $pekerjaan->id) }}" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 mb-4 inline-block">
        Tambah Progress Baru
    </a>
    <!-- Tombol "Selesai" untuk menandai pekerjaan sebagai selesai -->
    <form action="{{ route('user.pekerjaan.selesai', $pekerjaan->id) }}" method="POST" class="inline">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 mb-4 inline-block">
            Tandai Selesai
        </button>
    </form>
@endif

<!-- Tampilkan flash message jika ada -->
@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif

@if ($progresses->isEmpty())
    <div class="bg-red-500 text-white p-4 rounded-md">
        Tidak ada progress yang ditemukan untuk pekerjaan ini.
    </div>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-md shadow-md">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="py-3 px-6 font-semibold">Tanggal dan Waktu Pengerjaan</th>
                    <th class="py-3 px-6 font-semibold">Kondisi Cuaca</th>
                    <th class="py-3 px-6 font-semibold">Nama Pekerjaan</th>
                    <th class="py-3 px-6 font-semibold">Lokasi</th>
                    <th class="py-3 px-6 font-semibold">Jenis Pekerjaan</th>
                    <th class="py-3 px-6 font-semibold">Deskripsi</th>
                    <th class="py-3 px-6 font-semibold">Subkontraktor</th>
                    <th class="py-3 px-6 font-semibold">Status</th>
                    <th class="py-3 px-6 font-semibold">Foto Dokumentasi</th>
                    <th class="py-3 px-6 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($progresses as $progress)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($progress->tanggal_waktu_pengerjaan)->format('d - M - Y H:i') }}</td>
                        <td class="py-4 px-6">{{ $progress->kondisi_cuaca }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->nama_pekerjaan }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->lokasi }}</td>
                        <td class="py-4 px-6">{{ $progress->jenis_pekerjaan }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->deskripsi }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->subkontraktor }}</td>
                        <td class="py-4 px-6">{{ $progress->status }}</td>
                        <td class="py-4 px-6">
                            @if ($progress->foto)
                                <button onclick="openModal({{ json_encode($progress->foto) }})" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                                    Lihat Dokumentasi
                                </button>
                            @else
                                <span class="text-gray-500">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <!-- Hanya tampilkan tombol edit jika status pekerjaan belum selesai -->
                            @if ($pekerjaan->status != 'Selesai')
                                <a href="{{ route('user.pekerjaan.edit-progress', ['id' => $pekerjaan->id, 'progress' => $progress->id]) }}"
                                    class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600">
                                    Edit
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<!-- Modal untuk menampilkan foto dokumentasi -->
<div id="fotoModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 max-w-4xl">
        <h2 class="text-2xl font-semibold mb-4">Dokumentasi Foto</h2>
        <div id="fotoGallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 overflow-auto max-h-96">
            <!-- Foto akan di-render di sini -->
        </div>
        <button onclick="closeModal()" class="mt-4 bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">
            Tutup
        </button>
    </div>
</div>

<script>
    function openModal(fotoJson) {
        const fotoModal = document.getElementById('fotoModal');
        const fotoGallery = document.getElementById('fotoGallery');
        
        // Kosongkan galeri sebelum menambahkan gambar baru
        fotoGallery.innerHTML = '';
        
        // Parsing JSON jika diperlukan
        if (typeof fotoJson === 'string') {
            fotoJson = JSON.parse(fotoJson);
        }

        // Looping untuk setiap gambar dan menampilkannya
        fotoJson.forEach(foto => {
            const img = document.createElement('img');
            img.src = `/storage/${foto}`;
            img.alt = 'Dokumentasi Pekerjaan';
            img.classList.add('w-full', 'h-auto', 'rounded-lg', 'object-cover');
            fotoGallery.appendChild(img);
        });

        // Tampilkan modal
        fotoModal.classList.remove('hidden');
    }

    function closeModal() {
        const fotoModal = document.getElementById('fotoModal');
        fotoModal.classList.add('hidden');
    }
</script>

@endsection
