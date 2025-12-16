{{-- resources/views/pages/donasi-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Tambah Donasi Bencana')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="mdi mdi-hand-heart-plus text-primary me-2"></i>Tambah Data Donasi Bencana
                        </h4>
                    </div>
                    <a href="{{ route('donasi-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('donasi-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-alert-circle-outline me-2 fs-4"></i>
                                <div>
                                    <strong class="mb-1">Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-1 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row g-3">
                        <!-- Kejadian Bencana dengan Select2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kejadian_id" class="form-label fw-semibold">
                                    <i class="mdi mdi-alert-circle-outline me-1"></i>
                                    Kejadian Bencana <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2-compact @error('kejadian_id') is-invalid @enderror"
                                    id="kejadian_id" name="kejadian_id" required
                                    data-placeholder="Pilih Kejadian Bencana">
                                    <option value=""></option>
                                    @foreach($kejadian as $item)
                                        <option value="{{ $item->kejadian_id }}" {{ old('kejadian_id') == $item->kejadian_id ? 'selected' : '' }}>
                                            {{ $item->jenis_bencana }} - {{ $item->tanggal_formatted }} - {{ Str::limit($item->lokasi_text, 30) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kejadian_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih kejadian bencana yang terkait dengan donasi ini
                                </div>
                            </div>
                        </div>

                        <!-- Nama Donatur -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="donatur_nama" class="form-label fw-semibold">
                                    <i class="mdi mdi-account me-1"></i>
                                    Nama Donatur <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('donatur_nama') is-invalid @enderror"
                                    id="donatur_nama" name="donatur_nama" value="{{ old('donatur_nama') }}"
                                    placeholder="Masukkan nama donatur" required>
                                @error('donatur_nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Jenis Donasi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis" class="form-label fw-semibold">
                                    <i class="mdi mdi-tag me-1"></i>
                                    Jenis Donasi <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('jenis') is-invalid @enderror"
                                    id="jenis" name="jenis" required>
                                    <option value="">Pilih Jenis Donasi</option>
                                    <option value="uang" {{ old('jenis') == 'uang' ? 'selected' : '' }}>Uang</option>
                                    <option value="barang" {{ old('jenis') == 'barang' ? 'selected' : '' }}>Barang</option>
                                    <option value="jasa" {{ old('jenis') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nilai Donasi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nilai" class="form-label fw-semibold">
                                    <i class="mdi mdi-cash me-1"></i>
                                    Nilai Donasi
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control @error('nilai') is-invalid @enderror"
                                        id="nilai" name="nilai" value="{{ old('nilai') }}"
                                        placeholder="Masukkan nilai donasi"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': '.', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'">
                                </div>
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Isi nilai untuk donasi uang, kosongkan untuk barang/jasa. Format otomatis ribuan.
                                </div>
                                @error('nilai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-semibold">
                            <i class="mdi mdi-text me-1"></i>
                            Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                            id="keterangan" name="keterangan" rows="3"
                            placeholder="Keterangan tambahan tentang donasi (jenis barang, jenis jasa, dll)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bukti Donasi -->
                    <div class="mb-4">
                        <label for="bukti_donasi" class="form-label fw-semibold">
                            <i class="mdi mdi-file-document me-1"></i>
                            Bukti Donasi
                        </label>
                        <input type="file" class="form-control @error('bukti_donasi.*') is-invalid @enderror"
                               id="bukti_donasi" name="bukti_donasi[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text small mt-1">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Upload bukti donasi (foto struk, kwitansi, atau dokumen). Bisa multiple files. Maksimal 2MB per file.
                        </div>
                        @error('bukti_donasi.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-outline-secondary">
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
<!-- Inputmask CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/jquery.inputmask.min.css" />

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

/* Compact Form Styling */
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

.input-group-text {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

/* Input mask styling */
.inputmask {
    text-align: right;
}

.form-text {
    font-size: 0.75rem;
    margin-top: 0.25rem;
}
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Inputmask JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/jquery.inputmask.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for kejadian bencana
    $('#kejadian_id').select2({
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

    // Initialize input mask for nilai donasi
    $('#nilai').inputmask({
        'alias': 'numeric',
        'groupSeparator': '.',
        'autoGroup': true,
        'digits': 0,
        'digitsOptional': false,
        'prefix': '',
        'placeholder': '0'
    });

    // Toggle readonly for nilai input based on jenis
    $('#jenis').on('change', function() {
        const nilaiInput = $('#nilai');
        const nilaiContainer = nilaiInput.closest('.mb-3');

        if (this.value !== 'uang') {
            nilaiInput.val('');
            nilaiInput.prop('readonly', true);
            nilaiContainer.addClass('opacity-50');
        } else {
            nilaiInput.prop('readonly', false);
            nilaiContainer.removeClass('opacity-50');
        }
    });

    // Trigger change event on page load
    $('#jenis').trigger('change');

    // File validation
    $('#bukti_donasi').on('change', function() {
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

    // Auto focus on donatur nama
    $('#donatur_nama').focus();
});
</script>
@endpush
