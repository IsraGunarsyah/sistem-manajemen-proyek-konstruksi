@extends('user.layouts.app')

@section('title', 'Riwayat Laporan')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-[#1B1B48] mb-8">Riwayat Laporan</h1>

    @if ($pekerjaans->isEmpty())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-md">
            <p class="font-semibold">Tidak ada pekerjaan yang selesai ditemukan.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-gray-50 rounded-lg shadow-md">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-400 text-gray-800">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Nama Pekerjaan</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Lokasi</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide">Tanggal Mulai</th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wide text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pekerjaans as $pekerjaan)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="py-4 px-6 text-sm font-medium text-gray-700">
                                {{ $pekerjaan->nama_pekerjaan }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600">
                                {{ $pekerjaan->lokasi }}
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('user.pekerjaan.riwayat-laporan.detail', $pekerjaan->id) }}" 
                                   class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg text-sm hover:bg-blue-600 hover:shadow-lg transition-all duration-300">
                                   Lihat Detail Progres
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
