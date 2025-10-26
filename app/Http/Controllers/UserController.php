<?php
namespace App\Http\Controllers;
// tes
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $dataUser = User::all();
        return view('admin.user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataUser = User::findOrFail($id);
        return view('admin.user.edit', compact('dataUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Perubahan Data User Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user sedang login
        if ($user->id === auth()->id()) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login process
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'))
                ->with('error', 'Terjadi kesalahan validasi');
        }

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput($request->except('password'))
                ->with('error', 'Login gagal');
        }

        // Cek password menggunakan Hash::check
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password yang dimasukkan salah.'])
                ->withInput($request->except('password'))
                ->with('error', 'Login gagal');
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        // Redirect ke dashboard
        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil! Selamat datang ' . $user->name);
    }

    /**
     * Handle logout process
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    public function showRegisterForm()
{
    return view('auth.register'); // Pastikan mengarah ke view yang benar
}

/**
 * Handle registration process
 */
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
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
}
}
