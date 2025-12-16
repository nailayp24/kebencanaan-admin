@extends('layouts.admin.app')

@section('title', 'Tambah Distribusi Logistik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="mdi mdi-truck-delivery-plus text-primary me-2"></i>Tambah Distribusi Logistik
                        </h4>
                    </div>
                    <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('distribusi-logistik.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
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

                    <div class="row g-3">
                        <!-- Logistik dengan Select2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logistik_id" class="form-label fw-semibold">
                                    <i class="mdi mdi-package me-1"></i>
                                    Logistik <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2-compact @error('logistik_id') is-invalid @enderror"
                                        id="logistik_id" name="logistik_id" required
                                        data-placeholder="Pilih Logistik">
                                    <option value=""></option>
                                    @foreach($logistik as $item)
                                        <option value="{{ $item->logistik_id }}"
                                            data-stok="{{ $item->stok_tersedia }}"
                                            {{ old('logistik_id') == $item->logistik_id ? 'selected' : '' }}>
                                            {{ $item->nama_barang }} ({{ $item->satuan }}) - Stok: {{ number_format($item->stok_tersedia) }}
                                            @if($item->stok_tersedia <= 0)
                                                - <span class="text-danger">Stok Habis</span>
                                            @elseif($item->stok_tersedia < 10)
                                                - <span class="text-warning">Stok Menipis</span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small mt-1" id="stok-info">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih logistik untuk melihat stok tersedia
                                </div>
                                @error('logistik_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Posko dengan Select2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="posko_id" class="form-label fw-semibold">
                                    <i class="mdi mdi-home me-1"></i>
                                    Posko <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2-compact @error('posko_id') is-invalid @enderror"
                                        id="posko_id" name="posko_id" required
                                        data-placeholder="Pilih Posko">
                                    <option value=""></option>
                                    @foreach($posko as $item)
                                        <option value="{{ $item->posko_id }}" {{ old('posko_id') == $item->posko_id ? 'selected' : '' }}>
                                            {{ $item->nama }} - {{ Str::limit($item->alamat, 50) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('posko_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih posko tujuan distribusi
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Tanggal Distribusi -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-semibold">
                                    <i class="mdi mdi-calendar me-1"></i>
                                    Tanggal Distribusi <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                       id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label fw-semibold">
                                    <i class="mdi mdi-counter me-1"></i>
                                    Jumlah <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                       id="jumlah" name="jumlah" value="{{ old('jumlah') }}"
                                       min="1" step="1" placeholder="0" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Jumlah yang akan didistribusikan
                                </div>
                            </div>
                        </div>

                        <!-- Penerima -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="penerima" class="form-label fw-semibold">
                                    <i class="mdi mdi-account me-1"></i>
                                    Penerima <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('penerima') is-invalid @enderror"
                                       id="penerima" name="penerima" value="{{ old('penerima') }}"
                                       placeholder="Nama penerima" required>
                                @error('penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Bukti Distribusi -->
                    <div class="mb-4">
                        <label for="bukti_distribusi" class="form-label fw-semibold">
                            <i class="mdi mdi-camera me-1"></i>
                            Bukti Distribusi
                        </label>
                        <input type="file" class="form-control @error('bukti_distribusi.*') is-invalid @enderror"
                               id="bukti_distribusi" name="bukti_distribusi[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text small mt-1">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Upload bukti distribusi (foto atau dokumen PDF). Bisa multiple files. Maksimal 2MB per file.
                        </div>
                        @error('bukti_distribusi.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
                        <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-close me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-1"></i> Simpan
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

/* Styling untuk option dengan status stok */
.select2-results__option .text-danger,
.select2-results__option .text-warning {
    font-weight: 500;
}

.select2-selection__rendered .text-danger,
.select2-selection__rendered .text-warning {
    font-weight: 500;
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

.form-text {
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Stok info styling */
#stok-info .text-success {
    font-weight: 600;
}
#stok-info .text-danger {
    font-weight: 600;
}
#stok-info .text-warning {
    font-weight: 600;
}
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for logistik
    $('#logistik_id').select2({
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
        },
        templateResult: function(data) {
            if (!data.id) {
                return data.text;
            }
            var $result = $('<span>' + data.text + '</span>');
            return $result;
        }
    });

    // Initialize Select2 for posko
    $('#posko_id').select2({
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

    // Update stok info based on selected logistik
    function updateStokTersedia() {
        const select = $('#logistik_id');
        const selectedOption = select.find('option:selected');
        const stokInfo = $('#stok-info');
        const jumlahInput = $('#jumlah');

        if (selectedOption.val()) {
            const stok = selectedOption.data('stok') || 0;
            let message = `<i class="mdi mdi-information-outline me-1"></i> Stok tersedia: `;

            if (stok <= 0) {
                message += `<span class="text-danger">${stok} (Stok Habis)</span>`;
                jumlahInput.prop('disabled', true);
                jumlahInput.val('');
            } else if (stok < 10) {
                message += `<span class="text-warning">${stok} (Stok Menipis)</span>`;
                jumlahInput.prop('disabled', false);
                jumlahInput.attr('max', stok);
            } else {
                message += `<span class="text-success">${stok}</span>`;
                jumlahInput.prop('disabled', false);
                jumlahInput.attr('max', stok);
            }

            stokInfo.html(message);
        } else {
            stokInfo.html('<i class="mdi mdi-information-outline me-1"></i> Pilih logistik untuk melihat stok tersedia');
            jumlahInput.prop('disabled', false);
            jumlahInput.attr('max', '');
        }
    }

    // Call on select change
    $('#logistik_id').on('change', updateStokTersedia);

    // Call on page load
    updateStokTersedia();

    // Auto-focus on penerima
    $('#penerima').focus();

    // Validate jumlah input
    $('#jumlah').on('input', function() {
        const logistikSelect = $('#logistik_id');
        const selectedOption = logistikSelect.find('option:selected');
        const maxStok = selectedOption.data('stok') || 0;
        const currentValue = parseInt($(this).val()) || 0;

        if (currentValue > maxStok) {
            $(this).val(maxStok);
            Swal.fire({
                icon: 'warning',
                title: 'Jumlah Melebihi Stok',
                text: `Jumlah maksimal adalah ${maxStok} (stok tersedia)`,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#ffc107',
                timer: 3000,
                timerProgressBar: true
            });
        }
    });

    // File validation
    $('#bukti_distribusi').on('change', function() {
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
        const logistikId = $('#logistik_id').val();
        const poskoId = $('#posko_id').val();
        const jumlah = $('#jumlah').val();
        const selectedLogistik = $('#logistik_id option:selected');
        const maxStok = selectedLogistik.data('stok') || 0;

        // Validate logistik
        if (!logistikId) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Harap pilih logistik terlebih dahulu',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#0d6efd'
            });
            $('#logistik_id').select2('open');
            return;
        }

        // Validate posko
        if (!poskoId) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Harap pilih posko terlebih dahulu',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#0d6efd'
            });
            $('#posko_id').select2('open');
            return;
        }

        // Validate stok
        if (maxStok <= 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Stok Tidak Tersedia',
                text: 'Logistik yang dipilih stoknya sudah habis',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#dc3545'
            });
            return;
        }

        if (parseInt(jumlah) > maxStok) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Jumlah Melebihi Stok',
                text: `Jumlah distribusi (${jumlah}) melebihi stok tersedia (${maxStok})`,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#dc3545'
            });
            $('#jumlah').focus();
        }
    });

    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    $('#tanggal').attr('min', today);
});
</script>
@endpush
