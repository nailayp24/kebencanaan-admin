{{-- resources/views/admin/posko-bencana/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-home-edit me-1"></i> Edit Data Posko Bencana
                    </h6>
                    <a href="{{ route('posko-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-3">

                <form action="{{ route('posko-bencana.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data">
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

                    {{-- Kejadian Bencana --}}
                    <div class="mb-2">
                        <label class="form-label fw-medium small mb-1">Kejadian Bencana <span class="text-danger">*</span></label>
                        @if ($kejadian->count() > 0)
                            <select name="kejadian_id" class="form-select form-select-sm select2 @error('kejadian_id') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($kejadian as $item)
                                    <option value="{{ $item->kejadian_id }}"
                                        {{ old('kejadian_id', $posko->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
                                        {{ $item->jenis_bencana }} – {{ $item->lokasi_text }} ({{ $item->tanggal->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text small">{{ $kejadian->count() }} kejadian tersedia</div>
                        @else
                            <div class="alert alert-warning p-2 mb-2">
                                <i class="mdi mdi-alert me-1"></i> Tidak ada data kejadian bencana.
                                <a href="{{ route('kejadian-bencana.create') }}" class="text-decoration-underline">Tambah kejadian</a>
                            </div>
                            <input type="hidden" name="kejadian_id" value="{{ $posko->kejadian_id }}">
                        @endif
                        @error('kejadian_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">Nama Posko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                   name="nama" value="{{ old('nama', $posko->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('penanggung_jawab') is-invalid @enderror"
                                   name="penanggung_jawab" value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}" required>
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-medium small mb-1">Alamat Posko <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror"
                                  name="alamat" rows="2" required>{{ old('alamat', $posko->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium small mb-1">Kontak <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('kontak') is-invalid @enderror"
                                   name="kontak" value="{{ old('kontak', $posko->kontak) }}" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Foto Posko --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-image-multiple me-1"></i> Foto Posko
                            <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                        </label>

                        @if ($mediaFiles->count() > 0)
                            <div class="row g-1">
                                @foreach ($mediaFiles as $file)
                                    <div class="col-6 col-md-3">
                                        <div class="border rounded p-1 text-center small">
                                            @if (str_contains($file->mime_type, 'image'))
                                                <img src="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                     class="img-fluid mb-1" style="height: 60px; object-fit: cover;">
                                            @else
                                                <i class="mdi mdi-file-pdf-box text-danger fs-5 mb-1"></i>
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
                            <div class="text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i> Belum ada foto
                            </div>
                        @endif
                    </div>

                    {{-- Upload Baru + Preview --}}
                    <div class="mb-3">
                        <label class="form-label fw-medium small mb-1">
                            <i class="mdi mdi-file-plus me-1"></i> Upload Foto Baru
                        </label>
                        <input type="file" class="form-control form-control-sm @error('foto_posko.*') is-invalid @enderror"
                               name="foto_posko[]" multiple accept=".jpg,.jpeg,.png" id="foto_posko">

                        @error('foto_posko.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- Preview Area --}}
                        <div id="preview-container" class="mt-2 d-none">
                            <label class="form-label fw-medium small mb-1">Preview:</label>
                            <div class="row g-1" id="imagePreview"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3 pt-2 border-top">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-sm btn-primary">
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
    .select2-container .select2-selection--single {
        height: calc(1.5em + 0.5rem + 2px) !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
        border: 1px solid #dee2e6 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
    }
    .select2-container--default .select2-results__option {
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Pilih --",
            allowClear: true,
            width: '100%'
        });

        // Preview gambar saat upload
        $('#foto_posko').on('change', function(e) {
            const previewContainer = $('#preview-container');
            const imagePreview = $('#imagePreview');
            imagePreview.empty();

            const files = e.target.files;
            if (!files.length) {
                previewContainer.addClass('d-none');
                return;
            }

            previewContainer.removeClass('d-none');

            for (let i = 0; i < Math.min(files.length, 5); i++) {
                if (!files[i].type.startsWith('image/')) continue;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-3';

                    const card = document.createElement('div');
                    card.className = 'border rounded p-1 text-center small';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid mb-1';
                    img.style = 'height: 60px; object-fit: cover;';

                    const fileName = document.createElement('div');
                    fileName.className = 'text-truncate';
                    fileName.textContent = files[i].name.length > 15 ? files[i].name.substring(0, 15) + '...' : files[i].name;

                    card.appendChild(img);
                    card.appendChild(fileName);
                    col.appendChild(card);
                    imagePreview[0].appendChild(col);
                };
                reader.readAsDataURL(files[i]);
            }
        });
    });
</script>
@endpush
