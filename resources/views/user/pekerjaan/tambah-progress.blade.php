@extends('user.layouts.app')

@section('title', 'Tambah Progress')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Tambah Progress Baru - {{ $pekerjaan->nama_pekerjaan }}</h1>

<form method="POST" action="{{ route('user.pekerjaan.simpan-progress', $pekerjaan->id) }}" enctype="multipart/form-data">
    @csrf
    <!-- Nama Pekerjaan -->
    <div class="mb-4">
        <label for="nama_pekerjaan" class="block text-sm font-medium text-gray-700">Nama Pekerjaan</label>
        <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" value="{{ $pekerjaan->nama_pekerjaan }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" disabled>
    </div>

    <!-- Lokasi -->
    <div class="mb-4">
        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ $pekerjaan->lokasi }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" disabled>
    </div>

    <!-- Jenis Pekerjaan -->
<div class="mb-4">
    <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
    <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" value="{{ old('jenis_pekerjaan', $pekerjaan->jenis_pekerjaan) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
</div>


    <!-- Tanggal Waktu Pengerjaan -->
    <div class="mb-4">
        <label for="tanggal_waktu_pengerjaan" class="block text-sm font-medium text-gray-700">Tanggal dan Waktu Pengerjaan</label>
        <input type="datetime-local" name="tanggal_waktu_pengerjaan" id="tanggal_waktu_pengerjaan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <!-- Kondisi Cuaca -->
    <div class="mb-4">
        <label for="kondisi_cuaca" class="block text-sm font-medium text-gray-700">Kondisi Cuaca</label>
        <input type="text" name="kondisi_cuaca" id="kondisi_cuaca" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <!-- Foto Dokumentasi -->
    <div class="mb-4">
        <label for="foto" class="block text-sm font-medium text-gray-700">Foto Dokumentasi (Opsional)</label>
        <input type="file" name="foto[]" id="foto" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div class="mt-4">
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
            Simpan Progress
        </button>
    </div>
</form>

@endsection
