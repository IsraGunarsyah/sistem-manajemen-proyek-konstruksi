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
        <div>
            <label for="nama_pekerjaan" class="block text-sm font-semibold text-gray-700">Nama Pekerjaan</label>
            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]"
                placeholder="Masukkan nama pekerjaan" required>
        </div>
        
        <!-- Lokasi -->
        <div>
            <label for="lokasi" class="block text-sm font-semibold text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]"
                placeholder="Masukkan lokasi pekerjaan" required>
        </div>
        
        <!-- Deskripsi Pekerjaan -->
        <div class="md:col-span-2">
            <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi Pekerjaan</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]"
                placeholder="Deskripsikan pekerjaan..."></textarea>
        </div>
        
        <!-- Tanggal Mulai -->
        <div>
            <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]"
                required>
        </div>
        
        <!-- SubKontraktor -->
        <div>
            <label for="subkontraktor" class="block text-sm font-semibold text-gray-700">SubKontraktor</label>
            <input type="text" name="subkontraktor" id="subkontraktor" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]"
                placeholder="Masukkan nama subkontraktor">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
            <select name="status" id="status" 
                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-150 ease-in-out bg-[#D9D9D9]" required>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
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
