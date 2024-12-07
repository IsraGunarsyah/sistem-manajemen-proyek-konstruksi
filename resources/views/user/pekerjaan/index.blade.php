@extends('user.layouts.app')

@section('title', 'Data Pekerjaan')

@section('content')
<h1 class="text-3xl font-extrabold text-[#1B1B48] mb-6">Data Pekerjaan</h1>

@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
        <p class="font-bold">Berhasil!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('user.pekerjaan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nama Pekerjaan -->
        <div class="relative">
            <label for="nama_pekerjaan" class="block text-sm font-medium text-gray-800">Nama Pekerjaan</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-briefcase text-gray-400 mr-3"></i>
                <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white"
                    placeholder="Masukkan nama pekerjaan" required>
            </div>
        </div>

        <!-- Kota -->
        <div class="relative">
            <label for="kota" class="block text-sm font-medium text-gray-800">Kota</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-city text-gray-400 mr-3"></i>
                <select name="kota" id="kota" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white" required>
                    <option value="" disabled selected>Pilih Kota</option>
                    <option value="Bontang Utara">Bontang Utara</option>
                    <option value="Bontang Barat">Bontang Barat</option>
                    <option value="Bontang Selatan">Bontang Selatan</option>
                </select>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="relative">
            <label for="lokasi" class="block text-sm font-medium text-gray-800">Lokasi</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-map-marker-alt text-gray-400 mr-3"></i>
                <input type="text" name="lokasi" id="lokasi" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white"
                    placeholder="Masukkan lokasi pekerjaan" required>
            </div>
        </div>

        <!-- Deskripsi Pekerjaan -->
        <div class="relative md:col-span-2">
            <label for="deskripsi" class="block text-sm font-medium text-gray-800">Deskripsi Pekerjaan</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-pencil-alt text-gray-400 mr-3"></i>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white"
                    placeholder="Deskripsikan pekerjaan..."></textarea>
            </div>
        </div>

        <!-- Tanggal Mulai -->
        <div class="relative">
            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-800">Tanggal Mulai</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-calendar-alt text-gray-400 mr-3"></i>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white"
                    required>
            </div>
        </div>

        <!-- SubKontraktor -->
        <div class="relative">
            <label for="subkontraktor" class="block text-sm font-medium text-gray-800">SubKontraktor</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-user-tie text-gray-400 mr-3"></i>
                <input type="text" name="subkontraktor" id="subkontraktor" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white"
                    placeholder="Masukkan nama subkontraktor">
            </div>
        </div>

        <!-- Status -->
        <div class="relative">
            <label for="status" class="block text-sm font-medium text-gray-800">Status</label>
            <div class="flex items-center mt-2">
                <i class="fas fa-check-circle text-gray-400 mr-3"></i>
                <select name="status" id="status" 
                    class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 p-3 bg-white" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button type="submit" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition ease-in-out duration-300">
            Simpan
        </button>
    </div>
</form>
@endsection
