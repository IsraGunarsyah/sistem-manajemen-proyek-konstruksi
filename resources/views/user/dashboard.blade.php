@extends('user.layouts.app')

@section('title', 'Dashboard Pengawas')

@section('content')
<!-- Tambahkan style untuk animasi -->
<style>
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes slideInRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        0% {
            transform: scale(0.9);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 1s ease-out;
    }

    .slide-in-right {
        animation: slideInRight 1s ease-out;
    }

    .zoom-in {
        animation: zoomIn 1s ease-out;
    }

    .fade-in-up {
        animation: fadeInUp 1s ease-out;
    }
</style>

<h1 class="text-3xl font-bold text-[#1B1B48] mb-8 fade-in">Dashboard Pengawas</h1>

<!-- Container untuk Gambar dan Teks -->
<div class="relative bg-white rounded-lg shadow-lg overflow-hidden zoom-in">
    <!-- Gambar -->
    <img src="{{ asset('img/dashboard.png') }}" alt="Pengawas" class="w-full h-auto">

    <!-- Teks di atas gambar -->
    <div class="absolute top-5 right-5 slide-in-right">
        <div class="bg-gradient-to-r from-gray-900 to-gray-700 bg-opacity-80 text-white p-4 rounded-md shadow-md">
            <h2 class="text-2xl font-bold">Hallo, Mr. {{ Auth::user()->name }}!</h2>
            <p class="text-lg">Selamat datang di dashboard pengawasan proyek.</p>
        </div>
    </div>
</div>

<!-- Data Pekerjaan -->
<div class="mt-10 bg-white p-6 rounded-lg shadow-lg fade-in-up">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Data Pekerjaan</h2>
    
    @if($pekerjaans->isEmpty())
        <div class="bg-red-500 text-white text-center py-4 rounded-md animate-pulse">
            Tidak ada pekerjaan yang sedang berjalan.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 rounded-lg">
                <thead class="bg-gradient-to-r from-gray-700 to-gray-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold">Pekerjaan</th>
                        <th class="py-3 px-6 text-left font-semibold">Kota</th>
                        <th class="py-3 px-6 text-left font-semibold">Lokasi</th>
                        <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                        <th class="py-3 px-6 text-left font-semibold">Kontraktor</th>
                        <th class="py-3 px-6 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pekerjaans as $pekerjaan)
                        <tr class="border-b hover:bg-gray-100 transition duration-200 ease-in-out">
                            <td class="py-4 px-6 text-gray-700">{{ $pekerjaan->nama_pekerjaan }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $pekerjaan->kota }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $pekerjaan->lokasi }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $pekerjaan->subkontraktor ?? '[Nama Kontraktor]' }}</td>
                            <td class="py-4 px-6">
                                <span 
                                    class="px-3 py-1 text-sm font-semibold rounded-full
                                    {{ $pekerjaan->status === 'Selesai' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ $pekerjaan->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
