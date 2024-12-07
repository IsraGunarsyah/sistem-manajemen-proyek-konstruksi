@extends('user.layouts.app')

@section('title', 'Progress Lapangan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Heading -->
        <h1 class="text-4xl font-bold text-[#1B1B48] mb-8 text-center">Progress Lapangan</h1>

        <!-- Dropdown Kota -->
        <div class="flex justify-center mb-8">
            <form method="GET" action="{{ route('user.pekerjaan.progress-lapangan') }}" class="w-full max-w-lg">
                <label for="kota" class="text-lg font-semibold text-[#1B1B48] mb-2 block">Pilih Kota</label>
                <select name="kota" id="kota" class="w-full p-3 bg-white border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg" onchange="this.form.submit()">
                    <option value="" class="text-gray-500">Pilih Kota</option>
                    <option value="Bontang Utara" {{ $kota == 'Bontang Utara' ? 'selected' : '' }}>Bontang Utara</option>
                    <option value="Bontang Barat" {{ $kota == 'Bontang Barat' ? 'selected' : '' }}>Bontang Barat</option>
                    <option value="Bontang Selatan" {{ $kota == 'Bontang Selatan' ? 'selected' : '' }}>Bontang Selatan</option>
                </select>
            </form>
        </div>

        <!-- Tampilkan jika belum memilih kota -->
        @if (!$kota)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center mb-8">
                <p>Pilih kota terlebih dahulu untuk menampilkan data pekerjaan.</p>
            </div>
        @endif

        <!-- Jika sudah memilih kota dan data pekerjaan tersedia -->
        @if ($pekerjaans->isNotEmpty() && $kota)
            <div class="overflow-x-auto rounded-lg shadow-lg bg-white p-4">
                <table class="min-w-full bg-white text-sm text-left text-gray-700">
                    <thead class="bg-[#1B1B48] text-white">
                        <tr>
                            <th class="py-3 px-6">Nama Pekerjaan</th>
                            <th class="py-3 px-6">Lokasi</th>
                            <th class="py-3 px-6">Tanggal Mulai</th>
                            <th class="py-3 px-6">Progress</th>
                            <th class="py-3 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pekerjaans as $pekerjaan)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-6">{{ $pekerjaan->nama_pekerjaan }}</td>
                                <td class="py-4 px-6">{{ $pekerjaan->lokasi }}</td>
                                <td class="py-4 px-6">
                                    @if ($pekerjaan->tanggal_mulai)
                                        {{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}
                                    @else
                                        <span class="text-red-500">Belum ada tanggal mulai</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($pekerjaan->status == 'Selesai')
                                        <span class="text-green-500">Selesai</span>
                                    @elseif ($pekerjaan->progress->count() > 0)
                                        <span class="text-yellow-500">Progress Berjalan</span>
                                    @else
                                        <span class="text-red-500">Belum ada progress</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('user.pekerjaan.detail-progress', $pekerjaan->id) }}" 
                                       class="bg-blue-500 text-white text-sm md:text-base py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                                       Lihat Progress
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif($kota)
            <div class="bg-red-100 text-red-800 p-4 rounded-lg text-center mb-8">
                Tidak ada data pekerjaan yang ditemukan untuk kota {{ $kota }}.
            </div>
        @endif
    </div>
@endsection
