@extends('layouts.admin.auth')

@section('title', 'Login - Sistem Tanggap Darurat Bencana')

@section('content')
<div class="auth-logo">
    <div class="text-center mb-4">
        <img src="{{ asset('assets-admin/images/logo/logo-bencana.png') }}"
             alt="Logo SIGANA"
             width="150"
             class="rounded-lg">
    </div>
    <h4 class="text-center fw-bold mb-3">Login Administrator</h4>
    <p class="text-center text-muted mb-4">Masuk ke Sistem Tanggap Darurat</p>

    {{-- Info jika sudah login --}}
    @if(Auth::check())
    <div class="alert alert-info rounded-lg mb-4">
        <i class="mdi mdi-information-outline me-2" style="font-size: 1.2rem;"></i>
        Anda sudah login sebagai: <strong>{{ Auth::user()->name }}</strong>
    </div>
    @endif
</div>

<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-lg mb-4" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 1.2rem;"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-lg mb-4" role="alert">
            <i class="mdi mdi-check-circle-outline me-2" style="font-size: 1.2rem;"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <label class="form-label fw-medium mb-2" style="font-size: 1rem;">Email Administrator</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 1rem; padding: 0.875rem 1rem;">
                <i class="mdi mdi-email-outline" style="font-size: 1.2rem;"></i>
            </span>
            <input type="email" class="form-control rounded-end-lg @error('email') is-invalid @enderror"
                   name="email" placeholder="email@sitaga.id" value="{{ old('email') }}" required autofocus
                   style="font-size: 1rem; padding: 0.875rem 1rem; height: 48px;">
            @error('email')
                <div class="invalid-feedback" style="font-size: 0.9rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label fw-medium mb-2" style="font-size: 1rem;">Password</label>
        <div class="input-group">
            <span class="input-group-text rounded-start-lg" style="font-size: 1rem; padding: 0.875rem 1rem; height: 48px;">
                <i class="mdi mdi-lock-outline" style="font-size: 1.2rem;"></i>
            </span>
            <input type="password" class="form-control rounded-end-lg @error('password') is-invalid @enderror"
                   name="password" placeholder="Masukkan password" required
                   style="font-size: 1rem; padding: 0.875rem 1rem; height: 48px;">
            @error('password')
                <div class="invalid-feedback" style="font-size: 0.9rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <div class="form-check d-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="remember" name="remember"
                   {{ old('remember') ? 'checked' : '' }}
                   style="width: 1.2rem; height: 1.2rem; margin-right: 0.5rem;">
            <label class="form-check-label m-0" for="remember" style="font-size: 1rem;">
                Ingat saya
            </label>
        </div>
    </div>

    <div class="d-grid gap-2 mb-4">
        <button type="submit" class="btn btn-primary btn-lg rounded-lg" style="font-size: 1rem; padding: 0.875rem; height: 48px;">
            <i class="mdi mdi-login me-2" style="font-size: 1.2rem;"></i>Masuk ke Sistem
        </button>
    </div>

    <div class="auth-footer pt-3 border-top">
        <span class="text-muted" style="font-size: 1rem;">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="text-decoration-none fw-medium" style="font-size: 1rem;">
            Buat akun baru
        </a>
    </div>
</form>
@endsection
