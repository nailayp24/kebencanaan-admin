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

        // Username & password yang sudah ditentukan
        $validUsername = "naila";
        $validPassword = "Nanai123";

        // Cek apakah input sama dengan hardcode
        if ($request->username === $validUsername && $request->password === $validPassword) {
            // kalau cocok → ke halaman sukses
            return view('auth.success', [
                'username' => $request->username
            ]);
        }

        // kalau tidak cocok → balik ke login dengan pesan error
        return back()->withErrors([
            'login' => 'Username atau password salah!'
        ])->withInput();
    }
}
