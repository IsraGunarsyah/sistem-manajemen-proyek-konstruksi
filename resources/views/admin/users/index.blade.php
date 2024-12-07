@extends('admin.layouts.app')

@section('title', 'Daftar User')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">Daftar User</h1>

        <!-- Tambahkan div dengan overflow-x-auto agar tabel dapat di-scroll pada layar kecil -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full bg-white border-separate border-spacing-0">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="py-4 px-6 text-sm font-semibold text-gray-600 border-b">Nama</th>
                        <th class="py-4 px-6 text-sm font-semibold text-gray-600 border-b">Email</th>
                        <th class="py-4 px-6 text-sm font-semibold text-gray-600 border-b">Nomor Telepon</th>
                        <th class="py-4 px-6 text-sm font-semibold text-gray-600 border-b">Tanggal Registrasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm text-gray-800 border-b">{{ $user->name }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800 border-b">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-sm text-gray-800 border-b">{{ $user->phone }}</td>
                            <td class="py-4 px-6 text-sm text-gray-600 border-b">{{ \Carbon\Carbon::parse($user->created_at)->format('d - M - Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
