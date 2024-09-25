<!-- resources/views/admin/users/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Daftar User')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Daftar User</h1>

    <!-- Tambahkan div dengan overflow-x-auto agar tabel dapat di-scroll pada layar kecil -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-md shadow-md">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-6 font-semibold border">Nama</th>
                    <th class="py-3 px-6 font-semibold border">Email</th>
                    <th class="py-3 px-6 font-semibold border">Nomor Telepon</th>
                    <th class="py-3 px-6 font-semibold border">Tanggal Registrasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-6 border">{{ $user->name }}</td>
                        <td class="py-3 px-6 border">{{ $user->email }}</td>
                        <td class="py-3 px-6 border">{{ $user->phone }}</td>
                        <td class="py-3 px-6 border">{{ \Carbon\Carbon::parse($user->created_at)->format('d - M - Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
