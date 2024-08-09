<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Events\UserCreated;

class UserController extends Controller
{

    public function index(User $user)
    {
        $data = User::with('roles')->get();
        return view('admin.user.index', compact('data',));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama harus diisi, hanya huruf dan spasi, maksimal 255 karakter
            'email' => 'required|email|unique:users,email|max:255', // Email harus valid, unik, dan maksimal 255 karakter
            'password' => 'required|string|min:8', // Password harus diisi, minimal 8 karakter
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->assignRole('user');

        return redirect()->route('user-list')->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Ditambahkan',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }

    public function edit(User $user, string $id)
    {
        $data = $user->findOrFail($id);

        if ($data) {
            return view('admin.user.edit', compact('data'));
        }
    }

    public function update(Request $request, User $user, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|max:255',
            'new_password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('user-list')->with(
            'notifikasi',
            [
                'text' => 'Data Berhasil Diedit',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }

    public function destroy(User $user, string $id)
    {
        $result = $user->findOrFail($id);

        if ($result) {
            $result->delete();
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
