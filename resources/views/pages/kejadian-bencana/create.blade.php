{{-- resources/views/admin/kejadian-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-alert-circle-plus me-2 text-primary"></i>Tambah Data Kejadian Bencana
                    </h5>
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('kejadian-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-alert-circle-outline fs-5 me-2"></i>
                                <div class="flex-grow-1">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_bencana" class="form-label fw-medium">
                                    Jenis Bencana <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('jenis_bencana') is-invalid @enderror"
                                    id="jenis_bencana" name="jenis_bencana" required>
                                    <option value="">Pilih Jenis Bencana</option>
                                    <option value="Banjir" {{ old('jenis_bencana') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                                    <option value="Gempa Bumi" {{ old('jenis_bencana') == 'Gempa Bumi' ? 'selected' : '' }}>Gempa Bumi</option>
                                    <option value="Tanah Longsor" {{ old('jenis_bencana') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                    <option value="Kebakaran" {{ old('jenis_bencana') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                    <option value="Angin Topan" {{ old('jenis_bencana') == 'Angin Topan' ? 'selected' : '' }}>Angin Topan</option>
                                    <option value="Kekeringan" {{ old('jenis_bencana') == 'Kekeringan' ? 'selected' : '' }}>Kekeringan</option>
                                    <option value="Lainnya" {{ old('jenis_bencana') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis_bencana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-medium">
                                    Tanggal Kejadian <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_text" class="form-label fw-medium">
                            Lokasi Kejadian <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('lokasi_text') is-invalid @enderror"
                            id="lokasi_text" name="lokasi_text" rows="2"
                            placeholder="Masukkan lokasi kejadian bencana" required>{{ old('lokasi_text') }}</textarea>
                        <div class="form-text text-muted">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Contoh: Jl. Merdeka No. 10, Dusun Sukamaju, Desa Contoh
                        </div>
                        @error('lokasi_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="rt" class="form-label fw-medium">
                                    RT <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                    id="rt" name="rt" value="{{ old('rt') }}"
                                    placeholder="001" maxlength="3" required>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="rw" class="form-label fw-medium">
                                    RW <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                    id="rw" name="rw" value="{{ old('rw') }}"
                                    placeholder="002" maxlength="3" required>
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_kejadian" class="form-label fw-medium">
                                    Status Kejadian <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status_kejadian') is-invalid @enderror"
                                    id="status_kejadian" name="status_kejadian" required>
                                    <option value="">Pilih Status Kejadian</option>
                                    <option value="dilaporkan" {{ old('status_kejadian') == 'dilaporkan' ? 'selected' : '' }}>Dilaporkan</option>
                                    <option value="diverifikasi" {{ old('status_kejadian') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="ditangani" {{ old('status_kejadian') == 'ditangani' ? 'selected' : '' }}>Ditangani</option>
                                    <option value="selesai" {{ old('status_kejadian') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status_kejadian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dampak" class="form-label fw-medium">
                            Dampak Bencana <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('dampak') is-invalid @enderror"
                            id="dampak" name="dampak" rows="3"
                            placeholder="Deskripsikan dampak yang ditimbulkan oleh bencana" required>{{ old('dampak') }}</textarea>
                        <div class="form-text text-muted">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Jelaskan dampak yang ditimbulkan (kerusakan properti, korban jiwa, dll)
                        </div>
                        @error('dampak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-medium">Keterangan Tambahan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                            id="keterangan" name="keterangan" rows="2"
                            placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                        <div class="form-text text-muted">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Tambahkan informasi lain yang relevan tentang kejadian ini
                        </div>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- INPUT MULTIPLE FILE UPLOAD --}}
                    <div class="mb-4">
                        <label for="foto_berita_acara" class="form-label fw-medium">
                            <i class="mdi mdi-file-multiple me-1"></i>Foto / Berita Acara
                        </label>
                        <input type="file" class="form-control @error('foto_berita_acara.*') is-invalid @enderror"
                               id="foto_berita_acara" name="foto_berita_acara[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.webp,.heic">
                        <div class="form-text">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Upload foto atau dokumen pendukung kejadian bencana. Bisa multiple files.
                        </div>
                        @error('foto_berita_acara.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- File Preview Area --}}
                        <div id="filePreview" class="mt-3 d-none">
                            <div class="border rounded p-3">
                                <h6 class="mb-3">File Preview</h6>
                                <div id="previewContainer" class="row">
                                    {{-- Preview akan muncul di sini --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('foto_berita_acara');
    const previewContainer = document.getElementById('previewContainer');
    const filePreview = document.getElementById('filePreview');

    fileInput.addEventListener('change', function(e) {
        const files = e.target.files;
        previewContainer.innerHTML = '';

        if (files.length > 0) {
            filePreview.classList.remove('d-none');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';

                    const card = document.createElement('div');
                    card.className = 'card border';

                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body p-2 text-center';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail mb-2';
                        img.style = 'height: 100px; object-fit: cover;';
                        cardBody.appendChild(img);
                    } else if (file.type === 'application/pdf') {
                        const icon = document.createElement('i');
                        icon.className = 'mdi mdi-file-pdf-box';
                        icon.style = 'font-size: 48px; color: #e74c3c;';
                        cardBody.appendChild(icon);
                    } else {
                        const icon = document.createElement('i');
                        icon.className = 'mdi mdi-file-document-outline';
                        icon.style = 'font-size: 48px;';
                        cardBody.appendChild(icon);
                    }

                    const fileName = document.createElement('p');
                    fileName.className = 'small mt-2 text-truncate';
                    fileName.textContent = file.name;
                    cardBody.appendChild(fileName);

                    const fileSize = document.createElement('small');
                    fileSize.className = 'text-muted';
                    fileSize.textContent = formatFileSize(file.size);
                    cardBody.appendChild(fileSize);

                    card.appendChild(cardBody);
                    col.appendChild(card);
                    previewContainer.appendChild(col);
                }

                reader.readAsDataURL(file);
            }
        } else {
            filePreview.classList.add('d-none');
        }
    });

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
@endpush

@push('styles')
<style>
    .form-label {
        font-size: 14px;
        font-weight: 500;
    }

    .form-control, .form-select {
        font-size: 14px;
        padding: 8px 12px;
    }

    .form-text {
        font-size: 12px;
    }

    .card {
        border: 1px solid #e9ecef;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid #e9ecef;
    }

    .btn {
        font-size: 14px;
        padding: 8px 16px;
    }

    .btn-sm {
        font-size: 12px;
        padding: 4px 12px;
    }

    .border-top {
        border-top: 1px solid #e9ecef !important;
    }
</style>
@endpush
