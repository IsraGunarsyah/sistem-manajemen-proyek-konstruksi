@extends('user.layouts.app')

@section('title', 'Detail Progress')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Detail Progress - {{ $pekerjaan->nama_pekerjaan }}</h1>

    <!-- Button Kembali -->
    <a href="{{ route('user.pekerjaan.progress-lapangan') }}" 
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>

    <!-- Cek apakah pekerjaan sudah selesai -->
    @if ($pekerjaan->status == 'Selesai')
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mt-6">
            <strong>Info:</strong> Pekerjaan ini telah selesai, tidak bisa menambah atau mengedit progress baru.
        </div>
    @else
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('user.pekerjaan.tambah-progress', $pekerjaan->id) }}" 
                class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Progress Baru
            </a>
            <form action="{{ route('user.pekerjaan.selesai', $pekerjaan->id) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <button type="submit" 
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-check mr-2"></i>Tandai Selesai
                </button>
            </form>
        </div>
    @endif

    <!-- Flash message -->
    @if (session('success'))
        <div class="mt-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Progress Table -->
    @if ($progresses->isEmpty())
        <div class="mt-6 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
            Tidak ada progress yang ditemukan untuk pekerjaan ini.
        </div>
    @else
        <div class="mt-8 overflow-x-auto">
            <table class="w-full text-sm text-left bg-white shadow-md rounded-lg">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Cuaca</th>
                        <th class="px-6 py-4 font-medium">Jenis Pekerjaan</th>
                        <th class="px-6 py-4 font-medium">Jumlah Tiang</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Foto</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progresses as $progress)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($progress->tanggal_waktu_pengerjaan)->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">{{ $progress->kondisi_cuaca }}</td>
                            <td class="px-6 py-4">{{ $progress->jenis_pekerjaan }}</td>
                            <td class="px-6 py-4">{{ $progress->jumlah_tiang }}</td>
                            <td class="px-6 py-4">{{ $progress->status }}</td>
                            <td class="px-6 py-4">
                                @if ($progress->foto)
                                    <button onclick="openModal({{ json_encode($progress->foto) }})" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                        Lihat Foto
                                    </button>
                                @else
                                    <span class="text-gray-500">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($pekerjaan->status != 'Selesai')
                                    <a href="{{ route('user.pekerjaan.edit-progress', ['id' => $pekerjaan->id, 'progress' => $progress->id]) }}" 
                                        class="px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 transition">
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

    <!-- Modal Foto Dokumentasi -->
    <div id="fotoModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl w-full">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Foto Dokumentasi</h2>
            <div id="fotoGallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Foto akan dirender di sini -->
            </div>
            <button onclick="closeModal()" 
                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openModal(fotoJson) {
        const fotoModal = document.getElementById('fotoModal');
        const fotoGallery = document.getElementById('fotoGallery');

        fotoGallery.innerHTML = '';
        if (typeof fotoJson === 'string') {
            fotoJson = JSON.parse(fotoJson);
        }

        fotoJson.forEach(foto => {
            const img = document.createElement('img');
            img.src = `/storage/${foto}`;
            img.alt = 'Dokumentasi Pekerjaan';
            img.classList.add('rounded-lg', 'object-cover', 'w-full', 'h-auto');
            fotoGallery.appendChild(img);
        });

        fotoModal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('fotoModal').classList.add('hidden');
    }
</script>
@endsection
