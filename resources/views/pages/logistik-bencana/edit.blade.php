{{-- resources/views/pages/logistik-bencana/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-package-variant-edit me-2"></i> Edit Data Logistik Bencana
                    </h5>
                    <a href="{{ route('logistik-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('logistik-bencana.update', $logistik->logistik_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="mdi mdi-alert-circle-outline fs-5 me-2 mt-1"></i>
                                <div class="flex-grow-1">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2 ps-3" style="font-size: 0.875rem;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close p-1" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @endif

                    {{-- Kejadian Bencana --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Kejadian Bencana <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm select2 @error('kejadian_id') is-invalid @enderror"
                                        id="kejadian_id" name="kejadian_id" required>
                                    <option value="">-- Pilih Kejadian Bencana --</option>
                                    @foreach($kejadian as $item)
                                        <option value="{{ $item->kejadian_id }}"
                                            {{ old('kejadian_id', $logistik->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
                                            {{ $item->jenis_bencana }} – {{ $item->lokasi_text }} ({{ $item->tanggal->format('d/m/Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    {{ $kejadian->count() }} kejadian tersedia
                                </div>
                                @error('kejadian_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('nama_barang') is-invalid @enderror"
                                       id="nama_barang" name="nama_barang"
                                       value="{{ old('nama_barang', $logistik->nama_barang) }}"
                                       placeholder="Contoh: Beras, Air Mineral, Obat-obatan" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Satuan dan Stok --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Satuan <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm select2-satuan @error('satuan') is-invalid @enderror"
                                        id="satuan" name="satuan" required>
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach($satuanDefault as $satuan)
                                        <option value="{{ $satuan }}"
                                            {{ old('satuan', $logistik->satuan) == $satuan ? 'selected' : '' }}>
                                            {{ $satuan }}
                                        </option>
                                    @endforeach
                                    {{-- Opsi custom jika satuan tidak ada di default --}}
                                    @if(!in_array($logistik->satuan, $satuanDefault))
                                        <option value="{{ $logistik->satuan }}" selected>{{ $logistik->satuan }}</option>
                                    @endif
                                </select>
                                <div class="form-text small mt-2">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pilih satuan atau ketik satuan baru
                                </div>
                                @error('satuan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Stok <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm @error('stok') is-invalid @enderror"
                                           id="stok" name="stok"
                                           value="{{ old('stok', $logistik->stok) }}"
                                           min="0" step="1" required>
                                </div>
                                <div class="form-text small mt-2">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Stok tersedia: <span class="badge bg-success">{{ number_format($logistik->stok_tersedia, 0, ',', '.') }}</span>
                                </div>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Sumber <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('sumber') is-invalid @enderror"
                                       id="sumber" name="sumber"
                                       value="{{ old('sumber', $logistik->sumber) }}"
                                       placeholder="Contoh: Donatur, Pemda, BNPB" required>
                                @error('sumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan Tambahan --}}
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Keterangan Tambahan</label>
                                <textarea class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                                          id="keterangan" name="keterangan"
                                          rows="2" placeholder="Tambahkan catatan atau keterangan lainnya...">{{ old('keterangan', $logistik->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div>
                            <a href="{{ route('logistik-bencana.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali
                            </a>
                            <a href="{{ route('logistik-bencana.show', $logistik->logistik_id) }}"
                               class="btn btn-outline-info btn-sm ms-2">
                                <i class="mdi mdi-eye-outline me-1"></i> Lihat Detail
                            </a>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
                                <i class="mdi mdi-close me-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm ms-2">
                                <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 Custom Styling */
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0.5rem !important;
        color: #212529 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.5rem + 2px) !important;
    }

    .select2-container--default .select2-results__option {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #0d6efd !important;
        color: white !important;
    }

    .select2-container--default .select2-dropdown {
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
    }

    /* Select2 untuk satuan dengan pencarian */
    .select2-satuan + .select2-container .select2-search__field {
        font-size: 0.875rem !important;
    }

    /* Form Controls */
    .form-control-sm, .form-select-sm {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        border-radius: 0.25rem !important;
    }

    .input-group-sm {
        height: calc(1.5em + 0.5rem + 2px) !important;
    }

    .input-group-sm .form-control {
        border-right: none;
    }

    .input-group-sm .input-group-text {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
    }

    /* Form Label */
    .form-label {
        font-size: 0.875rem !important;
        font-weight: 500 !important;
        margin-bottom: 0.375rem !important;
    }

    /* Form Text */
    .form-text {
        font-size: 0.75rem !important;
        color: #6c757d !important;
    }

    /* Badge */
    .badge {
        font-size: 0.6875rem !important;
        padding: 0.25rem 0.5rem !important;
        border-radius: 0.25rem !important;
    }

    /* Button */
    .btn-sm {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
        border-radius: 0.25rem !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 1rem;
        }

        .d-flex.justify-content-between.align-items-center > div {
            width: 100%;
        }

        .btn-group {
            width: 100%;
        }

        .btn-group .btn {
            flex: 1;
        }

        .card-body {
            padding: 1.5rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for kejadian bencana
        $('.select2').select2({
            placeholder: "-- Pilih Kejadian Bencana --",
            allowClear: true,
            width: '100%',
            dropdownParent: $('.card-body')
        });

        // Initialize Select2 for satuan with tags (allow custom input)
        $('.select2-satuan').select2({
            placeholder: "-- Pilih Satuan --",
            tags: true,
            allowClear: true,
            width: '100%',
            dropdownParent: $('.card-body'),
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            },
            templateResult: function (data) {
                var $result = $("<span></span>");

                $result.text(data.text);

                if (data.newTag) {
                    $result.append(" <em class='text-muted'>(baru)</em>");
                }

                return $result;
            }
        });

        // Auto-focus on input when dropdown is opened
        $('.select2-satuan').on('select2:open', function() {
            document.querySelector('.select2-container--open .select2-search__field').focus();
        });

        // Handle form validation
        const form = document.querySelector('form');
        const stokInput = document.getElementById('stok');

        // Real-time validation for stock
        stokInput.addEventListener('input', function() {
            const value = parseInt(this.value) || 0;
            const minStok = 0;

            if (value < minStok) {
                this.value = minStok;
            }

            // Format number with thousand separators while typing
            this.value = value.toLocaleString('id-ID');
        });

        // Remove thousand separators before form submission
        form.addEventListener('submit', function(e) {
            if (stokInput.value) {
                stokInput.value = stokInput.value.replace(/\./g, '');
            }
        });

        // Handle back button
        document.querySelector('[onclick="history.back()"]').addEventListener('click', function(e) {
            e.preventDefault();
            history.back();
        });
    });
</script>
@endpush
