<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Nama Admin',
            'email' => 'admin@example.com',
            'password' =>'password123', // Gunakan Hash::make untuk mengenkripsi password
        ]);
    }
}
