{{-- resources/views/admin/posko-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-home-plus me-2"></i>Tambah Data Posko Bencana
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('posko-bencana.store') }}" method="POST">
                    @csrf

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
                                               {{ old('kejadian_id') == $item->kejadian_id ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="kejadian_{{ $item->kejadian_id }}">
                                            <strong>{{ $item->jenis_bencana }}</strong> -
                                            {{ $item->lokasi_text }}
                                            ({{ $item->tanggal->format('d/m/Y') }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="mdi mdi-alert me-2"></i>
                                Tidak ada data kejadian bencana.
                                <a href="{{ route('kejadian-bencana.create') }}" class="alert-link">
                                    Tambah kejadian bencana terlebih dahulu
                                </a>
                            </div>
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
                                       id="nama" name="nama" value="{{ old('nama') }}"
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
                                       id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
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
                                  placeholder="Masukkan alamat lengkap posko" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                               id="kontak" name="kontak" value="{{ old('kontak') }}"
                               placeholder="Contoh: 081234567890" required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary">
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
