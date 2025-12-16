{{-- resources/views/pages/user/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')

    {{-- CEK APAKAH USER ADALAH SUPER ADMIN --}}
    @if (Auth::check() && Auth::user()->role == 'super_admin')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="mdi mdi-account-edit me-2"></i>Edit Data User
                        </h4>
                    </div>
                    <div class="card-body">

                        {{-- Flash Messages --}}
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.update', $dataUser->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
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
                                            <img id="profilePicturePreview"
                                                src="{{ $dataUser->profile_picture ? Storage::url($dataUser->profile_picture) : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiByeD0iNzUiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTc1IDk0Qzg3LjAxNSA5NCA5Ni44NSA4NC4xNSA5Ni44NSA3Mi4xMjVDOTYuODUgNjAuMSA4Ny4wMTUgNTAuMjUgNzUgNTAuMjVDNjIuOTg1IDUwLjI1IDUzLjE1IDYwLjEgNTMuMTUgNzIuMTI1QzUzLjE1IDg0LjE1IDYyLjk4NSA5NCA3NSA5NFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTc1IDEwNi41QzU2LjI3MTkgMTA2LjUgNDEuMjUgMTIxLjUzNyA0MS4yNSAxNDAuMjVIMTA4Ljc1QzEwOC43NSAxMjEuNTM3IDkzLjcyODEgMTA2LjUgNzUgMTA2LjVaIiBmaWxsPSIjRDVENkRCIi8+Cjwvc3ZnPgo=' }}"
                                                class="rounded-circle border"
                                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #e9ecef;">
                                        </div>


                                        <!-- Upload Button -->
                                        <div class="mb-3">
                                            <label for="profile_picture" class="btn btn-outline-primary btn-sm">
                                                <i class="mdi mdi-camera me-1"></i> Ganti Foto
                                            </label>
                                            <input type="file" class="form-control d-none" id="profile_picture"
                                                name="profile_picture" accept="image/*" onchange="previewImage(this)">
                                            <div class="form-text small mt-2">
                                                Maks: 2MB<br>Format: JPG, PNG, GIF, WebP
                                            </div>

                                            <!-- Hapus Foto -->
                                            @if ($dataUser->profile_picture)
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        onclick="removeProfilePicture()">
                                                        <i class="mdi mdi-delete me-1"></i> Hapus Foto
                                                    </button>
                                                    <input type="hidden" name="remove_profile_picture"
                                                        id="removeProfilePicture" value="0">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Fields -->
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name', $dataUser->name) }}"
                                                    placeholder="Masukkan nama lengkap" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email', $dataUser->email) }}"
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
                                                <label for="password" class="form-label">Password
                                                    <span class="text-muted small">(Kosongkan jika tidak diubah)</span>
                                                </label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" placeholder="Masukkan password baru">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Konfirmasi password baru">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select @error('role') is-invalid @enderror"
                                                    id="role" name="role" required>
                                                    <option value="">Pilih Role</option>
                                                    <option value="super_admin"
                                                        {{ old('role', $dataUser->role) == 'super_admin' ? 'selected' : '' }}>
                                                        Super Admin
                                                    </option>
                                                    <option value="admin"
                                                        {{ old('role', $dataUser->role) == 'admin' ? 'selected' : '' }}>
                                                        Administrator
                                                    </option>
                                                    <option value="user"
                                                        {{ old('role', $dataUser->role) == 'user' ? 'selected' : '' }}>
                                                        User Biasa
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    <i class="mdi mdi-information-outline"></i>
                                                    Role menentukan hak akses pengguna dalam sistem
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Info Akun</label>
                                                <div class="form-control bg-light">
                                                    <div class="d-flex justify-content-between">
                                                        <span>ID: <strong>{{ $dataUser->id }}</strong></span>
                                                        <span
                                                            class="badge bg-{{ $dataUser->role == 'super_admin' ? 'danger' : ($dataUser->role == 'admin' ? 'warning' : 'info') }}">
                                                            {{ ucfirst(str_replace('_', ' ', $dataUser->role)) }}
                                                        </span>
                                                    </div>
                                                    <div class="mt-2">
                                                        Dibuat: {{ $dataUser->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
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
                                    <i class="mdi mdi-content-save me-1"></i> Update Data
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
                <p class="text-muted">Hanya <strong>Super Admin</strong> yang dapat mengedit user.</p>
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

            function removeProfilePicture() {
                const preview = document.getElementById('profilePicturePreview');
                const defaultImage = "{{ asset('assets/images/default-avatar.png') }}";
                const removeField = document.getElementById('removeProfilePicture');

                preview.src = defaultImage;
                removeField.value = "1";

                // Reset file input
                document.getElementById('profile_picture').value = '';

                alert('Foto profil akan dihapus saat Anda menyimpan perubahan.');
            }

            // Preview image on click
            document.getElementById('profilePicturePreview').addEventListener('click', function() {
                document.getElementById('profile_picture').click();
            });
        </script>
    @endpush

@endsection
