{{-- resources/views/pages/auth/register.blade.php --}}
@extends('layouts.admin.auth')

@section('title', 'Daftar - Sistem Tanggap Darurat Bencana')

@section('content')
<div class="auth-logo">
    <div class="text-center mb-4">
        <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}"
             alt="Logo Bina Desa"
             width="60"
             class="rounded-circle">
    </div>
    <h4 class="text-center">Daftar Akun Baru</h4>
    <p class="text-center text-muted">Bergabung dengan Sistem Tanggap Darurat</p>
</div>

<form method="POST" action="{{ route('register.submit') }}">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="mdi mdi-account-outline"></i>
            </span>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="mdi mdi-email-outline"></i>
            </span>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="mdi mdi-lock-outline"></i>
            </span>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" placeholder="Buat password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="mdi mdi-lock-check"></i>
            </span>
            <input type="password" class="form-control"
                   name="password_confirmation" placeholder="Konfirmasi password" required>
        </div>
    </div>



    {{-- Tambahkan input role jika register oleh Super Admin --}}
    @if(Auth::check() && Auth::user()->role == 'super_admin')
    <div class="mb-3">
        <label class="form-label">Role</label>
        <select class="form-select @error('role') is-invalid @enderror" name="role">
            <option value="user" selected>User Biasa</option>
            <option value="admin">Administrator</option>
            <option value="super_admin">Super Admin</option>
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="text-muted">
            <i class="mdi mdi-information-outline"></i>
            Hanya Super Admin yang bisa menentukan role saat registrasi
        </small>
    </div>
    @else
    <input type="hidden" name="role" value="user">
    @endif

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
                Saya menyetujui syarat dan ketentuan
            </label>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="mdi mdi-account-plus me-2"></i>Daftar Akun
        </button>
    </div>

    <div class="auth-footer">
        <span class="text-muted">Sudah punya akun?</span>
        <a href="{{ route('auth.login') }}" class="text-decoration-none">Login di sini</a>
    </div>
</form>
@endsection
