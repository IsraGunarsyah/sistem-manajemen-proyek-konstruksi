@extends('admin.layouts.app')

@section('title', 'Dokumentasi Progress')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Dokumentasi Progress - {{ $progress->pekerjaan->nama_pekerjaan }}</h1>

<!-- Button Kembali -->
<a href="{{ route('admin.laporan.detail', $progress->pekerjaan->id) }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 mb-4 inline-block">
    Kembali
</a>

<!-- Jika ada dokumentasi foto -->
@if ($progress->foto)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach (json_decode($progress->foto) as $foto)
            <div class="border rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $foto) }}" alt="Dokumentasi Progress" class="w-full h-auto object-cover">
            </div>
        @endforeach
    </div>
@else
    <div class="bg-red-500 text-white p-4 rounded-md">
        Tidak ada dokumentasi untuk progress ini.
    </div>
@endif

@endsection
