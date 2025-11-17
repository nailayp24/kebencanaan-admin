{{-- resources/views/pages/donasi-bencana/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-hand-heart-plus me-2"></i>Tambah Data Donasi Bencana
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('donasi-bencana.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kejadian_id" class="form-label">Kejadian Bencana <span class="text-danger">*</span></label>
                                <select class="form-select @error('kejadian_id') is-invalid @enderror"
                                    id="kejadian_id" name="kejadian_id" required>
                                    <option value="">Pilih Kejadian Bencana</option>
                                    @foreach($kejadian as $item)
                                        <option value="{{ $item->kejadian_id }}" {{ old('kejadian_id') == $item->kejadian_id ? 'selected' : '' }}>
                                            {{ $item->jenis_bencana }} - {{ $item->tanggal_formatted }} - {{ Str::limit($item->lokasi_text, 30) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kejadian_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="donatur_nama" class="form-label">Nama Donatur <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('donatur_nama') is-invalid @enderror"
                                    id="donatur_nama" name="donatur_nama" value="{{ old('donatur_nama') }}"
                                    placeholder="Masukkan nama donatur" required>
                                @error('donatur_nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Donasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror"
                                    id="jenis" name="jenis" required>
                                    <option value="">Pilih Jenis Donasi</option>
                                    <option value="uang" {{ old('jenis') == 'uang' ? 'selected' : '' }}>Uang</option>
                                    <option value="barang" {{ old('jenis') == 'barang' ? 'selected' : '' }}>Barang</option>
                                    <option value="jasa" {{ old('jenis') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai Donasi</label>
                                <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                    id="nilai" name="nilai" value="{{ old('nilai') }}"
                                    placeholder="Masukkan nilai donasi (hanya angka)" min="0" step="1000">
                                <div class="form-text text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Isi nilai untuk donasi uang, kosongkan untuk barang/jasa
                                </div>
                                @error('nilai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                            id="keterangan" name="keterangan" rows="3"
                            placeholder="Keterangan tambahan tentang donasi">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary">
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

<script>
    document.getElementById('jenis').addEventListener('change', function() {
        const nilaiInput = document.getElementById('nilai');
        if (this.value !== 'uang') {
            nilaiInput.value = '';
            nilaiInput.setAttribute('readonly', 'readonly');
        } else {
            nilaiInput.removeAttribute('readonly');
        }
    });

    // Trigger change event on page load
    document.getElementById('jenis').dispatchEvent(new Event('change'));
</script>
@endsection
