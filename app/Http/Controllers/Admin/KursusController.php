<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KursusController extends Controller
{
    public function index()
    {
        $data = Kursus::get();
        return view('admin.kursus.index', compact('data'));
    }

    public function create()
    {
        //
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255', // Nama harus diisi, hanya huruf dan spasi, maksimal 255 karakter
        //     'email' => 'required|email|unique:users,email|max:255', // Email harus valid, unik, dan maksimal 255 karakter
        //     'password' => 'required|string|min:8', // Password harus diisi, minimal 8 karakter
        // ]);
        //  'foto_kostum' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'judul_kursus' => 'required',
    //         'deskripsi_kursus' => 'required',
    //         'gambar_kursus' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    //         'durasi_jam' => 'required|integer|min:0|max:24',
    //         'durasi_menit' => 'required|integer|min:0|max:59',
    //     ]);

    //     // Menggabungkan jam dan menit menjadi durasi dalam menit
    //     $durasi = ($request->durasi_jam * 60) + $request->durasi_menit;

    //     // Validasi tambahan untuk memastikan durasi tidak 0
    //     if ($durasi === 0) {

    //         // return;
    //     }

    //     if ($request->hasFile('gambar_kursus')) {
    //         $path = $request->file('gambar_kursus')->store('gambar_kursus');
    //     } else {
    //         $path = 'No Images';
    //     }

    //     Kursus::create([
    //         'judul_kursus' => $validated['judul_kursus'],
    //         'deskripsi_kursus' => $validated['deskripsi_kursus'],
    //         'durasi_kursus' => $durasi, // Menyimpan durasi dalam menit
    //         'gambar_kursus' => $path,
    //     ]);

    //     return 'berhasil';
    // }

    public function store(Request $request)
    {
        // Validasi umum dan kustom
        $validator = Validator::make($request->all(), [
            'judul_kursus' => 'required',
            'deskripsi_kursus' => 'required',
            'gambar_kursus' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'durasi_jam' => 'required|integer|min:0|max:24',
            'durasi_menit' => 'required|integer|min:0|max:59',
        ]);

        // Validasi kustom untuk durasi
        $validator->after(function ($validator) use ($request) {
            $durasi = ($request->durasi_jam * 60) + $request->durasi_menit;

            if ($durasi === 0) {
                $validator->errors()->add('durasi', 'Durasi harus ada minimal 1 menit.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Proses penyimpanan jika validasi lolos
        if ($request->hasFile('gambar_kursus')) {
            $path = $request->file('gambar_kursus')->store('gambar_kursus');
        } else {
            $path = 'No Images';
        }

        Kursus::create([
            'judul_kursus' => $request->judul_kursus,
            'deskripsi_kursus' => $request->deskripsi_kursus,
            'durasi_kursus' => ($request->durasi_jam * 60) + $request->durasi_menit, // Menyimpan durasi dalam menit
            'gambar_kursus' => $path,
        ]);

        // return 'berhasil';
        return back()->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Ditambahkan',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }


    public function show(Kursus $kursus, string $id)
    {

        $data = $kursus->with('materis')->findOrFail($id);
        return view('admin.kursus.show', compact('data'));
    }

    public function edit(Kursus $kursus, string $id)
    {
        $data = $kursus->findOrFail($id);

        return view('admin.kursus.edit', compact('data'));
    }

    public function update(Request $request, Kursus $kursus, string $id)
    {
        // return $request;

        $kursus = Kursus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul_kursus' => 'required',
            'deskripsi_kursus' => 'required',
            'gambar_kursus' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // gambar bisa nullable
            'durasi_jam' => 'required|integer|min:0|max:24',
            'durasi_menit' => 'required|integer|min:0|max:59',
        ]);

        // Perhitungan durasi dalam menit
        $durasi = ($request->durasi_jam * 60) + $request->durasi_menit;

        // Validasi kustom untuk durasi yang tidak boleh 0
        $validator->after(function ($validator) use ($durasi) {
            if ($durasi === 0) {
                $validator->errors()->add('durasi', 'Durasi harus ada minimal 1 menit.');
            }
        });

        // Jika validasi gagal, kembalikan ke form dengan error
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // Perbarui gambar jika ada gambar baru
        if ($request->hasFile('gambar_kursus')) {
            Storage::delete($kursus->gambar_kursus);
            $path = $request->file('gambar_kursus')->store('gambar_kursus');
        } else {
            $path = $kursus->gambar_kursus; // Tetap gunakan gambar lama jika tidak ada yang baru
        }

        // Perbarui data kursus
        $kursus->update([
            'judul_kursus' => $request->input('judul_kursus'),
            'deskripsi_kursus' => $request->input('deskripsi_kursus'),
            'durasi_kursus' => $durasi, // Menyimpan durasi dalam menit
            'gambar_kursus' => $path,
        ]);

        // return 'berhasil diupdate';
        return back()->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Diupdate',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }

    public function destroy(Kursus $kursus, string $id)
    {
        $result = $kursus->findOrFail($id);

        if ($result) {
            Storage::delete($result->gambar_kursus);
            $result->delete();
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
