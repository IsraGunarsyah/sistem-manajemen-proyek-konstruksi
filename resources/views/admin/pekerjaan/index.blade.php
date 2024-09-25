@extends('admin.layouts.app')

@section('title', 'Daftar Pekerjaan Pengawas')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Daftar Pekerjaan Pengawas</h1>

<!-- Membuat container tabel agar bisa di-scroll secara horizontal pada layar kecil -->
<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-md shadow-md">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="py-3 px-6 font-semibold">Nama Pengawas</th>
                <th class="py-3 px-6 font-semibold">Email Pengawas</th>
                <th class="py-3 px-6 font-semibold">Nama Pekerjaan</th>
                <th class="py-3 px-6 font-semibold">Tanggal Mulai</th>
                <th class="py-3 px-6 font-semibold">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @php
                    // Hitung berapa jumlah pekerjaan yang dimiliki oleh user ini
                    $rowCount = $user->pekerjaans->count();
                @endphp

                <!-- Tampilkan hanya satu kali nama dan email user untuk banyak pekerjaan -->
                @if ($rowCount > 0)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6 whitespace-nowrap" rowspan="{{ $rowCount }}">{{ $user->name }}</td>
                        <td class="py-4 px-6 whitespace-nowrap" rowspan="{{ $rowCount }}">{{ $user->email }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->pekerjaans[0]->nama_pekerjaan }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->pekerjaans[0]->tanggal_mulai)->format('d - M - Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $user->pekerjaans[0]->status }}</td>
                    </tr>
                    <!-- Tampilkan pekerjaan lainnya jika ada -->
                    @for ($i = 1; $i < $rowCount; $i++)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->pekerjaans[$i]->nama_pekerjaan }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->pekerjaans[$i]->tanggal_mulai)->format('d - M - Y') }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $user->pekerjaans[$i]->status }}</td>
                        </tr>
                    @endfor
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
