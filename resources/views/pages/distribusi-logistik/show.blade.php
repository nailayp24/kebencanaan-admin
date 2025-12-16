{{-- resources/views/pages/distribusi-logistik/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-truck-delivery-eye me-1"></i> Detail Distribusi Logistik
                    </h6>
                    <div class="d-flex gap-2">
                        <a href="{{ route('distribusi-logistik.edit', $distribusi->distribusi_id) }}"
                           class="btn btn-sm btn-outline-warning">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('distribusi-logistik.index') }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-3">

                {{-- Informasi Utama --}}
                <div class="row g-2 mb-3">
                    {{-- Distribusi --}}
                    <div class="col-md-6">
                        <div class="bg-light-subtle rounded p-3 h-100">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="mdi mdi-calendar-clock me-1"></i> Distribusi
                            </h6>

                            <div class="mb-2">
                                <div class="text-muted small mb-1">Tanggal Distribusi</div>
                                <div class="fw-bold">{{ $distribusi->tanggal->format('d/m/Y') }}</div>
                            </div>

                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="text-muted small">Jumlah</div>
                                        <div class="fw-bold">{{ number_format($distribusi->jumlah, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-muted small">Satuan</div>
                                        <div class="fw-bold">{{ $distribusi->logistik->satuan ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="text-muted small mb-1">Penerima</div>
                                <div class="fw-bold">{{ $distribusi->penerima }}</div>
                                @if($distribusi->keterima_jabatan)
                                    <div class="text-muted small">{{ $distribusi->keterima_jabatan }}</div>
                                @endif
                            </div>

                            @if($distribusi->keterangan)
                            <div>
                                <div class="text-muted small mb-1">Catatan</div>
                                <div class="bg-white rounded p-2 small">{{ $distribusi->keterangan }}</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Barang & Posko --}}
                    <div class="col-md-6">
                        <div class="bg-light-subtle rounded p-3 h-100">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="mdi mdi-package me-1"></i> Barang & Posko
                            </h6>

                            <div class="mb-2">
                                <div class="text-muted small mb-1">Logistik</div>
                                @if($distribusi->logistik)
                                    <div class="fw-bold">{{ $distribusi->logistik->nama_barang }}</div>
                                    <div class="text-muted small">
                                        Satuan: {{ $distribusi->logistik->satuan }} •
                                        Sumber: {{ $distribusi->logistik->sumber }}
                                    </div>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                        Logistik tidak ditemukan
                                    </span>
                                @endif
                            </div>

                            <div class="mb-2">
                                <div class="text-muted small mb-1">Posko Penyaluran</div>
                                @if($distribusi->posko)
                                    <div class="fw-bold">{{ $distribusi->posko->nama }}</div>
                                    <div class="text-muted small">
                                        <i class="mdi mdi-map-marker-outline me-1"></i>{{ $distribusi->posko->alamat }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="mdi mdi-account-outline me-1"></i>{{ $distribusi->posko->penanggung_jawab }}
                                    </div>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                        Posko tidak ditemukan
                                    </span>
                                @endif
                            </div>

                            @if($distribusi->logistik && $distribusi->logistik->kejadianBencana)
                            <div>
                                <div class="text-muted small mb-1">Bencana Terkait</div>
                                <div class="fw-bold">{{ $distribusi->logistik->kejadianBencana->jenis_bencana }}</div>
                                <div class="text-muted small">{{ $distribusi->logistik->kejadianBencana->lokasi_text }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Bukti Distribusi --}}
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="bg-light-subtle rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 fw-bold text-primary">
                                    <i class="mdi mdi-file-document me-1"></i> Bukti Distribusi
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-2">
                                        {{ $mediaFiles->count() }} file
                                    </span>
                                </h6>
                            </div>

                            @if($mediaFiles->count() > 0)
                                <div class="row g-1">
                                    @foreach($mediaFiles as $file)
                                        <div class="col-6 col-md-3">
                                            <div class="border rounded position-relative" style="height: 150px;">
                                                @if(str_contains($file->mime_type, 'image'))
                                                    <a href="{{ Storage::url('uploads/distribusi_logistik/' . $file->file_name) }}"
                                                       target="_blank" class="d-block h-100">
                                                        <img src="{{ Storage::url('uploads/distribusi_logistik/' . $file->file_name) }}"
                                                             alt="{{ $file->caption ?? 'Bukti distribusi' }}"
                                                             class="w-100 h-100"
                                                             style="object-fit: cover;"
                                                             onerror="this.onerror=null; this.src='image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiByeD0iOCIgZmlsbD0iI0YzRjRGNiIvPgo8cGF0aCBkPSJNMTA1IDY1QzExNC4zODkgNjUgMTIyIDc0LjYxMTcgMTIyIDg1QzEyMiA5NS4zODggMTE0LjM4OSAxMDQgOTkgMTA0Qzg5LjYxMTcgMTA0IDgyIDk1LjM4OCA4MiA4NUM4MiA3NC42MTE3IDg5LjYxMTcgNjUgOTkgNjVaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik05OSAxMTNDNzQuODY3IDExMyA1NiAxMzIuODY3IDU2IDE1N0gxNDJDxNDYgMTMyLjg2NyAxMjMuMTMzIDExMyA5OSAxMTNaIiBmaWxsPSIjRDVENkRCIi8+Cjwvc3ZnPgo=';">
                                                    </a>
                                                @elseif(str_contains($file->mime_type, 'pdf'))
                                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                                                        <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 32px;"></i>
                                                        <small class="text-muted mt-1 text-truncate px-1">{{ $file->file_name }}</small>
                                                    </div>
                                                @else
                                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                                                        <i class="mdi mdi-file-document-outline text-secondary" style="font-size: 32px;"></i>
                                                        <small class="text-muted mt-1 text-truncate px-1">{{ $file->file_name }}</small>
                                                    </div>
                                                @endif

                                                <!-- Tombol Aksi -->
                                                <div class="position-absolute top-0 end-0 m-1 d-flex gap-1">
                                                    <a href="{{ Storage::url('uploads/distribusi_logistik/' . $file->file_name) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-light shadow-sm"
                                                       title="Lihat">
                                                        <i class="mdi mdi-eye text-info"></i>
                                                    </a>
                                                    <a href="{{ Storage::url('uploads/distribusi_logistik/' . $file->file_name) }}"
                                                       download
                                                       class="btn btn-sm btn-light shadow-sm"
                                                       title="Unduh">
                                                        <i class="mdi mdi-download text-success"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <img src="image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiByeD0iOCIgZmlsbD0iI0YzRjRGNiIvPgo8cGF0aCBkPSJNNDAgMzBDNDUuNTIzIDMwIDUwIDM0LjQ3NyA1MCA0MEM1MCA0NS41MjMgNDUuNTIzIDUwIDQwIDUwQzM0LjQ3NyA1MCAzMCA0NS41MjMgMzAgNDRDMzAgMzQuNDc3IDM0LjQ3NyAzMCA0MCAzMFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTQwIDU1QzMwLjY4MDIgNTUgMjMgNjIuNjgwMiAyMyA3Mkg1N0M1NyA2Mi42ODAyIDQ5LjMxOTggNTUgNDAgNTVaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik02MiAyNEg0N1YyOEg2MlYyNFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTMzIDI0SDQ4VjI4SDMzVjI0WiIgZmlsbD0iI0Q1RDZEQiIvPgo8L3N2Zz4K"
                                         alt="Tidak ada bukti"
                                         class="mb-2"
                                         style="width: 60px; height: 60px; opacity: 0.6;">
                                    <div class="text-muted small">
                                        Belum ada bukti distribusi
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Informasi Sistem --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light-subtle rounded p-3">
                            <h6 class="fw-bold text-primary mb-2">
                                <i class="mdi mdi-clock me-1"></i> Informasi Sistem
                            </h6>
                            <div class="row g-1">
                                <div class="col-md-6">
                                    <div class="text-muted small mb-1">Dibuat</div>
                                    <div class="fw-bold">{{ $distribusi->created_at->format('d/m/Y') }}</div>
                                    <div class="text-muted small">{{ $distribusi->created_at->format('H:i') }} WIB</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small mb-1">Diperbarui</div>
                                    <div class="fw-bold">{{ $distribusi->updated_at->format('d/m/Y') }}</div>
                                    <div class="text-muted small">{{ $distribusi->updated_at->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Hapus --}}
                <div class="d-flex justify-content-end mt-3 pt-2 border-top">
                    <form action="{{ route('distribusi-logistik.destroy', $distribusi->distribusi_id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin ingin menghapus data distribusi ini?')">
                            <i class="mdi mdi-delete me-1"></i> Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-light-subtle {
        background-color: #f8f9fa;
    }
    .badge {
        padding: 4px 8px;
        font-weight: 500;
        border-radius: 4px;
        font-size: 12px;
    }
</style>
@endpush
