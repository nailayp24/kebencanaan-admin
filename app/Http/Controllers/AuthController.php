<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('auth.login-form');
    }

    // Memproses form login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/' // harus ada huruf kapital
            ]
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        // Username & password yang valid
        $validUsername = "naila";
        $validPassword = "Nanai123";

        // Cek login
        if ($request->username === $validUsername && $request->password === $validPassword) {
            // Simpan session login sederhana
            session(['logged_in' => true, 'username' => $request->username]);

            // Redirect ke dashboard
            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $request->username . '!');
        }

        // Kalau gagal login
        return back()->withErrors([
            'login' => 'Username atau password salah!'
        ])->withInput();
    }

    // Logout user
    public function logout()
    {
        session()->flush();
        return redirect()->route('login.index')->with('success', 'Berhasil logout.');
    }
}
