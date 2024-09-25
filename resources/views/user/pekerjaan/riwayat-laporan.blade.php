@extends('user.layouts.app')

@section('title', 'Riwayat Laporan')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Riwayat Laporan</h1>

@if ($pekerjaans->isEmpty())
    <div class="bg-red-500 text-white p-4 rounded-md">
        Tidak ada pekerjaan yang selesai ditemukan.
    </div>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-md shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 font-semibold text-left">Nama Pekerjaan</th>
                    <th class="py-3 px-6 font-semibold text-left">Lokasi</th>
                    <th class="py-3 px-6 font-semibold text-left">Tanggal Mulai</th>
                    <th class="py-3 px-6 font-semibold text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pekerjaans as $pekerjaan)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6">{{ $pekerjaan->nama_pekerjaan }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->lokasi }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}</td>
                        <td class="py-4 px-6">
                            <div class="flex justify-end lg:justify-center">
                                <a href="{{ route('user.pekerjaan.riwayat-laporan.detail', $pekerjaan->id) }}" 
                                   class="bg-blue-500 text-white text-sm md:text-base py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                                   Lihat Detail Progres
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
