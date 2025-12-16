@extends('layouts.admin.auth')

@section('title', 'Daftar - Sistem Tanggap Darurat Bencana')

@section('content')
<div class="auth-logo">
    <div class="text-center mb-3">
        <img src="{{ asset('assets-admin/images/logo/logo-bencana.png') }}"
             alt="Logo SIGANA"
             width="100"
             class="rounded-lg">
    </div>
    <h4 class="text-center fw-bold mb-2" style="font-size: 1.1rem;">Daftar Akun Baru</h4>
    <p class="text-center text-muted mb-3" style="font-size: 0.9rem;">Bergabung dengan Sistem Tanggap Darurat</p>
</div>

<form method="POST" action="{{ route('register.submit') }}">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger rounded-lg mb-3 p-2" style="font-size: 0.85rem;">
            <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 1rem;"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label fw-medium mb-1" style="font-size: 0.9rem;">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
                <i class="mdi mdi-account-outline" style="font-size: 1rem;"></i>
            </span>
            <input type="text" class="form-control rounded-end-lg @error('name') is-invalid @enderror"
                   name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus
                   style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
            @error('name')
                <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium mb-1" style="font-size: 0.9rem;">Email</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
                <i class="mdi mdi-email-outline" style="font-size: 1rem;"></i>
            </span>
            <input type="email" class="form-control rounded-end-lg @error('email') is-invalid @enderror"
                   name="email" placeholder="Masukkan email" value="{{ old('email') }}" required
                   style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
            @error('email')
                <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium mb-1" style="font-size: 0.9rem;">Password</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
                <i class="mdi mdi-lock-outline" style="font-size: 1rem;"></i>
            </span>
            <input type="password" class="form-control rounded-end-lg @error('password') is-invalid @enderror"
                   name="password" placeholder="Buat password" required
                   style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
            @error('password')
                <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium mb-1" style="font-size: 0.9rem;">Konfirmasi Password</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
                <i class="mdi mdi-lock-check" style="font-size: 1rem;"></i>
            </span>
            <input type="password" class="form-control rounded-end-lg"
                   name="password_confirmation" placeholder="Konfirmasi password" required
                   style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
        </div>
    </div>

    {{-- Tambahkan input role jika register oleh Super Admin --}}
    @if(Auth::check() && Auth::user()->role == 'super_admin')
    <div class="mb-3">
        <label class="form-label fw-medium mb-1" style="font-size: 0.9rem;">Role</label>
        <select class="form-select rounded-lg @error('role') is-invalid @enderror" name="role"
                style="font-size: 0.9rem; padding: 0.6rem 0.8rem; height: 40px;">
            <option value="user" selected>User Biasa</option>
            <option value="admin">Administrator</option>
            <option value="super_admin">Super Admin</option>
        </select>
        @error('role')
            <div class="invalid-feedback" style="font-size: 0.8rem;">{{ $message }}</div>
        @enderror
        <small class="text-muted d-block mt-1" style="font-size: 0.8rem;">
            <i class="mdi mdi-information-outline me-1" style="font-size: 0.9rem;"></i>
            Hanya Super Admin yang bisa menentukan role saat registrasi
        </small>
    </div>
    @else
    <input type="hidden" name="role" value="user">
    @endif

    <div class="mb-3">
        <div class="form-check d-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required
                   style="width: 1rem; height: 1rem; margin-right: 0.4rem;">
            <label class="form-check-label m-0" for="terms" style="font-size: 0.9rem;">
                Saya menyetujui syarat dan ketentuan
            </label>
        </div>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary rounded-lg" style="font-size: 0.9rem; padding: 0.6rem; height: 40px;">
            <i class="mdi mdi-account-plus me-2" style="font-size: 1rem;"></i>Daftar Akun
        </button>
    </div>

    <div class="auth-footer pt-2 border-top">
        <span class="text-muted" style="font-size: 0.9rem;">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="text-decoration-none fw-medium" style="font-size: 0.9rem;">
            Login di sini
        </a>
    </div>
</form>
@endsection
