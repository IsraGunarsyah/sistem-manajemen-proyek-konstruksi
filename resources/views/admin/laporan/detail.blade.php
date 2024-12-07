@extends('admin.layouts.app')

@section('title', 'Detail Progress')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detail Progress - {{ $pekerjaan->nama_pekerjaan }}</h1>

    <!-- Button Kembali -->
    <a href="{{ route('admin.laporan') }}" class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700 mb-6 inline-block transition duration-300 ease-in-out">
        Kembali
    </a>

    <!-- Cek apakah pekerjaan memiliki progress -->
    @if ($pekerjaan->progress->isEmpty())
        <div class="bg-red-600 text-white p-4 rounded-md mb-6">
            Tidak ada progress yang ditemukan untuk pekerjaan ini.
        </div>
    @else
        <div class="overflow-x-auto bg-white p-6 rounded-md shadow-lg">
            <table class="min-w-full bg-white table-auto border-collapse rounded-md shadow-md">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 font-semibold">Tanggal dan Waktu Pengerjaan</th>
                        <th class="py-3 px-6 font-semibold">Kondisi Cuaca</th>
                        <th class="py-3 px-6 font-semibold">Jenis Pekerjaan</th>
                        <th class="py-3 px-6 font-semibold">Deskripsi</th>
                        <th class="py-3 px-6 font-semibold">Subkontraktor</th>
                        <th class="py-3 px-6 font-semibold">Status</th>
                        <th class="py-3 px-6 font-semibold">Foto Dokumentasi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($pekerjaan->progress as $progress)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-4 px-6">{{ \Carbon\Carbon::parse($progress->tanggal_waktu_pengerjaan)->format('d - M - Y H:i') }}</td>
                            <td class="py-4 px-6">{{ $progress->kondisi_cuaca }}</td>
                            <td class="py-4 px-6">{{ $progress->jenis_pekerjaan }}</td>
                            <td class="py-4 px-6">{{ $pekerjaan->deskripsi }}</td>
                            <td class="py-4 px-6">{{ $pekerjaan->subkontraktor }}</td>
                            <td class="py-4 px-6">
                                @if ($progress->status == 'Selesai')
                                    <span class="text-green-600 font-semibold">Selesai</span>
                                @elseif ($progress->status == 'Dalam Proses')
                                    <span class="text-yellow-600 font-semibold">Dalam Proses</span>
                                @else
                                    <span class="text-red-600 font-semibold">Tertunda</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($progress->foto)
                                    <a href="{{ route('admin.progress.dokumentasi', $progress->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300" target="_blank">
                                        Lihat Dokumentasi
                                    </a>
                                @else
                                    <span class="text-gray-500">Tidak ada dokumentasi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
