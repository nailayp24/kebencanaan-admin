@extends('layouts.admin.app')

@section('title', 'Ubah Foto Profil')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">
                    <i class="mdi mdi-camera me-2"></i>Ubah Foto Profil
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

                <div class="text-center mb-4">
                    <!-- Current Profile Picture -->
                    <div class="mb-3">
                        @if($user->profile_picture)
                            <img src="{{ Storage::url($user->profile_picture) }}"
                                 alt="{{ $user->name }}"
                                 id="previewImage"
                                 class="rounded-circle border border-4 border-info"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div id="previewPlaceholder"
                                 class="rounded-circle bg-gradient-info d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 200px; height: 200px; font-size: 64px; background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);">
                                <span class="text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <img id="previewImage"
                                 class="rounded-circle border border-4 border-info d-none"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @endif
                    </div>

                    <p class="text-muted">
                        Ukuran maksimal: 2MB<br>
                        Format: JPG, PNG, GIF, WebP
                    </p>
                </div>

                <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="profile_picture" class="form-label">
                            <i class="mdi mdi-cloud-upload me-1"></i> Pilih Foto Baru
                        </label>
                        <input type="file"
                               class="form-control @error('profile_picture') is-invalid @enderror"
                               id="profile_picture"
                               name="profile_picture"
                               accept="image/*"
                               onchange="previewFile(this)">
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <div>
                            @if($user->profile_picture)
                                <a href="{{ route('profile.photo.delete') }}"
                                   class="btn btn-danger me-2"
                                   onclick="event.preventDefault();
                                            if(confirm('Yakin ingin menghapus foto profil?')) {
                                                document.getElementById('delete-photo-form').submit();
                                            }">
                                    <i class="mdi mdi-delete me-1"></i> Hapus Foto
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Simpan Foto
                            </button>
                        </div>
                    </div>
                </form>

                @if($user->profile_picture)
                    <form id="delete-photo-form" action="{{ route('profile.photo.delete') }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFile(input) {
    const preview = document.getElementById('previewImage');
    const placeholder = document.getElementById('previewPlaceholder');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            if (placeholder) {
                placeholder.classList.add('d-none');
            }
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }

        reader.readAsDataURL(file);
    }
}

// Preview saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('profile_picture');

    fileInput.addEventListener('change', function() {
        previewFile(this);
    });
});
</script>
@endpush
