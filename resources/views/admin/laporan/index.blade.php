@extends('admin.layouts.app')

@section('title', 'Laporan Pekerjaan')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Laporan Pekerjaan</h1>

<div class="bg-white p-6 rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-4">Daftar Pekerjaan</h2>

    <!-- Tambahkan overflow-x-auto untuk membuat tabel dapat di-scroll di layar kecil -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-md shadow-md">
            <thead>
                <tr>
                    <th class="py-3 px-6 font-semibold">Nama Pekerjaan</th>
                    <th class="py-3 px-6 font-semibold">Pengawas</th>
                    <th class="py-3 px-6 font-semibold">Tanggal Mulai</th>
                    <th class="py-3 px-6 font-semibold">Status</th>
                    <th class="py-3 px-6 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pekerjaans as $pekerjaan)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $pekerjaan->nama_pekerjaan }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $pekerjaan->user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $pekerjaan->status }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <a href="{{ route('admin.laporan.detail', $pekerjaan->id) }}" 
                               class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-300">
                               Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
