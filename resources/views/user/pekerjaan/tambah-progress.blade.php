@extends('user.layouts.app')

@section('title', 'Tambah Progress')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-xl">

    <h1 class="text-4xl font-bold text-[#333] text-center mb-8">Tambah Progress Pekerjaan</h1>

    <form method="POST" action="{{ route('user.pekerjaan.simpan-progress', $pekerjaan->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-8">

            <!-- Nama Pekerjaan -->
            <div>
                <label for="nama_pekerjaan" class="block text-2xl font-semibold text-[#333]">Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" value="{{ $pekerjaan->nama_pekerjaan }}" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-2xl font-semibold text-[#333]">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ $pekerjaan->lokasi }}" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Jenis Pekerjaan -->
            <div>
                <label for="jenis_pekerjaan" class="block text-2xl font-semibold text-[#333]">Jenis Pekerjaan</label>
                <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" value="{{ old('jenis_pekerjaan', $pekerjaan->jenis_pekerjaan) }}" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Jumlah Tiang -->
            <div>
                <label for="jumlah_tiang" class="block text-2xl font-semibold text-[#333]">Jumlah Tiang</label>
                <input type="number" name="jumlah_tiang" id="jumlah_tiang" value="{{ old('jumlah_tiang') }}" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Tanggal dan Waktu Pengerjaan -->
            <div>
                <label for="tanggal_waktu_pengerjaan" class="block text-2xl font-semibold text-[#333]">Tanggal dan Waktu Pengerjaan</label>
                <input type="datetime-local" name="tanggal_waktu_pengerjaan" id="tanggal_waktu_pengerjaan" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Kondisi Cuaca -->
            <div>
                <label for="kondisi_cuaca" class="block text-2xl font-semibold text-[#333]">Kondisi Cuaca</label>
                <input type="text" name="kondisi_cuaca" id="kondisi_cuaca" class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Foto Dokumentasi -->
            <div>
                <label for="foto" class="block text-2xl font-semibold text-[#333]">Foto Dokumentasi</label>
                <input type="file" name="foto[]" id="foto" multiple class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
                <input type="file" name="foto[]" id="foto" multiple class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
                <input type="file" name="foto[]" id="foto" multiple class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
                <input type="file" name="foto[]" id="foto" multiple class="mt-4 w-full p-5 border border-[#ddd] rounded-lg bg-white text-xl text-[#333] focus:outline-none focus:ring-2 focus:ring-[#4caf50] focus:border-[#4caf50] transition">
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center">
                <button type="submit" class="w-full py-4 px-8 bg-[#4caf50] text-white font-semibold text-2xl rounded-lg shadow-md transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#388e3c] focus:ring-opacity-50">
                    Simpan Progress
                </button>
            </div>

        </div>
    </form>
</div>
@endsection
