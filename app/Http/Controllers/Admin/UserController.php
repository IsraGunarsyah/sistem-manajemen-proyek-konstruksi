<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user yang sudah registrasi
    public function index()
    {
        $users = User::where('role', 'user')->get(); 
        return view('admin.users.index', compact('users'));

    }

    // Menampilkan form registrasi user baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Proses registrasi user baru
    public function store(Request $request)
    {
        // Validasi input termasuk nomor telepon
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        

        // Simpan user ke database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password'],
        ]);

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User berhasil didaftarkan');
    }
}
