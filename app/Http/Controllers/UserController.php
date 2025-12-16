<?php
namespace App\Http\Controllers;
// tes
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    // **CEK APAKAH USER ADALAH SUPER ADMIN**
    if (Auth::user()->role !== 'super_admin') {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    $searchableColumns = ['name', 'email'];
    $filterableColumns = ['role', 'email_verified_at']; // Tambahkan 'role' di sini

    $query = User::query();

    // Handle search
    if ($request->filled('search')) {
        $query->where(function($q) use ($request, $searchableColumns) {
            foreach ($searchableColumns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
            }
        });
    }

    // Handle filter role - TAMBAHKAN INI
    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    // Handle filter verification status
    if ($request->filled('email_verified_at')) {
        if ($request->email_verified_at === 'verified') {
            $query->whereNotNull('email_verified_at');
        } elseif ($request->email_verified_at === 'not_verified') {
            $query->whereNull('email_verified_at');
        }
    }



    $dataUser = $query->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('pages.user.index', compact('dataUser'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // **CEK APAKAH USER ADALAH SUPER ADMIN**
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // **CEK APAKAH USER ADALAH SUPER ADMIN**
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,user',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
            'profile_picture.image' => 'File harus berupa gambar',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
   {
    // **CEK APAKAH USER ADALAH SUPER ADMIN ATAU SEDANG MELIHAT DATA SENDIRI**
    $authUser = Auth::user();
    $user = User::findOrFail($id);

    // Cek apakah user memiliki akses
    if ($authUser->role !== 'super_admin' && $authUser->id != $id) {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('pages.user.show', compact('user'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // **CEK APAKAH USER ADALAH SUPER ADMIN**
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $dataUser = User::findOrFail($id);
        return view('pages.user.edit', compact('dataUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // **CEK APAKAH USER ADALAH SUPER ADMIN**
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = User::findOrFail($id);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,user',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
            'profile_picture.image' => 'File harus berupa gambar',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        } elseif ($request->input('remove_profile_picture') == '1') {
            // Hapus foto jika user memilih untuk menghapus
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
                $user->profile_picture = null;
            }
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Perubahan Data User Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // **CEK APAKAH USER ADALAH SUPER ADMIN**
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = User::findOrFail($id);

        // Cek apakah user sedang login
        if ($user->id === auth()->id()) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // Hapus profile picture jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus');
    }
}
