<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // Menampilkan halaman login
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika email tidak terdaftar
            return back()->with('error', 'Email not registered. Please sign up.');
        }

        // Cek apakah password sesuai
        if (!Auth::attempt($credentials)) {
            // Jika password salah
            return back()->with('error', 'Incorrect password entered.');
        }

        // Jika login berhasil, regenerasi session
        $request->session()->regenerate();

        // Redirect sesuai role
        session()->flash('success', 'Berhasil login!');
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/weldone');
        }

        return redirect()->intended('/welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        // Hapus session dan redirect ke halaman login atau home
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectTo()
{
    return session('url.intended', '/'); // Kembali ke URL yang dimaksud atau ke homepage
}


}
