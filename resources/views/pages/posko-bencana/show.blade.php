{{-- resources/views/admin/posko-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="mdi mdi-home-eye me-1"></i> Detail Posko Bencana
                    </h5>
                    <div>
                        <a href="{{ route('posko-bencana.edit', $posko->posko_id) }}" class="btn btn-sm btn-warning">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-sm btn-outline-light">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">

                {{-- === Bagian 1: Informasi Utama (2 kolom) === --}}
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="fw-bold mb-2 text-primary">Informasi Posko</h6>
                            <table class="table table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <td width="40%"><strong>Nama Posko</strong></td>
                                        <td>{{ $posko->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Penanggung Jawab</strong></td>
                                        <td>{{ $posko->penanggung_jawab }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kontak</strong></td>
                                        <td>{{ $posko->kontak }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="fw-bold mb-2 text-primary">Informasi Kejadian</h6>
                            @if ($posko->kejadianBencana)
                                <table class="table table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td width="40%"><strong>Jenis Bencana</strong></td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                                    {{ $posko->kejadianBencana->jenis_bencana }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal</strong></td>
                                            <td>
                                                {{ $posko->kejadianBencana->tanggal->format('d/m/Y') }}
                                                <small class="text-muted">({{ $posko->kejadianBencana->tanggal->format('H:i') }})</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lokasi</strong></td>
                                            <td>{{ $posko->kejadianBencana->lokasi_text }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="text-muted">
                                    <i class="mdi mdi-alert me-1"></i> Kejadian tidak ditemukan
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- === Bagian 2: Alamat (full width) === --}}
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="border rounded p-3">
                            <h6 class="fw-bold mb-2 text-primary">Alamat Posko</h6>
                            <p class="mb-0">{{ $posko->alamat }}</p>
                        </div>
                    </div>
                </div>

                {{-- === Bagian 3: Foto Dokumentasi === --}}
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0 text-primary">
                                <i class="mdi mdi-image-multiple me-1"></i> Dokumentasi Foto
                            </h6>
                            <span class="badge bg-primary">{{ $mediaFiles->count() }} file</span>
                        </div>

                        @if ($mediaFiles->count() > 0)
                            <div class="row g-3">
                                @foreach ($mediaFiles as $file)
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="card border">
                                            @if (str_contains($file->mime_type, 'image'))
                                                <!-- Untuk Gambar -->
                                                <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                   target="_blank"
                                                   class="text-decoration-none position-relative d-block">
                                                    <img src="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                         alt="{{ $file->caption ?? 'Foto posko' }}"
                                                         class="card-img-top"
                                                         style="height: 150px; object-fit: cover;"
                                                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjcwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDI3MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyNzAiIGhlaWdodD0iMTUwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xMzUgNjVDMTQ5Ljg1MiA2NSAxNjIgNzcuMTQ4MyAxNjIgOTJDMTYyIDEwNi44NTIgMTQ5Ljg1MiAxMTkgMTM1IDExOUMxMjAuMTQ4IDExOSAxMDggMTA2Ljg1MiAxMDggOTJDMTA4IDc3LjE0ODMgMTIwLjE0OCA2NSAxMzUgNjVaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik0xMzUgMTI3QzEwMS44NjcgMTI3IDc0LjUgMTU0LjM2NyA3NC41IDE4Ny41SDE5NS41QzE5NS41IDE1NC4zNjcgMTY4LjEzMyAxMjcgMTM1IDEyN1oiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTIyMyAzMEgyMDZWMzRIMjIzVjMwWiIgZmlsbD0iI0Q1RDZEQiIvPgo8cGF0aCBkPSJNMTY4IDMwSDE0OFYzNEgxNjhWMzBaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik03MCAzMEg5MFYzNEg3MFYzMFoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=='">
                                                </a>
                                            @elseif (str_contains($file->mime_type, 'pdf'))
                                                <!-- Untuk PDF -->
                                                <div class="card-body text-center">
                                                    <i class="mdi mdi-file-pdf-box" style="font-size: 64px; color: #e74c3c;"></i>
                                                    <h6 class="mt-2">Dokumen PDF</h6>
                                                    <p class="small text-muted text-truncate">{{ $file->file_name }}</p>
                                                    <small class="text-muted">{{ $file->created_at->format('d/m/Y') }}</small>
                                                </div>
                                            @else
                                                <!-- Untuk file lainnya -->
                                                <div class="card-body text-center">
                                                    <i class="mdi mdi-file-document-outline" style="font-size: 64px; color: #6c757d;"></i>
                                                    <h6 class="mt-2">{{ $file->caption ?? 'Dokumen' }}</h6>
                                                    <p class="small text-muted text-truncate">{{ $file->file_name }}</p>
                                                    <small class="text-muted">{{ $file->created_at->format('d/m/Y') }}</small>
                                                </div>
                                            @endif

                                            <!-- Footer dengan tombol Unduh dan Lihat -->
                                            <div class="card-footer bg-white p-2 border-top">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted text-truncate" style="max-width: 60%;">
                                                        {{ $file->caption ?? 'File pendukung' }}
                                                    </small>
                                                    <div class="d-flex gap-1">
                                                        <!-- Tombol Lihat (untuk semua file) -->
                                                        <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-info px-2"
                                                           title="Lihat File">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        <!-- Tombol Unduh (untuk semua file) -->
                                                        <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                           download
                                                           class="btn btn-sm btn-outline-success px-2"
                                                           title="Unduh File">
                                                            <i class="mdi mdi-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Jika tidak ada file -->
                            <div class="bg-light-subtle rounded p-4 text-center">
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iMjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTYwIDQwQzcwLjYwOTUgNDAgNzkgNDguNjA5NSA3OSA1OS4yNUM3OSA2OS44OTA1IDcwLjYwOTUgNzguNSA2MCA3OC41QzQ5LjM5MDUgNzguNSA0MSA2OS44OTA1IDQxIDU5LjI1QzQxIDQ4LjYwOTUgNDkuMzkwNSA0MCA2MCA0MFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTYwIDg0LjVDNDMuNjMwNyA4NC41IDMwLjUgOTcuNjMwNyAzMC41IDExNEg4OS41Qzg5LjUgOTcuNjMwNyA3Ni4zNjkyIDg0LjUgNjAgODQuNVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTk0IDMwSDc2VjM0SDk0VjMwWiIgZmlsbD0iI0Q1RDZEQiIvPgo8cGF0aCBkPSJNNjIgMzBINDZWMzRINjJWMzBaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik0yNiAzMEg0NlYzNEgyNlYzMFoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=="
                                     alt="No files"
                                     class="mb-3"
                                     style="width: 120px; height: 120px; opacity: 0.6;">
                                <div class="text-muted">
                                    <h6 class="mb-2">Belum ada dokumentasi foto</h6>
                                    <p class="mb-3">Upload file melalui halaman edit posko</p>
                                </div>
                                <a href="{{ route('posko-bencana.edit', $posko->posko_id) }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-plus me-1"></i> Tambah File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: 1px solid #e9ecef;
        transition: transform 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-sm {
        padding: 4px 8px;
        font-size: 12px;
    }
    .bg-light-subtle {
        background-color: #f8f9fa;
    }
    @media (max-width: 768px) {
        .col-md-3 {
            width: 50%;
        }
        .card-img-top {
            height: 120px !important;
        }
    }
</style>
@endpush

@endsection
