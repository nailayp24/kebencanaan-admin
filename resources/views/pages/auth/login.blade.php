{{-- resources/views/pages/auth/login.blade.php --}}
@extends('layouts.admin.auth') {{-- PERUBAHAN: gunakan layout auth --}}

@section('title', 'Login - Bina Desa')

@section('content')
<div class="auth-logo">
    <div class="text-center mb-4">
        <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}" alt="Logo Bina Desa" width="80" class="rounded-circle shadow">
    </div>
    <h2>Sistem Bina Desa</h2>
    <p class="text-muted">Platform Pengelolaan Data Desa</p>
</div>

<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    {{-- Error Messages --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Email Administrator</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="mdi mdi-email-outline"></i>
            </span>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" placeholder="email@desa.example" value="{{ old('email') }}" required autofocus>
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
                   name="password" placeholder="Masukkan password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember"
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                <i class="mdi mdi-check-circle-outline me-1"></i>Ingat saya
            </label>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="mdi mdi-login me-2"></i>Masuk ke Sistem
        </button>
    </div>

    <div class="auth-footer">
        <span class="text-muted">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="text-decoration-none">Buat akun baru</a>
    </div>
</form>
@endsection
