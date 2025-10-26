{{-- tes --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Posko Bencana</h4>
            </div>
            <div class="card-body">

                <!-- DEBUG INFO -->
                <div class="alert alert-info mb-3 d-none">
                    <strong>Debug Info:</strong><br>
                    Total Kejadian: {{ $kejadian->count() }}<br>
                    Current Kejadian ID: {{ $posko->kejadian_id }}
                </div>

                <form action="{{ route('posko-bencana.update', $posko->posko_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="kejadian_id" class="form-label">Kejadian Bencana <span class="text-danger">*</span></label>

                        @if($kejadian->count() > 0)
                            <select class="form-select @error('kejadian_id') is-invalid @enderror"
                                    id="kejadian_id" name="kejadian_id" required
                                    style="display: block !important; opacity: 1 !important;">
                                <option value="">Pilih Kejadian Bencana</option>
                                @foreach($kejadian as $item)
                                    <option value="{{ $item->kejadian_id }}"
                                        {{ old('kejadian_id', $posko->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
                                        {{ $item->jenis_bencana }} - {{ $item->lokasi_text }} ({{ $item->tanggal->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Pilih kejadian bencana yang terkait dengan posko ini</div>
                        @else
                            <div class="alert alert-warning">
                                <i class="mdi mdi-alert"></i>
                                Tidak ada data kejadian bencana.
                                <a href="{{ route('kejadian-bencana.create') }}" class="alert-link">
                                    Tambah kejadian bencana terlebih dahulu
                                </a>
                            </div>
                            <input type="hidden" name="kejadian_id" value="{{ $posko->kejadian_id }}">
                        @endif

                        @error('kejadian_id')
                            <div class="invalid-feedback">{{ $message }}</div>
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

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Force show the dropdown */
#kejadian_id {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    width: 100% !important;
}

/* Remove any hiding styles */
.form-select {
    -webkit-appearance: menulist !important;
    -moz-appearance: menulist !important;
    appearance: menulist !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Edit Form Loaded');
    console.log('Kejadian Data:', @json($kejadian));
    console.log('Current Kejadian ID:', '{{ $posko->kejadian_id }}');

    const selectElement = document.getElementById('kejadian_id');
    if (selectElement) {
        console.log('Select Element Found, Options:', selectElement.options.length);
        console.log('Selected Value:', selectElement.value);
    } else {
        console.log('Select Element NOT Found');
    }
});
</script>
@endsection
