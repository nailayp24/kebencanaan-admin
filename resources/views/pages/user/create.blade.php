{{-- resources/views/pages/user/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')

{{-- CEK APAKAH USER ADALAH SUPER ADMIN --}}
@if(Auth::check() && Auth::user()->role == 'super_admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-account-plus me-2"></i>Tambah Data User
                </h4>
            </div>
            <div class="card-body">

                {{-- Flash Messages --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="row">
                        <!-- Foto Profil Preview dan Upload -->
                        <div class="col-md-3 mb-4">
                            <div class="text-center">
                                <!-- Preview Image -->
                                <div class="profile-picture-preview mb-3">
                                    <img id="profilePicturePreview" src="{{ asset('assets/images/default-avatar.png') }}"
                                         class="rounded-circle border"
                                         style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #e9ecef;">
                                </div>

                                <!-- Upload Button -->
                                <div class="mb-3">
                                    <label for="profile_picture" class="btn btn-outline-primary btn-sm">
                                        <i class="mdi mdi-camera me-1"></i> Upload Foto
                                    </label>
                                    <input type="file"
                                           class="form-control d-none"
                                           id="profile_picture"
                                           name="profile_picture"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <div class="form-text small mt-2">
                                        Maks: 2MB<br>Format: JPG, PNG, GIF, WebP
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}"
                                               placeholder="Masukkan email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password"
                                               placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control"
                                               id="password_confirmation" name="password_confirmation"
                                               placeholder="Konfirmasi password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select class="form-select @error('role') is-invalid @enderror"
                                                id="role" name="role" required>
                                            <option value="">Pilih Role</option>
                                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>
                                                Super Admin
                                            </option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Administrator
                                            </option>
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                                User Biasa
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            <i class="mdi mdi-information-outline"></i>
                                            Hanya Super Admin yang bisa membuat user baru
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@else
{{-- TAMPILKAN PESAN ERROR UNTUK NON-SUPER ADMIN --}}
<div class="alert alert-danger">
    <div class="text-center py-5">
        <i class="mdi mdi-shield-alert" style="font-size: 72px; color: #dc3545;"></i>
        <h3 class="mt-4">Access Denied!</h3>
        <p class="text-muted">Hanya <strong>Super Admin</strong> yang dapat membuat user baru.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
            <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endif

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('profilePicturePreview');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
}

// Preview image on click
document.getElementById('profilePicturePreview').addEventListener('click', function() {
    document.getElementById('profile_picture').click();
});
</script>
@endpush

@endsection
