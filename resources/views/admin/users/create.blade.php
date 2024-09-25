<!-- resources/views/admin/users/create.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Registrasi Akun User')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Registrasi Akun User</h1>

    <form action="{{ route('admin.registerUser.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md focus:outline-none" value="{{ old('name') }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:outline-none" value="{{ old('email') }}" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded-md focus:outline-none" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-md focus:outline-none" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Registrasi</button>
    </form>
@endsection
