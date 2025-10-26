{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.admin.auth')

@section('content')
<div class="auth-logo">
    <h2>Login - Bina Desa</h2>
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
        <label class="form-label">Email</label>
        <div class="input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
            <span class="input-group-text">
                <i class="mdi mdi-email"></i>
            </span>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" placeholder="*********" required>
            <span class="input-group-text">
                <i class="mdi mdi-lock"></i>
            </span>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- CHECKBOX "INGAT SAYA" --}}
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember"
                   style="width: 18px; height: 18px; margin-right: 8px;" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember" style="cursor: pointer;">
                Ingat saya
            </label>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">Login</button>
    </div>

    <div class="text-center mt-3">
        <span class="text-muted">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="text-decoration-none">Buat akun baru</a>
    </div>
</form>
@endsection
