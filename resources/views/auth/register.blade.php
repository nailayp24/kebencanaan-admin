{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.admin.auth')

@section('content')
<div class="auth-logo">
    <h2>Daftar Akun Baru - Bina Desa</h2>
</div>

<form method="POST" action="{{ route('register.submit') }}">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group">
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
            <span class="input-group-text">
                <i class="mdi mdi-account"></i>
            </span>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
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

    <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   name="password_confirmation" placeholder="*********" required>
            <span class="input-group-text">
                <i class="mdi mdi-lock-check"></i>
            </span>
        </div>
    </div>

    {{-- CHECKBOX SYARAT & KETENTUAN --}}
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required
                   style="width: 18px; height: 18px; margin-right: 8px;">
            <label class="form-check-label" for="terms" style="cursor: pointer;">
                Saya menyetujui syarat dan ketentuan
            </label>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
    </div>

    <div class="text-center mt-3">
        <span class="text-muted">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
    </div>
</form>
@endsection
