@extends('layouts.admin.app')

@section('title', 'Tambah Logistik Bencana')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="mdi mdi-package-variant-plus text-primary me-2"></i>Tambah Logistik Bencana
                        </h4>
                    </div>
                    <a href="{{ route('logistik-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('logistik-bencana.store') }}" method="POST">
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
                                            {{ $item->jenis_bencana }} - {{ $item->tanggal->format('d/m/Y') }} - {{ Str::limit($item->lokasi_text, 30) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kejadian_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih kejadian bencana yang terkait dengan logistik ini
                                </div>
                            </div>
                        </div>

                        <!-- Nama Barang -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label fw-semibold">
                                    <i class="mdi mdi-package me-1"></i>
                                    Nama Barang <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                       id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                                       placeholder="Contoh: Beras, Selimut, Air Mineral" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Satuan -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="satuan" class="form-label fw-semibold">
                                    <i class="mdi mdi-scale me-1"></i>
                                    Satuan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('satuan') is-invalid @enderror"
                                        id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($satuanDefault as $satuan)
                                        <option value="{{ $satuan }}" {{ old('satuan') == $satuan ? 'selected' : '' }}>
                                            {{ $satuan }}
                                        </option>
                                    @endforeach>
                                    <option value="custom" {{ old('satuan') && !in_array(old('satuan'), $satuanDefault) ? 'selected' : '' }}>
                                        Satuan Kustom
                                    </option>
                                </select>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Satuan Kustom -->
                        <div class="col-md-4" id="custom_satuan_container" style="display: none;">
                            <div class="mb-3">
                                <label for="satuan_custom" class="form-label fw-semibold">
                                    <i class="mdi mdi-form-textbox me-1"></i>
                                    Satuan Kustom
                                </label>
                                <input type="text" class="form-control"
                                       id="satuan_custom" name="satuan_custom"
                                       placeholder="Misal: Kaleng, Karung, Dus">
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Ketik satuan baru jika tidak ada di pilihan
                                </div>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stok" class="form-label fw-semibold">
                                    <i class="mdi mdi-counter me-1"></i>
                                    Stok <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                       id="stok" name="stok" value="{{ old('stok') }}"
                                       min="0" step="1" placeholder="0" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sumber -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sumber" class="form-label fw-semibold">
                                    <i class="mdi mdi-source me-1"></i>
                                    Sumber <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('sumber') is-invalid @enderror"
                                       id="sumber" name="sumber" value="{{ old('sumber') }}"
                                       placeholder="Contoh: Donasi Pemerintah, Swasta, Masyarakat" required>
                                @error('sumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
                        <a href="{{ route('logistik-bencana.index') }}" class="btn btn-outline-secondary">
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

/* Smooth transition */
#custom_satuan_container {
    transition: all 0.3s ease;
}
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    // Handle satuan custom
    function handleSatuanCustom() {
        const satuanSelect = $('#satuan');
        const customContainer = $('#custom_satuan_container');
        const customInput = $('#satuan_custom');

        if (satuanSelect.val() === 'custom') {
            customContainer.slideDown(300);
            customInput.prop('required', true);
            customInput.focus();
        } else {
            customContainer.slideUp(300);
            customInput.prop('required', false);
            customInput.val('');
        }
    }

    // Toggle custom satuan input
    $('#satuan').on('change', handleSatuanCustom);

    // Trigger on page load for old value
    if ($('#satuan').val() === 'custom') {
        $('#custom_satuan_container').show();
        $('#satuan_custom').prop('required', true);
    }

    // Auto-fill satuan from custom input
    $('#satuan_custom').on('input', function() {
        if ($('#satuan').val() === 'custom') {
            // Keep satuan select on 'custom' option
            $('#satuan option[value="custom"]').text('Kustom: ' + $(this).val());
        }
    });

    // Form validation
    $('form').on('submit', function(e) {
        const kejadianId = $('#kejadian_id').val();
        const satuan = $('#satuan').val();
        const customSatuan = $('#satuan_custom').val();

        // Validate kejadian
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
            return;
        }

        // Validate satuan custom
        if (satuan === 'custom' && !customSatuan.trim()) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Harap isi satuan kustom',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#0d6efd'
            });
            $('#satuan_custom').focus();
        }
    });

    // Auto focus on nama barang
    $('#nama_barang').focus();

    // Format stok input
    $('#stok').on('input', function() {
        let value = $(this).val();
        // Remove any non-numeric characters
        value = value.replace(/[^0-9]/g, '');
        // Remove leading zeros
        value = value.replace(/^0+/, '') || '0';
        $(this).val(value);
    });

    // Real-time validation for stok
    $('#stok').on('blur', function() {
        const value = parseInt($(this).val()) || 0;
        if (value < 0) {
            $(this).val('0');
        }
    });
});
</script>
@endpush
