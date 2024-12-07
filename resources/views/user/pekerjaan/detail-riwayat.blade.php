@extends('user.layouts.app')

@section('title', 'Detail Progres')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-[#1B1B48] mb-8">
        Detail Progres - {{ $pekerjaan->nama_pekerjaan }}
    </h1>

    <!-- Button Kembali -->
    <a href="{{ route('user.pekerjaan.riwayat-laporan') }}" 
       class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300 mb-6">
        Kembali
    </a>

    @if ($pekerjaan->progress->isEmpty())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-md">
            <p class="font-semibold">Tidak ada progress yang ditemukan untuk pekerjaan ini.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-400 text-gray-800">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Tanggal & Waktu</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Cuaca</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Nama Pekerjaan</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Lokasi</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Jenis Pekerjaan</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Deskripsi</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Subkontraktor</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Jumlah Tiang</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Status</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide text-center">Foto</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pekerjaan->progress as $progresss)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="py-4 px-6 text-sm font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($progresss->tanggal_waktu_pengerjaan)->format('d - M - Y H:i') }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $progresss->kondisi_cuaca }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $pekerjaan->nama_pekerjaan }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $pekerjaan->lokasi }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $progresss->jenis_pekerjaan }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $pekerjaan->deskripsi }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $pekerjaan->subkontraktor }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $progresss->jumlah_tiang }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600">{{ $progresss->status }}</td>
                            <td class="py-4 px-6 text-center">
                                @if ($progresss->foto)
                                    <button onclick="openModal({{ json_encode($progresss->foto) }})" 
                                            class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
                                        Lihat Dokumentasi
                                    </button>
                                @else
                                    <span class="text-gray-500">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Modal untuk Dokumentasi Foto -->
    <div id="fotoModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Dokumentasi Foto</h2>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900 text-lg">
                    ✖
                </button>
            </div>
            <div id="fotoGallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 overflow-auto max-h-96">
                <!-- Foto akan di-render di sini -->
            </div>
        </div>
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
            img.src = `/storage/${foto}`; // Pastikan jalur benar
            img.alt = 'Dokumentasi Pekerjaan';
            img.classList.add('w-full', 'h-auto', 'rounded-lg', 'object-cover', 'shadow-md');
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
