<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pekerjaan;

class AdminPekerjaanController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan pekerjaan terkait
        $users = User::with('pekerjaans')->get();

        return view('admin.pekerjaan.index', compact('users'));
    }
}


?>
