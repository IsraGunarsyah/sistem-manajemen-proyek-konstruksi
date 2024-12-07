@extends('admin.layouts.app')

@section('title', 'Daftar Pekerjaan Pengawas')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-semibold text-gray-900 mb-8 text-center">Daftar Pekerjaan Pengawas</h1>

        <!-- Membuat container tabel agar bisa di-scroll secara horizontal pada layar kecil -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-separate border-spacing-0">
                <thead class="bg-gray-100 text-left">
                    <tr class="border-b border-gray-200">
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600">Nama Pengawas</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600">Email Pengawas</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600">Nama Pekerjaan</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600">Tanggal Mulai</th>
                        <th class="py-4 px-6 font-semibold text-sm text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $previousCity = null; // Menyimpan kota sebelumnya
                    @endphp

                    @foreach ($users as $user)
                        @foreach ($user->pekerjaans as $pekerjaan)
                            <!-- Cek jika kota berbeda dari pekerjaan sebelumnya -->
                            @if ($previousCity !== $pekerjaan->kota)
                                <!-- Tampilkan kota sekali per grup pekerjaan di kota yang sama -->
                                <tr class="border-b bg-gray-50">
                                    <td colspan="6" class="py-4 px-6 text-lg font-semibold text-gray-800">{{ $pekerjaan->kota }}</td>
                                </tr>
                            @endif

                            <tr class="border-b hover:bg-gray-50">
                                @if ($previousCity !== $pekerjaan->kota)
                                    <!-- Tampilkan nama pengawas dan email hanya sekali untuk pekerjaan pertama di kota ini -->
                                    <td class="py-4 px-6 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-800 font-medium">{{ $user->email }}</td>
                                @else
                                    <!-- Jika sudah ada pekerjaan sebelumnya di kota yang sama, kosongkan kolom nama dan email -->
                                    <td class="py-4 px-6 text-sm text-gray-600"></td>
                                    <td class="py-4 px-6 text-sm text-gray-600"></td>
                                @endif

                                <!-- Kolom pekerjaan -->
                                <td class="py-4 px-6 text-sm text-gray-600">{{ $pekerjaan->nama_pekerjaan }}</td>
                                <td class="py-4 px-6 text-sm text-gray-600">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_mulai)->format('d - M - Y') }}</td>
                                <td class="py-4 px-6 text-sm font-semibold text-center
                                    @if($pekerjaan->status == 'Selesai')
                                        text-green-500
                                    @elseif($pekerjaan->status == 'Dalam Proses')
                                        text-yellow-500
                                    @else
                                        text-red-500
                                    @endif
                                ">{{ $pekerjaan->status }}</td>
                            </tr>

                            <!-- Update kota yang terakhir diproses -->
                            @php
                                $previousCity = $pekerjaan->kota;
                            @endphp
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
