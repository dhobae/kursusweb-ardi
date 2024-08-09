<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Materi::with('kursus')->get();
        $data_kursus = Kursus::get();

        return view('admin.materi.index', compact('data', 'data_kursus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $id . '|max:255',
        //     'new_password' => 'required|string|min:8',
        // ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $validated = $request->validate([
            'judul_materi' => 'required',
            'deskripsi_materi' => 'required',
            'kursus_id' => 'required',
            'link_embed_materi' => 'required',
        ]);

        if ($validated) {
            Materi::create($validated);
        }

        return back()->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Ditambah',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi, string $id)
    {
        $data = $materi->with('kursus')->findOrFail($id);
        return view('admin.materi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi, string $id)
    {
        $data = $materi->with('kursus')->findOrFail($id);
        $data_kursus = Kursus::get();
        return view('admin.materi.edit', compact('data', 'data_kursus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $materi = Materi::findOrFail($id);

        $validated = $request->validate([
            'judul_materi' => 'required',
            'deskripsi_materi' => 'required',
            'kursus_id' => 'required',
            'link_embed_materi' => 'required',
        ]);

        if ($validated) {
            $materi->update($validated);
        }

        return back()->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Diedit',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi, string $id)
    {
        $result = $materi->findOrFail($id);

        if ($result) {
            $result->delete();
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
