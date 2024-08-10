<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah pengguna
        $jumlahUser = User::count();

        // Menghitung jumlah kursus
        $jumlahKursus = Kursus::count();

        // Menghitung jumlah materi
        $jumlahMateri = Materi::count();

        return view('admin.dashboard', compact('jumlahUser', 'jumlahKursus', 'jumlahMateri'));
    }
}
