@extends('admin.layouts.app')

@section('title', 'Progress Lapangan')

@section('content')
    <div class="container mx-auto px-8 py-12">
        <!-- Heading -->
        <div class="text-center mb-10">
            <h1 class="text-5xl font-semibold text-[#2C3E50]">Progress Lapangan</h1>
            <p class="mt-2 text-lg text-gray-600">Kelola dan pantau progres pekerjaan di berbagai kota.</p>
        </div>

        <!-- Dropdown Kota -->
        <div class="flex justify-center mb-12">
            <form method="GET" action="{{ route('admin.laporan') }}" class="w-full max-w-xl">
                <div class="flex items-center space-x-4">
                    <label for="kota" class="text-xl font-medium text-[#34495E]">Pilih Kota:</label>
                    <select name="kota" id="kota" class="w-full p-4 border border-[#BDC3C7] rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" class="text-gray-500">Pilih Kota</option>
                        @foreach($kotas as $kotaOption)
                            <option value="{{ $kotaOption }}" {{ $kota == $kotaOption ? 'selected' : '' }}>{{ $kotaOption }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">Tampilkan</button>
                </div>
            </form>
        </div>

        <!-- Tampilkan jika belum memilih kota -->
        @if (!$kota)
            <div class="bg-yellow-200 text-yellow-800 p-4 rounded-lg text-center mb-10 shadow-md">
                <p class="font-medium">Pilih kota terlebih dahulu untuk menampilkan data pekerjaan.</p>
            </div>
        @endif

        <!-- Jika sudah memilih kota dan data pekerjaan tersedia -->
        @if ($kota && $pekerjaans->isNotEmpty())
            <div class="overflow-hidden bg-white shadow-lg rounded-lg">
                <table class="min-w-full table-auto text-lg text-left text-gray-800">
                    <thead class="bg-[#34495E] text-white">
                        <tr>
                            <th class="py-4 px-6">Nama Pekerjaan</th>
                            <th class="py-4 px-6">Lokasi</th>
                            <th class="py-4 px-6">Tanggal Mulai</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pekerjaans as $pekerjaan)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-4 px-6 font-medium">{{ $pekerjaan->nama_pekerjaan }}</td>
                                <td class="py-4 px-6">{{ $pekerjaan->lokasi }}</td>
                                <td class="py-4 px-6">
                                    @if ($pekerjaan->tanggal_mulai)
                                        {{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}
                                    @else
                                        <span class="text-red-600 font-medium">Belum ada tanggal mulai</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($pekerjaan->status == 'Selesai')
                                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm">Selesai</span>
                                    @elseif ($pekerjaan->progress->count() > 0)
                                        <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-sm">Progress Berjalan</span>
                                    @else
                                        <span class="bg-red-500 text-white px-4 py-1 rounded-full text-sm">Belum ada progress</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('admin.laporan.detail', $pekerjaan->id) }}" 
                                       class="bg-blue-600 text-white text-sm py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-200">
                                       Lihat Progress
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif($kota)
            <div class="bg-red-200 text-red-800 p-4 rounded-lg text-center mb-10 shadow-md">
                Tidak ada data pekerjaan yang ditemukan untuk kota {{ $kota }}.
            </div>
        @endif
    </div>
@endsection
