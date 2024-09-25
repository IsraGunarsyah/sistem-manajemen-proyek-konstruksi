@extends('admin.layouts.app')

@section('title', 'Detail Progress')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Detail Progress - {{ $pekerjaan->nama_pekerjaan }}</h1>

<!-- Button Kembali -->
<a href="{{ route('admin.laporan') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 mb-4 inline-block">
    Kembali
</a>

<!-- Cek apakah pekerjaan memiliki progress -->
@if ($pekerjaan->progress->isEmpty())
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
                    <th class="py-3 px-6 font-semibold">Jenis Pekerjaan</th>
                    <th class="py-3 px-6 font-semibold">Deskripsi</th>
                    <th class="py-3 px-6 font-semibold">Subkontraktor</th>
                    <th class="py-3 px-6 font-semibold">Status</th>
                    <th class="py-3 px-6 font-semibold">Foto Dokumentasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pekerjaan->progress as $progress)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($progress->tanggal_waktu_pengerjaan)->format('d - M - Y H:i') }}</td>
                        <td class="py-4 px-6">{{ $progress->kondisi_cuaca }}</td>
                        <td class="py-4 px-6">{{ $progress->jenis_pekerjaan }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->deskripsi }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->subkontraktor }}</td>
                        <td class="py-4 px-6">{{ $progress->status }}</td>
                        <!-- Menampilkan user yang menginput -->
                        <td class="py-4 px-6">
                            @if ($progress->foto)
                            <a href="{{ route('admin.progress.dokumentasi', $progress->id) }}" target="_blank">Lihat Dokumentasi</a>

                            
                            
                            @else
                                Tidak ada dokumentasi
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
