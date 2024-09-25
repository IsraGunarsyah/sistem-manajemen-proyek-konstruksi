@extends('user.layouts.app')

@section('title', 'Dashboard Pengawas')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Dashboard Pengawas</h1>

<!-- Container untuk Gambar dan Teks -->
<div class="relative bg-white p-6 rounded-md shadow-md">
    <!-- Gambar -->
    <img src="{{ asset('img/dashboard.png') }}" alt="Pengawas" class="w-full h-auto rounded-md">
    
    <!-- Teks di atas gambar -->
    <div class="absolute top-5 right-5 justify-center text-right">
        <div class="text-white bg-opacity-50 px-4 py-2 rounded-lg">
            <h2 class="text-2xl font-bold">Hallo, Mr. {{ Auth::user()->name }}!</h2>
            <p class="text-lg">Selamat datang di dashboard pengawasan proyek.</p>
        </div>
    </div>
</div>

<!-- Data Pekerjaan -->
<div class="mt-10">
    @if($pekerjaans->isEmpty())
        <div class="bg-red-500 text-white p-4 rounded-md">
            Tidak ada pekerjaan yang sedang berjalan.
        </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-md shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left font-semibold">Pekerjaan</th>
                    <th class="py-3 px-6 text-left font-semibold">Lokasi</th>
                    <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                    <th class="py-3 px-6 text-left font-semibold">Kontraktor</th>
                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pekerjaans as $pekerjaan)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6">{{ $pekerjaan->nama_pekerjaan }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->lokasi }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->subkontraktor ?? '[Nama Kontraktor]' }}</td>
                        <td class="py-4 px-6">{{ $pekerjaan->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
