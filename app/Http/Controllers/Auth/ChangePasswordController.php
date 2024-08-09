<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('password.change.form')->with(
                'notifikasi',
                [
                    'text' => 'Current password does not match',
                    'icon' => 'error',
                    'title_alert' => 'Oops...',
                ]
            );
        }

        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->route('password.change.form')->with(
                'notifikasi',
                [
                    'text' => 'New password cannot be the same as the current password',
                    'icon' => 'error',
                    'title_alert' => 'Oops...',
                ]
            );
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        /** @var \App\Models\User $user **/
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with(
            'notifikasi',
            [
                'text' => 'Password successfully changed. Please log in with your new password.',
                'icon' => 'success',
                'title_alert' => 'Berhasil',
            ]
        );
    }
}
