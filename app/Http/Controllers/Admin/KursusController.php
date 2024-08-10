<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KursusController extends Controller
{
    public function index(Request $request)
    {
        $data = Kursus::get();

        $show_modal = $request->has('show_modal') && $request->get('show_modal') == 'true';

        return view('admin.kursus.index', compact('data', 'show_modal'));
    }

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
        $data = $kursus->findOrFail($id);

        $materis = $data->materis()->paginate(5);

        return view('admin.kursus.show', compact('data', 'materis'));
    }



    public function edit(Kursus $kursus, string $id)
    {
        $data = $kursus->findOrFail($id);

        return view('admin.kursus.edit', compact('data'));
    }

    public function update(Request $request, Kursus $kursus, string $id)
    {
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

        $kursus->update([
            'judul_kursus' => $request->input('judul_kursus'),
            'deskripsi_kursus' => $request->input('deskripsi_kursus'),
            'durasi_kursus' => $durasi, // Menyimpan durasi dalam menit
            'gambar_kursus' => $path,
        ]);

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
