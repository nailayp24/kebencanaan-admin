{{-- resources/views/admin/posko-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Tambah Posko Bencana')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="mdi mdi-home-plus text-primary me-2"></i>Tambah Data Posko Bencana
                        </h4>
                    </div>
                    <a href="{{ route('posko-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('posko-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-alert-circle-outline me-2 fs-4"></i>
                                <div>
                                    <strong class="mb-1">Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-1 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Kejadian Bencana dengan Select2 -->
                    <div class="mb-4">
                        <label for="kejadian_id" class="form-label fw-semibold">
                            <i class="mdi mdi-alert-circle-outline me-1"></i>
                            Kejadian Bencana <span class="text-danger">*</span>
                        </label>

                        @if($kejadian->count() > 0)
                            <div class="position-relative">
                                <select class="form-select select2-compact @error('kejadian_id') is-invalid @enderror"
                                        id="kejadian_id" name="kejadian_id" required
                                        data-placeholder="Pilih kejadian bencana">
                                    <option value=""></option>
                                    @foreach($kejadian as $item)
                                        <option value="{{ $item->kejadian_id }}"
                                            {{ old('kejadian_id') == $item->kejadian_id ? 'selected' : '' }}>
                                            {{ $item->jenis_bencana }} - {{ $item->lokasi_text }} ({{ $item->tanggal->format('d/m/Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih kejadian bencana yang terkait dengan posko ini
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning p-3">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-alert me-2 fs-4"></i>
                                    <div>
                                        <strong>Tidak ada data kejadian bencana</strong>
                                        <p class="mb-0 small">Silakan tambah kejadian bencana terlebih dahulu</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-plus-circle me-1"></i> Tambah Kejadian Bencana
                                    </a>
                                </div>
                            </div>
                        @endif

                        @error('kejadian_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Informasi Posko -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">
                                    <i class="mdi mdi-home me-1"></i>
                                    Nama Posko <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama') }}"
                                       placeholder="Contoh: Posko Utama Gunung Semeru" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="penanggung_jawab" class="form-label fw-semibold">
                                    <i class="mdi mdi-account-badge me-1"></i>
                                    Penanggung Jawab <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                       id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                                       placeholder="Masukkan nama penanggung jawab" required>
                                @error('penanggung_jawab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">
                            <i class="mdi mdi-map-marker me-1"></i>
                            Alamat Posko <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3"
                                  placeholder="Masukkan alamat lengkap posko" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="mb-4">
                        <label for="kontak" class="form-label fw-semibold">
                            <i class="mdi mdi-phone me-1"></i>
                            Kontak <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                               id="kontak" name="kontak" value="{{ old('kontak') }}"
                               placeholder="Contoh: 081234567890 atau (021) 1234567" required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text small mt-1">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Bisa berupa nomor telepon atau kombinasi
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-4">
                        <label for="foto_posko" class="form-label fw-semibold">
                            <i class="mdi mdi-camera me-1"></i>
                            Foto Posko
                        </label>
                        <input type="file" class="form-control @error('foto_posko.*') is-invalid @enderror"
                               id="foto_posko" name="foto_posko[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text small mt-1">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Bisa upload beberapa file sekaligus (foto JPG/PNG atau dokumen PDF). Maksimal 2MB per file.
                        </div>
                        @error('foto_posko.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-close me-1"></i> Batal
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
@endsection

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<style>
/* Select2 Compact Style */
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.select2-container--bootstrap-5 .select2-selection {
    min-height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem;
    font-size: 0.875rem;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    padding-left: 0.5rem;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    font-size: 0.875rem;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #0d6efd;
    color: white;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background-color: #e9ecef;
    color: #212529;
}

/* Compact form styling */
.card {
    border-radius: 0.5rem;
}

.form-control, .form-select {
    border-radius: 0.375rem;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.form-label {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.btn {
    border-radius: 0.375rem;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.alert {
    border-radius: 0.375rem;
    font-size: 0.875rem;
}
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 with compact settings
    $('.select2-compact').select2({
        theme: 'bootstrap-5',
        width: '100%',
        allowClear: true,
        placeholder: function() {
            return $(this).data('placeholder');
        },
        dropdownParent: $('.card-body'),
        language: {
            noResults: function() {
                return "Data tidak ditemukan";
            },
            searching: function() {
                return "Mencari...";
            },
            inputTooShort: function(args) {
                return "Masukkan minimal " + args.minimum + " karakter";
            }
        }
    });

    // Auto focus on first input
    $('#nama').focus();

    // Form validation
    $('form').on('submit', function(e) {
        const kejadianId = $('#kejadian_id').val();
        if (!kejadianId) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Harap pilih kejadian bencana terlebih dahulu',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#0d6efd'
            });
            $('#kejadian_id').select2('open');
        }
    });

    // File input preview
    $('#foto_posko').on('change', function() {
        const files = this.files;
        const maxSize = 2 * 1024 * 1024; // 2MB
        let valid = true;
        let message = '';

        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                valid = false;
                message = `File "${files[i].name}" melebihi ukuran maksimal 2MB`;
                break;
            }

            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            if (!validTypes.includes(files[i].type)) {
                valid = false;
                message = `File "${files[i].name}" harus berupa JPG, PNG, atau PDF`;
                break;
            }
        }

        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Format File Salah',
                text: message,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#dc3545'
            });
            $(this).val('');
        }
    });
});
</script>
@endpush
