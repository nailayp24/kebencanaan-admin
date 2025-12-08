<?php
//tes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
          // Gunakan Auth::check() untuk cek apakah sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah login.');
        }
        return view('pages.auth.login');
    }

    // Memproses form login
       public function login(Request $request)
    {
        // Validasi input - UPDATE UNTUK EMAIL & PASSWORD
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/' // harus ada huruf kapital
            ]
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        // Cari user di database berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {

            // **Auth::login()
            Auth::login($user);

            // Simpan last login di session
            session(['last_login' => now()->format('d/m/Y H:i:s')]);

            // Simpan username di session tambahan
            session(['username' => $user->name]);

            // Redirect ke dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        // Kalau gagal login
        return back()->withErrors([
            'login' => 'Email atau password salah!'
        ])->withInput();
    }




public function showRegisterForm()
{
    // Jika sudah login, redirect ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard')
            ->with('info', 'Anda sudah login.');
    }

    return view('pages.auth.register');
}

public function register(Request $request)
{
    // Validasi data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'terms' => 'required'
    ], [
        'name.required' => 'Nama lengkap harus diisi',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password harus diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak sesuai',
        'terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Terjadi kesalahan validasi');
    }

    // Create user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user' // Default role untuk register publik
    ]);

    // Auto login setelah registrasi (opsional)
    // Auth::login($user);

    return redirect()->route('auth.login')
        ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
}

    // Logout user
   public function logout(Request $request)
     {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
