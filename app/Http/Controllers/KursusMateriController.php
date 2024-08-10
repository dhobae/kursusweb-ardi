<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Materi;
use Illuminate\Http\Request;

class KursusMateriController extends Controller
{
    public function index(Request $request, Kursus $kursus)
    {
        $query = $kursus->with('materis');

        // Jika ada kata kunci pencarian, tambahkan ke query
        if ($request->has('search')) {
            $query->where('judul_kursus', 'like', '%' . $request->input('search') . '%');
        }

        $data = $query->paginate(5);

        return view('kursus', compact('data'));
    }
}
