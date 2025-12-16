{{-- resources/views/admin/kejadian-bencana/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-alert-circle-edit me-1"></i> Edit Data Kejadian Bencana
                    </h6>
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-3">

                <form action="{{ route('kejadian-bencana.update', $kejadian->kejadian_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show p-2 mb-3" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="mdi mdi-alert-circle-outline fs-5 me-2 mt-1"></i>
                                <div class="flex-grow-1">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-1" style="font-size: 0.85rem;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close p-1" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @endif

                    {{-- Row 1: Jenis Bencana & Tanggal --}}
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">
                                <i class="mdi mdi-alert me-1 text-warning"></i> Jenis Bencana <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown-filter">
                                <select class="form-select form-select-sm @error('jenis_bencana') is-invalid @enderror"
                                        name="jenis_bencana" required>
                                    <option value="">-- Pilih Jenis Bencana --</option>
                                    <option value="Banjir" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                                    <option value="Gempa Bumi" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Gempa Bumi' ? 'selected' : '' }}>Gempa Bumi</option>
                                    <option value="Tanah Longsor" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                    <option value="Kebakaran" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                    <option value="Angin Topan" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Angin Topan' ? 'selected' : '' }}>Angin Topan</option>
                                    <option value="Kekeringan" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Kekeringan' ? 'selected' : '' }}>Kekeringan</option>
                                    <option value="Lainnya" {{ old('jenis_bencana', $kejadian->jenis_bencana) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            @error('jenis_bencana')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">
                                <i class="mdi mdi-calendar me-1 text-info"></i> Tanggal Kejadian <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control form-control-sm @error('tanggal') is-invalid @enderror"
                                   name="tanggal"
                                   value="{{ old('tanggal', $kejadian->tanggal->format('Y-m-d')) }}"
                                   required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div class="mb-2">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-map-marker me-1 text-danger"></i> Lokasi Kejadian <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-sm @error('lokasi_text') is-invalid @enderror"
                                  name="lokasi_text" rows="1" placeholder="Masukkan lokasi lengkap" required>{{ old('lokasi_text', $kejadian->lokasi_text) }}</textarea>
                        @error('lokasi_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RT/RW & Status --}}
                    <div class="row g-2 mb-2">
                        <div class="col-md-3">
                            <label class="form-label fw-medium small mb-1">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('rt') is-invalid @enderror"
                                   name="rt" value="{{ old('rt', $kejadian->rt) }}" placeholder="001" maxlength="3" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium small mb-1">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('rw') is-invalid @enderror"
                                   name="rw" value="{{ old('rw', $kejadian->rw) }}" placeholder="002" maxlength="3" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">
                                <i class="mdi mdi-flag me-1 text-primary"></i> Status Kejadian <span class="text-danger">*</span>
                            </label>
                            <div class="dropdown-filter">
                                <select class="form-select form-select-sm @error('status_kejadian') is-invalid @enderror"
                                        name="status_kejadian" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="dilaporkan" {{ old('status_kejadian', $kejadian->status_kejadian) == 'dilaporkan' ? 'selected' : '' }}>Dilaporkan</option>
                                    <option value="diverifikasi" {{ old('status_kejadian', $kejadian->status_kejadian) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="ditangani" {{ old('status_kejadian', $kejadian->status_kejadian) == 'ditangani' ? 'selected' : '' }}>Ditangani</option>
                                    <option value="selesai" {{ old('status_kejadian', $kejadian->status_kejadian) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            @error('status_kejadian')
                                <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Dampak --}}
                    <div class="mb-2">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-alert-box me-1 text-warning"></i> Dampak Bencana <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-sm @error('dampak') is-invalid @enderror"
                                  name="dampak" rows="2" placeholder="Deskripsikan dampak yang ditimbulkan" required>{{ old('dampak', $kejadian->dampak) }}</textarea>
                        @error('dampak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-note-text me-1 text-secondary"></i> Keterangan Tambahan
                        </label>
                        <textarea class="form-control form-control-sm @error('keterangan') is-invalid @enderror"
                                  name="keterangan" rows="1" placeholder="Opsional">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- File Terupload --}}
                    <div class="border rounded p-3 mb-3 bg-light-subtle">
                        <label class="form-label fw-medium small mb-2 d-flex align-items-center">
                            <i class="mdi mdi-file-multiple me-1 text-primary"></i> File Terupload
                            <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                        </label>
                        @if($mediaFiles->count() > 0)
                            <div class="row g-2">
                                @foreach($mediaFiles as $file)
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="border rounded p-2 bg-white">
                                            <div class="d-flex align-items-start">
                                                @if(str_contains($file->mime_type, 'image'))
                                                    <img src="{{ Storage::url('uploads/kejadian_bencana/' . $file->file_name) }}"
                                                         class="rounded me-2"
                                                         style="width: 50px; height: 50px; object-fit: cover;"
                                                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiByeD0iNCIgZmlsbD0iI0YzRjRGNiIvPgo8cGF0aCBkPSJNMjUgMTVDMzAuNTIyOSAxNSAzNSAxOS40NzcxIDM1IDI1QzM1IDMwLjUyMjkgMzAuNTIyOSAzNSAyNSAzNUMyMy44MjE4IDM1IDIyLjY5MDYgMzQuNzY1OSAyMS42NTgxIDM0LjM1NzMiCiAgIHN0cm9rZT0iI0Q1RDZEQiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPC9zdmc+Cg==';">
                                                @elseif(str_contains($file->mime_type, 'pdf'))
                                                    <i class="mdi mdi-file-pdf-box text-danger me-2" style="font-size: 24px;"></i>
                                                @else
                                                    <i class="mdi mdi-file-document-outline text-secondary me-2" style="font-size: 24px;"></i>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <div class="small text-truncate">{{ $file->file_name }}</div>
                                                    <div class="form-check small mt-1 mb-0">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="delete_media[]"
                                                               value="{{ $file->media_id }}"
                                                               id="del_{{ $file->media_id }}">
                                                        <label class="form-check-label" for="del_{{ $file->media_id }}">
                                                            Hapus file
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="mdi mdi-file-outline text-muted" style="font-size: 40px;"></i>
                                <p class="small text-muted mt-2 mb-0">Belum ada file terupload</p>
                            </div>
                        @endif
                    </div>

                    {{-- Upload Baru --}}
                    <div class="border rounded p-3 mb-3 bg-light-subtle">
                        <label class="form-label fw-medium small mb-2 d-flex align-items-center">
                            <i class="mdi mdi-file-plus me-1 text-success"></i> Upload File Baru
                        </label>
                        <input type="file" class="form-control form-control-sm @error('foto_berita_acara.*') is-invalid @enderror"
                               name="foto_berita_acara[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" id="fileInput">
                        <div class="form-text small mt-1">
                            <i class="mdi mdi-information-outline me-1"></i>
                            File yang diizinkan: JPG, PNG, PDF, DOC, DOCX (Maks. 5MB per file)
                        </div>
                        @error('foto_berita_acara.*')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror

                        {{-- Preview Area --}}
                        <div id="previewContainer" class="mt-3 d-none">
                            <label class="form-label fw-medium small mb-2">Preview File:</label>
                            <div class="row g-2" id="imagePreview">
                                {{-- Preview akan muncul di sini --}}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-close me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* DROPDOWN STYLING - Sama seperti di index */
    .dropdown-filter .form-select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        background-color: white;
        font-size: 14px;
        padding: 6px 12px;
        height: 36px;
        transition: border-color 0.15s ease-in-out;
    }

    .dropdown-filter .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    /* Form Control Styling */
    .form-control-sm, .form-select-sm {
        padding: 6px 12px !important;
        font-size: 14px !important;
        height: 36px !important;
    }

    textarea.form-control-sm {
        min-height: 80px !important;
        resize: vertical;
    }

    /* Label Styling */
    .form-label.small {
        font-size: 13px !important;
        margin-bottom: 4px !important;
        color: #495057 !important;
        font-weight: 500;
    }

    /* Card & Border Styling */
    .card {
        border: 1px solid #e9ecef !important;
        border-radius: 8px !important;
    }

    .border {
        border: 1px solid #dee2e6 !important;
    }

    .border.rounded {
        border-radius: 6px !important;
    }

    /* Background Subtle */
    .bg-light-subtle {
        background-color: #f8f9fa !important;
    }

    /* Badge Styling */
    .badge {
        padding: 2px 6px !important;
        font-size: 11px !important;
        font-weight: 500 !important;
        border-radius: 4px !important;
    }

    /* Button Styling */
    .btn-sm {
        padding: 6px 12px !important;
        font-size: 13px !important;
        border-radius: 4px !important;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    /* Alert Styling */
    .alert {
        border-radius: 6px !important;
        border: none !important;
    }

    /* Icon Colors */
    .text-warning {
        color: #ffc107 !important;
    }

    .text-info {
        color: #0dcaf0 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-primary {
        color: #0d6efd !important;
    }

    .text-success {
        color: #198754 !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    /* Preview Container */
    #imagePreview .col-6 {
        padding-left: 4px !important;
        padding-right: 4px !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem !important;
        }

        .col-6, .col-md-4, .col-lg-3 {
            margin-bottom: 0.5rem !important;
        }

        .btn-sm {
            padding: 5px 10px !important;
            font-size: 12px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const files = e.target.files;
            imagePreview.innerHTML = '';

            if (files.length > 0) {
                previewContainer.classList.remove('d-none');

                for (let i = 0; i < Math.min(files.length, 8); i++) { // Maks 8 preview
                    const file = files[i];

                    // Hanya preview untuk gambar
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-6 col-md-4 col-lg-3';

                            const card = document.createElement('div');
                            card.className = 'border rounded p-2 text-center bg-white';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-fluid rounded mb-1';
                            img.style = 'height: 80px; object-fit: cover;';

                            const fileName = document.createElement('div');
                            fileName.className = 'small text-truncate';
                            fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

                            card.appendChild(img);
                            card.appendChild(fileName);
                            col.appendChild(card);
                            imagePreview.appendChild(col);
                        }

                        reader.readAsDataURL(file);
                    } else {
                        // Untuk non-gambar, tampilkan icon
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3';

                        const card = document.createElement('div');
                        card.className = 'border rounded p-2 text-center bg-white';

                        let iconClass = 'mdi-file-document-outline';
                        let iconColor = 'text-secondary';

                        if (file.type === 'application/pdf') {
                            iconClass = 'mdi-file-pdf-box';
                            iconColor = 'text-danger';
                        }

                        const icon = document.createElement('i');
                        icon.className = `mdi ${iconClass} ${iconColor} fs-3`;

                        const fileName = document.createElement('div');
                        fileName.className = 'small text-truncate mt-1';
                        fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

                        card.appendChild(icon);
                        card.appendChild(fileName);
                        col.appendChild(card);
                        imagePreview.appendChild(col);
                    }
                }
            } else {
                previewContainer.classList.add('d-none');
            }
        });
    }
});
</script>
@endpush
