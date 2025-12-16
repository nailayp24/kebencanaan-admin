{{-- resources/views/admin/kejadian-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-alert-circle-outline me-2 text-primary"></i>Detail Kejadian Bencana
                    </h5>
                    <div>
                        <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                {{-- Informasi Kejadian --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-3 fw-semibold">
                            <i class="mdi mdi-information-outline me-2 text-primary"></i>Informasi Kejadian
                        </h5>
                        <div class="bg-light-subtle rounded p-3">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%" class="text-muted">Jenis Bencana</th>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                            {{ $kejadian->jenis_bencana }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Tanggal Kejadian</th>
                                    <td>
                                        <div class="fw-medium">{{ $kejadian->tanggal->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ $kejadian->tanggal->format('H:i') }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Lokasi</th>
                                    <td>{{ $kejadian->lokasi_text }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">RT/RW</th>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                            {{ $kejadian->rt }}/{{ $kejadian->rw }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3 fw-semibold">
                            <i class="mdi mdi-clipboard-text-outline me-2 text-primary"></i>Status & Dampak
                        </h5>
                        <div class="bg-light-subtle rounded p-3">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%" class="text-muted">Status</th>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'dilaporkan' => ['bg' => 'warning-subtle', 'text' => 'warning', 'icon' => 'flag'],
                                                'diverifikasi' => ['bg' => 'info-subtle', 'text' => 'info', 'icon' => 'check-circle'],
                                                'ditangani' => ['bg' => 'primary-subtle', 'text' => 'primary', 'icon' => 'account-hard-hat'],
                                                'selesai' => ['bg' => 'success-subtle', 'text' => 'success', 'icon' => 'check-all'],
                                            ];
                                            $statusConfig = $statusColors[$kejadian->status_kejadian] ?? ['bg' => 'secondary-subtle', 'text' => 'secondary', 'icon' => 'help-circle'];
                                        @endphp
                                        <span class="badge {{ $statusConfig['bg'] }} text-{{ $statusConfig['text'] }} border border-{{ $statusConfig['text'] }}-subtle">
                                            <i class="mdi mdi-{{ $statusConfig['icon'] }} me-1"></i>
                                            {{ ucfirst($kejadian->status_kejadian) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Total Posko</th>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            {{ $kejadian->posko->count() ?? 0 }} Posko
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Total Donasi</th>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            {{ $kejadian->total_donasi_formatted ?? 'Rp 0' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Dibuat</th>
                                    <td>
                                        <div class="fw-medium">{{ $kejadian->created_at->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ $kejadian->created_at->format('H:i') }}</small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Dampak dan Keterangan --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3">
                            <i class="mdi mdi-alert-circle me-2 text-primary"></i>Dampak Bencana
                        </h5>
                        <div class="border rounded p-3 bg-light-subtle">
                            <div class="fw-medium">{{ $kejadian->dampak }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-semibold mb-3">
                            <i class="mdi mdi-text-box-outline me-2 text-primary"></i>Keterangan Tambahan
                        </h5>
                        <div class="border rounded p-3 bg-light-subtle">
                            @if($kejadian->keterangan)
                                <div class="fw-medium">{{ $kejadian->keterangan }}</div>
                            @else
                                <div class="text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Tidak ada keterangan tambahan
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Foto / Berita Acara --}}
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-semibold mb-0">
                            <i class="mdi mdi-image-multiple me-2 text-primary"></i>Foto / Berita Acara
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-2">
                                {{ $mediaFiles->count() }} file
                            </span>
                        </h5>
                    </div>

                    @if($mediaFiles->count() > 0)
                        <div class="row">
                            @foreach($mediaFiles as $file)
                                <div class="col-md-3 mb-3">
                                    <div class="card border">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <a href="{{ Storage::url('uploads/kejadian_bencana/' . $file->file_name) }}"
                                               target="_blank" class="text-decoration-none">
                                                <img src="{{ Storage::url('uploads/kejadian_bencana/' . $file->file_name) }}"
                                                     class="card-img-top"
                                                     alt="{{ $file->caption ?? 'Foto kejadian' }}"
                                                     style="height: 150px; object-fit: cover;"
                                                     onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjcwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDI3MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyNzAiIGhlaWdodD0iMTUwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xMzUgNjVDMTQ5Ljg1MiA2NSAxNjIgNzcuMTQ4MyAxNjIgOTJDMTYyIDEwNi44NTIgMTQ5Ljg1MiAxMTkgMTM1IDExOUMxMjAuMTQ4IDExOSAxMDggMTA2Ljg1MiAxMDggOTJDMTA4IDc3LjE0ODMgMTIwLjE0OCA2NSAxMzUgNjVaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik0xMzUgMTI3QzEwMS44NjcgMTI3IDc0LjUgMTU0LjM2NyA3NC41IDE4Ny41SDE5NS41QzE5NS41IDE1NC4zNjcgMTY4LjEzMyAxMjcgMTM1IDEyN1oiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTIyMyAzMEgyMDZWMzRIMjIzVjMwWiIgZmlsbD0iI0Q1RDZEQiIvPgo8cGF0aCBkPSJNMTY4IDMwSDE0OFYzNEgxNjhWMzBaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik03MCAzMEg5MFYzNEg3MFYzMFoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=='">

                                            </a>
                                        @elseif(str_contains($file->mime_type, 'pdf'))
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-pdf-box" style="font-size: 64px; color: #e74c3c;"></i>
                                                <h6 class="mt-2">PDF Document</h6>
                                                <p class="small text-muted text-truncate">{{ $file->file_name }}</p>
                                                <small class="text-muted">
                                                    {{ $file->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        @else
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 64px;"></i>
                                                <h6 class="mt-2">{{ $file->caption ?? 'Dokumen' }}</h6>
                                                <p class="small text-muted text-truncate">{{ $file->file_name }}</p>
                                                <small class="text-muted">
                                                    {{ $file->created_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        @endif
                                        <div class="card-footer bg-white p-2 border-top">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    {{ $file->caption ?? 'File pendukung' }}
                                                </small>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ Storage::url('uploads/kejadian_bencana/' . $file->file_name) }}"
                                                       target="_blank" class="btn btn-sm btn-outline-info px-2" title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ Storage::url('uploads/kejadian_bencana/' . $file->file_name) }}"
                                                       download class="btn btn-sm btn-outline-success px-2" title="Download">
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
                        <div class="text-center py-5">
                            {{-- Placeholder untuk tidak ada file --}}
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iMjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTYwIDQwQzcwLjYwOTUgNDAgNzkgNDguNjA5NSA3OSA1OS4yNUM3OSA2OS44OTA1IDcwLjYwOTUgNzguNSA2MCA3OC41QzQ5LjM5MDUgNzguNSA0MSA2OS44OTA1IDQxIDU5LjI1QzQxIDQ4LjYwOTUgNDkuMzkwNSA0MCA2MCA0MFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTYwIDg0LjVDNDMuNjMwNyA4NC41IDMwLjUgOTcuNjMwNyAzMC41IDExNEg4OS41Qzg5LjUgOTcuNjMwNyA3Ni4zNjkyIDg0LjUgNjAgODQuNVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTk0IDMwSDc2VjM0SDk0VjMwWiIgZmlsbD0iI0Q1RDZEQiIvPgo8cGF0aCBkPSJNNjIgMzBINDZWMzRINjJWMzBaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik0yNiAzMEg0NlYzNEgyNlYzMFoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=="
                                 alt="No files"
                                 class="mb-3"
                                 style="width: 120px; height: 120px;">
                            <div class="text-muted">
                                <h6>Belum ada foto atau berita acara</h6>
                                <p>Upload file melalui halaman edit kejadian</p>
                            </div>
                            <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}" class="btn btn-outline-primary mt-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah File
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-opacity-100:hover {
        opacity: 1 !important;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .card-img-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
    }

    .card {
        border: 1px solid #e9ecef;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .badge {
        padding: 4px 8px;
        font-weight: 500;
        border-radius: 4px;
        font-size: 12px;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 12px;
    }

    .bg-light-subtle {
        background-color: #f8f9fa;
    }

    .border {
        border: 1px solid #e9ecef !important;
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
