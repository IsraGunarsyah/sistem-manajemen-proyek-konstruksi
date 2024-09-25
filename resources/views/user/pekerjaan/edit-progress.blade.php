@extends('user.layouts.app')

@section('title', 'Edit Progress')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Edit Progress - {{ $pekerjaan->nama_pekerjaan }}</h1>

<!-- Form Edit Progress -->
<form action="{{ route('user.pekerjaan.update-progress', [$pekerjaan->id, $progress->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label for="tanggal_waktu_pengerjaan" class="block text-sm font-medium text-gray-700">Tanggal dan Waktu Pengerjaan</label>
            <input type="datetime-local" name="tanggal_waktu_pengerjaan" id="tanggal_waktu_pengerjaan" 
    value="{{ \Carbon\Carbon::parse($progress->tanggal_waktu_pengerjaan)->format('Y-m-d\TH:i') }}" 
    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>

        </div>

        <div>
            <label for="kondisi_cuaca" class="block text-sm font-medium text-gray-700">Kondisi Cuaca</label>
            <input type="text" name="kondisi_cuaca" id="kondisi_cuaca" value="{{ $progress->kondisi_cuaca }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <div>
            <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
            <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" value="{{ $progress->jenis_pekerjaan }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="Aktif" {{ $progress->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Selesai" {{ $progress->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Progress</button>
    </div>
</form>

@endsection
