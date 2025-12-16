{{-- resources/views/pages/distribusi-logistik/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-truck-delivery-edit me-2"></i> Edit Distribusi Logistik
                    </h5>
                    <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('distribusi-logistik.update', $distribusi->distribusi_id) }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Logistik dan Posko --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Logistik <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm select2 @error('logistik_id') is-invalid @enderror"
                                        id="logistik_id" name="logistik_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach($logistik as $item)
                                        <option value="{{ $item->logistik_id }}"
                                            {{ old('logistik_id', $distribusi->logistik_id) == $item->logistik_id ? 'selected' : '' }}
                                            data-stok="{{ $item->stok_tersedia }}"
                                            data-satuan="{{ $item->satuan }}">
                                            {{ $item->nama_barang }} ({{ $item->satuan }})
                                            - Stok: {{ number_format($item->stok_tersedia, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Stok tersedia logistik:
                                    <span id="stok-info" class="badge bg-success"></span>
                                </div>
                                @error('logistik_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Posko Penyaluran <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm select2 @error('posko_id') is-invalid @enderror"
                                        id="posko_id" name="posko_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach($posko as $item)
                                        <option value="{{ $item->posko_id }}"
                                            {{ old('posko_id', $distribusi->posko_id) == $item->posko_id ? 'selected' : '' }}>
                                            {{ $item->nama }} - {{ $item->alamat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small mt-1">
                                    <i class="mdi mdi-map-marker-outline me-1"></i>
                                    {{ $posko->count() }} posko tersedia
                                </div>
                                @error('posko_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal, Jumlah, dan Penerima --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Tanggal Distribusi <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal"
                                           value="{{ old('tanggal', $distribusi->tanggal->format('Y-m-d')) }}" required>
                                </div>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Jumlah <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm @error('jumlah') is-invalid @enderror"
                                           id="jumlah" name="jumlah"
                                           value="{{ old('jumlah', $distribusi->jumlah) }}"
                                           min="1" step="1" required>
                                    <span class="input-group-text" id="satuan-label">{{ $distribusi->logistik->satuan ?? 'satuan' }}</span>
                                </div>
                                <div class="form-text small mt-2">
                                    <i class="mdi mdi-calculator me-1"></i>
                                    Sisa stok: <span id="sisa-stok" class="badge bg-info"></span>
                                </div>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Penerima <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('penerima') is-invalid @enderror"
                                       id="penerima" name="penerima"
                                       value="{{ old('penerima', $distribusi->penerima) }}"
                                       placeholder="Nama penerima/jabatan" required>
                                @error('penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-medium small mb-1">Keterangan</label>
                                <textarea class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                                          id="keterangan" name="keterangan"
                                          rows="2" placeholder="Tambahkan catatan distribusi...">{{ old('keterangan', $distribusi->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bukti Distribusi Terupload --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-file-multiple me-1"></i> Bukti Distribusi
                            <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                        </label>

                        @if($mediaFiles->count() > 0)
                            <div class="row g-2">
                                @foreach($mediaFiles as $file)
                                    <div class="col-6 col-md-3">
                                        <div class="border rounded p-2 text-center bg-light">
                                            @if(str_contains($file->mime_type, 'image'))
                                                <img src="{{ asset('storage/uploads/distribusi_logistik/' . $file->file_name) }}"
                                                     class="img-fluid mb-1" style="height: 60px; object-fit: cover;">
                                            @elseif(str_contains($file->mime_type, 'pdf'))
                                                <i class="mdi mdi-file-pdf-box text-danger fs-4 mb-1"></i>
                                            @else
                                                <i class="mdi mdi-file-document-outline fs-4 mb-1"></i>
                                            @endif
                                            <div class="form-check small mt-1 mb-0">
                                                <input class="form-check-input" type="checkbox" name="delete_media[]"
                                                       value="{{ $file->media_id }}" id="del_{{ $file->media_id }}">
                                                <label class="form-check-label" for="del_{{ $file->media_id }}">Hapus</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Placeholder Image untuk belum ada bukti --}}
                            <div class="d-flex flex-column align-items-center justify-content-center border rounded p-4 bg-light-subtle">
                                <div class="text-center mb-3">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('assets-admin/images/placeholder.jpg') }}"
                                             alt="No Image"
                                             class="img-fluid rounded"
                                             style="max-height: 150px; object-fit: cover;">
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                            <span class="badge bg-secondary bg-opacity-75 px-3 py-2">
                                                <i class="mdi mdi-image-off me-1"></i> Belum ada bukti
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted small text-center">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Belum ada bukti distribusi yang diupload
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Upload Baru + Preview --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium small mb-2 d-block">
                            <i class="mdi mdi-file-plus me-1"></i> Upload Bukti Baru
                        </label>

                        {{-- Input File Area --}}
                        <div class="file-upload-area">
                            <input type="file"
                                   class="form-control file-input @error('bukti_distribusi.*') is-invalid @enderror"
                                   name="bukti_distribusi[]"
                                   multiple
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   id="bukti_distribusi">
                        </div>

                        {{-- Informasi File dengan spacing yang cukup --}}
                        <div class="file-info mt-3">
                            <div class="form-text small text-muted">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Maksimal 5 file, ukuran maksimal 2MB per file
                            </div>
                            <div class="form-text small text-muted">
                                Format yang didukung: JPG, PNG, PDF
                            </div>
                        </div>

                        @error('bukti_distribusi.*')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror

                        {{-- Preview Area --}}
                        <div id="preview-container" class="mt-4 d-none">
                            <label class="form-label fw-medium small mb-2">Preview:</label>
                            <div class="row g-2" id="imagePreview"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-sm btn-outline-secondary px-3">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary px-3">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Select2 Custom */
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
    }
    .select2-container--default .select2-results__option {
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.5rem + 2px) !important;
    }

    /* File Input Custom Styling - LEBAR DAN JELAS */
    .file-upload-area {
        width: 100%;
    }

    .file-input {
        width: 100% !important;
        height: calc(2.5em + 0.5rem + 2px) !important;
        padding: 0.5rem 0.75rem !important;
        font-size: 0.875rem !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
        background-color: white !important;
        cursor: pointer !important;
        transition: all 0.15s ease-in-out;
    }

    .file-input:hover {
        border-color: #86b7fe !important;
    }

    .file-input:focus {
        border-color: #86b7fe !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        outline: 0 !important;
    }

    /* Custom Styling untuk button "Choose Files" */
    .file-input::file-selector-button {
        padding: 0.375rem 0.75rem !important;
        margin: -0.5rem -0.75rem !important;
        margin-right: 0.75rem !important;
        color: #212529 !important;
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
        font-size: 0.875rem !important;
        font-weight: 500 !important;
        height: calc(2.5em) !important;
        transition: all 0.15s ease-in-out;
    }

    .file-input:hover::file-selector-button {
        background-color: #e9ecef !important;
        border-color: #dde0e3 !important;
    }

    .file-input:focus::file-selector-button {
        background-color: #e9ecef !important;
        border-color: #86b7fe !important;
    }

    /* File Info Styling - JAUHKAN DARI INPUT */
    .file-info {
        margin-top: 0.75rem !important;
    }

    .file-info .form-text {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
        font-size: 0.75rem !important;
        color: #6c757d !important;
        line-height: 1.4 !important;
    }

    .file-info .form-text:first-child {
        margin-top: 0 !important;
    }

    /* Placeholder Image Styling */
    .bg-light-subtle {
        background-color: #f8f9fa !important;
    }

    .bg-opacity-75 {
        --bs-bg-opacity: 0.75;
    }

    /* Form Controls Consistency */
    .form-control-sm,
    .form-select-sm {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        border-radius: 0.25rem !important;
    }

    /* Input Group Styling */
    .input-group-sm {
        height: calc(1.5em + 0.5rem + 2px) !important;
    }

    .input-group-sm .input-group-text {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
    }

    /* Textarea */
    textarea.form-control-sm {
        min-height: calc(3em + 0.5rem + 2px) !important;
        resize: vertical;
    }

    /* Button Consistency */
    .btn-sm {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
        border-radius: 0.25rem !important;
        height: calc(1.5em + 0.75rem + 2px) !important;
    }

    /* Badge Styling */
    .badge {
        font-size: 0.75rem !important;
        padding: 0.25rem 0.5rem !important;
        border-radius: 0.25rem !important;
    }

    /* Preview Area */
    #preview-container {
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .col-6 {
            margin-bottom: 1rem;
        }

        .d-flex.gap-2 {
            flex-direction: column;
        }

        .d-flex.gap-2 .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .file-input {
            font-size: 0.8125rem !important;
        }

        .file-input::file-selector-button {
            font-size: 0.8125rem !important;
            padding: 0.25rem 0.5rem !important;
        }

        /* Placeholder image responsive */
        .d-flex.flex-column.align-items-center {
            padding: 1.5rem !important;
        }

        .d-flex.flex-column.align-items-center img {
            max-height: 120px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "-- Pilih --",
            allowClear: true,
            width: '100%',
            dropdownParent: $('.card-body')
        });

        // Update satuan and stock info when logistik changes
        $('#logistik_id').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var stokTersedia = selectedOption.data('stok') || 0;
            var satuan = selectedOption.data('satuan') || 'satuan';

            // Update satuan label
            $('#satuan-label').text(satuan);

            // Update stock info
            $('#stok-info').text(formatNumber(stokTersedia) + ' ' + satuan);

            // Calculate remaining stock
            var jumlah = parseInt($('#jumlah').val()) || 0;
            var sisaStok = stokTersedia - jumlah;
            updateSisaStok(sisaStok, satuan);
        });

        // Update remaining stock when jumlah changes
        $('#jumlah').on('input', function() {
            var selectedLogistik = $('#logistik_id').find('option:selected');
            var stokTersedia = selectedLogistik.data('stok') || 0;
            var satuan = selectedLogistik.data('satuan') || 'satuan';
            var jumlah = parseInt($(this).val()) || 0;

            var sisaStok = stokTersedia - jumlah;
            updateSisaStok(sisaStok, satuan);

            // Validate maximum jumlah
            if (jumlah > stokTersedia) {
                $(this).addClass('is-invalid');
                $('#sisa-stok').removeClass('bg-info').addClass('bg-danger').text('Jumlah melebihi stok!');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Initialize on page load
        function initializeStockInfo() {
            var selectedLogistik = $('#logistik_id').find('option:selected');
            var stokTersedia = selectedLogistik.data('stok') || 0;
            var satuan = selectedLogistik.data('satuan') || 'satuan';
            var jumlah = parseInt($('#jumlah').val()) || 0;

            // Update satuan label
            $('#satuan-label').text(satuan);

            // Update stock info
            $('#stok-info').text(formatNumber(stokTersedia) + ' ' + satuan);

            // Calculate remaining stock
            var sisaStok = stokTersedia - jumlah;
            updateSisaStok(sisaStok, satuan);
        }

        initializeStockInfo();

        // Preview file saat upload
        $('#bukti_distribusi').on('change', function(e) {
            const previewContainer = $('#preview-container');
            const imagePreview = $('#imagePreview');
            imagePreview.empty();

            const files = e.target.files;
            if (!files.length) {
                previewContainer.addClass('d-none');
                return;
            }

            previewContainer.removeClass('d-none');

            // Limit preview to 5 files
            const fileCount = Math.min(files.length, 5);

            for (let i = 0; i < fileCount; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-3 mb-2';

                    const card = document.createElement('div');
                    card.className = 'border rounded p-2 text-center bg-light h-100';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid mb-1';
                        img.style = 'height: 60px; width: 100%; object-fit: cover; border-radius: 0.2rem;';
                        card.appendChild(img);
                    } else if (file.type === 'application/pdf') {
                        const icon = document.createElement('i');
                        icon.className = 'mdi mdi-file-pdf-box text-danger fs-4 mb-1 d-block';
                        card.appendChild(icon);
                    } else {
                        const icon = document.createElement('i');
                        icon.className = 'mdi mdi-file-document-outline fs-4 mb-1 d-block';
                        card.appendChild(icon);
                    }

                    const fileName = document.createElement('div');
                    fileName.className = 'text-truncate small text-muted';
                    fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

                    card.appendChild(fileName);
                    col.appendChild(card);
                    imagePreview[0].appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });

        // Validasi file size
        $('#bukti_distribusi').on('change', function() {
            const maxSize = 2 * 1024 * 1024; // 2MB
            const files = this.files;
            const maxFiles = 5;

            if (files.length > maxFiles) {
                alert('Maksimal ' + maxFiles + ' file yang diupload');
                this.value = '';
                $('#preview-container').addClass('d-none');
                $('#imagePreview').empty();
                return;
            }

            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert('File ' + files[i].name + ' melebihi ukuran maksimal 2MB');
                    this.value = '';
                    $('#preview-container').addClass('d-none');
                    $('#imagePreview').empty();
                    break;
                }
            }
        });

        // Format number with thousand separators
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Update sisa stok display
        function updateSisaStok(sisa, satuan) {
            var sisaElement = $('#sisa-stok');

            if (sisa >= 0) {
                sisaElement.removeClass('bg-danger').addClass('bg-info').text(formatNumber(sisa) + ' ' + satuan);
            } else {
                sisaElement.removeClass('bg-info').addClass('bg-danger').text('Jumlah melebihi stok!');
            }
        }
    });
</script>
@endpush
