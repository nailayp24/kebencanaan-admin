{{-- resources/views/pages/auth/register.blade.php --}}
@extends('layouts.admin.auth') {{-- PERUBAHAN: gunakan layout auth --}}

@section('title', 'Daftar - Bina Desa')

@section('content')
<div class="auth-logo">
    <div class="text-center mb-4">
        <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}" alt="Logo Bina Desa" width="80" class="rounded-circle shadow">
    </div>
    <h2>Daftar Akun Baru</h2>
    <p class="text-muted">Bergabung dengan Sistem Bina Desa</p>
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
        <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
    </div>
</form>
@endsection
