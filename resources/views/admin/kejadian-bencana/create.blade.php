{{-- resources/views/admin/kejadian-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Data Kejadian Bencana</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kejadian-bencana.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_bencana" class="form-label">Jenis Bencana <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('jenis_bencana') is-invalid @enderror"
                                        id="jenis_bencana" name="jenis_bencana" aria-label="Jenis Bencana select example"
                                        required>
                                        <option selected>Pilih Jenis Bencana</option>
                                        <option value="Banjir" {{ old('jenis_bencana') == 'Banjir' ? 'selected' : '' }}>
                                            Banjir</option>
                                        <option value="Gempa Bumi"
                                            {{ old('jenis_bencana') == 'Gempa Bumi' ? 'selected' : '' }}>Gempa Bumi</option>
                                        <option value="Tanah Longsor"
                                            {{ old('jenis_bencana') == 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor
                                        </option>
                                        <option value="Kebakaran"
                                            {{ old('jenis_bencana') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                                        <option value="Angin Topan"
                                            {{ old('jenis_bencana') == 'Angin Topan' ? 'selected' : '' }}>Angin Topan
                                        </option>
                                        <option value="Kekeringan"
                                            {{ old('jenis_bencana') == 'Kekeringan' ? 'selected' : '' }}>Kekeringan</option>
                                        <option value="Lainnya" {{ old('jenis_bencana') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('jenis_bencana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Kejadian <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_text" class="form-label">Lokasi Kejadian <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('lokasi_text') is-invalid @enderror" id="lokasi_text" name="lokasi_text"
                                rows="3" placeholder="Masukkan lokasi kejadian bencana" required>{{ old('lokasi_text') }}</textarea>
                            @error('lokasi_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                        id="rt" name="rt" value="{{ old('rt') }}" placeholder="001"
                                        required>
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                        id="rw" name="rw" value="{{ old('rw') }}" placeholder="002"
                                        required>
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status_kejadian" class="form-label">Status Kejadian <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_kejadian') is-invalid @enderror"
                                        id="status_kejadian" name="status_kejadian"
                                        aria-label="Status Kejadian select example" required>
                                        <option selected>Pilih Status Kejadian</option>
                                        <option value="dilaporkan"
                                            {{ old('status_kejadian') == 'dilaporkan' ? 'selected' : '' }}>Dilaporkan
                                        </option>
                                        <option value="diverifikasi"
                                            {{ old('status_kejadian') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi
                                        </option>
                                        <option value="ditangani"
                                            {{ old('status_kejadian') == 'ditangani' ? 'selected' : '' }}>Ditangani
                                        </option>
                                        <option value="selesai"
                                            {{ old('status_kejadian') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status_kejadian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="dampak" class="form-label">Dampak Bencana <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('dampak') is-invalid @enderror" id="dampak" name="dampak" rows="3"
                                placeholder="Deskripsikan dampak yang ditimbulkan" required>{{ old('dampak') }}</textarea>
                            @error('dampak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                rows="2" placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
