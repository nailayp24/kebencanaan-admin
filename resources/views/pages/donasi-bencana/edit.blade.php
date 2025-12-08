{{-- resources/views/pages/donasi-bencana/edit.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-hand-heart-edit me-2"></i>Edit Data Donasi Bencana
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('donasi-bencana.update', $donasi->donasi_id) }}" method="POST" enctype="multipart/form-data">>
                    @csrf
                    @method('PUT')

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
                                        <option value="{{ $item->kejadian_id }}" {{ old('kejadian_id', $donasi->kejadian_id) == $item->kejadian_id ? 'selected' : '' }}>
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
                                    id="donatur_nama" name="donatur_nama" value="{{ old('donatur_nama', $donasi->donatur_nama) }}"
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
                                    <option value="uang" {{ old('jenis', $donasi->jenis) == 'uang' ? 'selected' : '' }}>Uang</option>
                                    <option value="barang" {{ old('jenis', $donasi->jenis) == 'barang' ? 'selected' : '' }}>Barang</option>
                                    <option value="jasa" {{ old('jenis', $donasi->jenis) == 'jasa' ? 'selected' : '' }}>Jasa</option>
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
                                    id="nilai" name="nilai" value="{{ old('nilai', $donasi->nilai) }}"
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
                            placeholder="Keterangan tambahan tentang donasi">{{ old('keterangan', $donasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                        {{-- ===== TAMPILKAN FILE YANG SUDAH DIUPLOAD ===== --}}
                    <div class="mb-4">
                        <label class="form-label">Bukti Donasi Terupload</label>

                        @if($mediaFiles->count() > 0)
                            <div class="row">
                                @foreach($mediaFiles as $file)
                                    <div class="col-md-3 mb-3">
                                        <div class="card border">
                                            <div class="card-body p-2 text-center">
                                                @if(str_contains($file->mime_type, 'image'))
                                                    <img src="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                         class="img-thumbnail mb-2" style="height: 100px; object-fit: cover;">
                                                @elseif(str_contains($file->mime_type, 'pdf'))
                                                    <i class="mdi mdi-file-pdf-box" style="font-size: 48px; color: #e74c3c;"></i>
                                                    <p class="small mt-2 text-truncate">{{ $file->file_name }}</p>
                                                @else
                                                    <i class="mdi mdi-file-document-outline" style="font-size: 48px;"></i>
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
                                Belum ada bukti donasi yang diupload
                            </div>
                        @endif
                    </div>

                    {{-- ===== INPUT UNTUK UPLOAD FILE BARU ===== --}}
                    <div class="mb-4">
                        <label for="bukti_donasi" class="form-label">Upload Bukti Donasi Baru</label>
                        <input type="file" class="form-control @error('bukti_donasi.*') is-invalid @enderror"
                               id="bukti_donasi" name="bukti_donasi[]" multiple
                               accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Pilih file baru untuk ditambahkan. Bisa upload beberapa file sekaligus.
                        </div>
                        @error('bukti_donasi.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary">
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

<script>
    document.getElementById('jenis').addEventListener('change', function() {
        const nilaiInput = document.getElementById('nilai');
        if (this.value !== 'uang') {
            nilaiInput.setAttribute('readonly', 'readonly');
        } else {
            nilaiInput.removeAttribute('readonly');
        }
    });

    // Trigger change event on page load
    document.getElementById('jenis').dispatchEvent(new Event('change'));
</script>
@endsection
