<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    /**
     * Menangani proses otentikasi.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            // Pesan sukses ditambahkan di sini
            return redirect()->intended('/admin/detail-attendance')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'name' => 'username atau password yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('name');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}