<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem.']);
        }

        // Simpan email di session untuk digunakan di halaman reset
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset.form');
    }

    public function showResetPasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi telah berakhir, silakan masukkan email kembali.']);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // Hapus email dari session setelah berhasil
            session()->forget('reset_email');

            return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
        }

        return redirect()->route('password.request')->withErrors(['email' => 'Terjadi kesalahan, silakan coba lagi.']);
    }
}
