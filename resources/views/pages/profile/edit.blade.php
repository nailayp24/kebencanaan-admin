@extends('layouts.admin.app')

@section('title', 'Edit Profil')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="mdi mdi-account-edit me-2"></i>Edit Profil
                </h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle-outline me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Foto Profil -->
                    <div class="col-md-4 text-center">
                        <div class="mb-4">
                            @if($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}"
                                     alt="{{ $user->name }}"
                                     class="rounded-circle border border-4 border-primary shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center mx-auto shadow"
                                     style="width: 150px; height: 150px; font-size: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <span class="text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.photo.edit') }}" class="btn btn-primary">
                                <i class="mdi mdi-camera me-1"></i> Ubah Foto
                            </a>
                            @if($user->profile_picture)
                                <form action="{{ route('profile.photo.delete') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100"
                                            onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                        <i class="mdi mdi-delete me-1"></i> Hapus Foto
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Form Edit -->
                    <div class="col-md-8">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

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
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control bg-light"
                                       value="{{ ucfirst(str_replace('_', ' ', $user->role)) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Bergabung</label>
                                <input type="text" class="form-control bg-light"
                                       value="{{ $user->created_at->format('d/m/Y H:i') }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Akun</label>
                                <div>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="mdi mdi-check-circle me-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="mdi mdi-alert-circle me-1"></i> Belum Verifikasi
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
