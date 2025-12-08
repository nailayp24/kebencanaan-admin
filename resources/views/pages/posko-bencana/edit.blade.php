{{-- resources/views/admin/posko-bencana/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-home-edit me-2"></i>Edit Data Posko Bencana
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('posko-bencana.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Kejadian Bencana <span class="text-danger">*</span></label>

                        @if($kejadian->count() > 0)
                            <div class="border p-3 rounded bg-light">
                                @foreach($kejadian as $item)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio"
                                               name="kejadian_id" id="kejadian_{{ $item->kejadian_id }}"
                                               value="{{ $item->kejadian_id }}"
                                               {{ old('kejadian_id', $posko->kejadian_id) == $item->kejadian_id ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="kejadian_{{ $item->kejadian_id }}">
                                            <strong>{{ $item->jenis_bencana }}</strong> -
                                            {{ $item->lokasi_text }}
                                            ({{ $item->tanggal->format('d/m/Y') }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-text text-muted">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Pilih kejadian bencana yang terkait dengan posko ini
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="mdi mdi-alert me-2"></i>
                                Tidak ada data kejadian bencana.
                                <a href="{{ route('kejadian-bencana.create') }}" class="alert-link">
                                    Tambah kejadian bencana terlebih dahulu
                                </a>
                            </div>
                            <input type="hidden" name="kejadian_id" value="{{ $posko->kejadian_id }}">
                        @endif

                        @error('kejadian_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Posko <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama', $posko->nama) }}"
                                       placeholder="Contoh: Posko Utama Gunung Semeru" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                       id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}"
                                       placeholder="Masukkan nama penanggung jawab" required>
                                @error('penanggung_jawab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Posko <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3"
                                  placeholder="Masukkan alamat lengkap posko" required>{{ old('alamat', $posko->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                               id="kontak" name="kontak" value="{{ old('kontak', $posko->kontak) }}"
                               placeholder="Contoh: 081234567890" required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                      {{-- ===== TAMPILKAN FILE YANG SUDAH DIUPLOAD ===== --}}
                    <div class="mb-4">
                        <label class="form-label">Foto Posko Terupload</label>

                        @if($mediaFiles->count() > 0)
                            <div class="row">
                                @foreach($mediaFiles as $file)
                                    <div class="col-md-3 mb-3">
                                        <div class="card border">
                                            <div class="card-body p-2 text-center">
                                                @if(str_contains($file->mime_type, 'image'))
                                                    <img src="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                         class="img-thumbnail mb-2" style="height: 100px; object-fit: cover;">
                                                @else
                                                    <i class="mdi mdi-file-pdf-box" style="font-size: 48px; color: #e74c3c;"></i>
                                                    <p class="small mt-2 text-truncate">{{ $file->file_name }}</p>
                                                @endif

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="delete_media[]" value="{{ $file->media_id }}" id="delete_{{ $file->media_id }}">
                                                    <label class="form-check-label small" for="delete_{{ $file->media_id }}">
                                                        Hapus file ini
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="mdi mdi-information-outline me-2"></i>
                                Belum ada foto posko yang diupload
                            </div>
                        @endif
                    </div>

                    {{-- ===== INPUT UNTUK UPLOAD FILE BARU ===== --}}
                    <div class="mb-4">
                        <label for="foto_posko" class="form-label">Upload Foto Posko Baru</label>
                        <input type="file" class="form-control @error('foto_posko.*') is-invalid @enderror"
                               id="foto_posko" name="foto_posko[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Pilih file baru untuk ditambahkan. Bisa upload beberapa file sekaligus.
                        </div>
                        @error('foto_posko.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-1"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
