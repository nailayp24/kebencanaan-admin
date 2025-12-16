{{-- resources/views/pages/donasi-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-hand-heart-eye me-1"></i> Detail Donasi Bencana
                    </h5>
                    <div>
                        <a href="{{ route('donasi-bencana.edit', $donasi->donasi_id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">

                {{-- Informasi Donasi --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="bg-light-subtle rounded p-3 h-100">
                            <h6 class="fw-bold text-primary mb-3">Informasi Donatur</h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td width="40%" class="text-muted">Nama Donatur</td>
                                        <td>{{ $donasi->donatur_nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kejadian Bencana</td>
                                        <td>
                                            @if($donasi->kejadianBencana)
                                                <span class="badge bg-info-subtle text-info border border-info-subtle">
                                                    {{ $donasi->kejadianBencana->jenis_bencana }}
                                                </span><br>
                                                <small class="text-muted">{{ $donasi->kejadianBencana->lokasi_text }}</small>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                                    Data tidak ditemukan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Jenis Donasi</td>
                                        <td>
                                            @php
                                                $jenisWarna = [
                                                    'uang' => ['bg' => 'success-subtle', 'text' => 'success'],
                                                    'barang' => ['bg' => 'warning-subtle', 'text' => 'warning'],
                                                    'lainnya' => ['bg' => 'info-subtle', 'text' => 'info'],
                                                ];
                                                $config = $jenisWarna[$donasi->jenis] ?? ['bg' => 'secondary-subtle', 'text' => 'secondary'];
                                            @endphp
                                            <span class="badge {{ $config['bg'] }} text-{{ $config['text'] }} border border-{{ $config['text'] }}-subtle">
                                                {{ $donasi->jenis_donasi }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light-subtle rounded p-3 h-100">
                            <h6 class="fw-bold text-primary mb-3">Informasi Tambahan</h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td width="40%" class="text-muted">Nilai Donasi</td>
                                        <td>
                                            @if($donasi->nilai)
                                                <span class="fw-bold text-success">{{ $donasi->nilai_formatted }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Donasi</td>
                                        <td>{{ $donasi->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Terakhir Diperbarui</td>
                                        <td>{{ $donasi->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                @if($donasi->keterangan)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="bg-light-subtle rounded p-3">
                            <h6 class="fw-bold text-primary mb-2">Keterangan</h6>
                            <p class="mb-0">{{ $donasi->keterangan }}</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Bukti Donasi --}}
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary mb-0">
                            <i class="mdi mdi-file-document-multiple me-1"></i> Bukti Donasi
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-2">
                                {{ $mediaFiles->count() }} file
                            </span>
                        </h6>
                    </div>

                    @if($mediaFiles->count() > 0)
                        <div class="row g-2">
                            @foreach($mediaFiles as $file)
                                <div class="col-6 col-md-3">
                                    <div class="border rounded position-relative" style="height: 180px;">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <a href="{{ Storage::url('uploads/donasi_bencana/' . $file->file_name) }}"
                                               target="_blank" class="d-block h-100">
                                                <img src="{{ Storage::url('uploads/donasi_bencana/' . $file->file_name) }}"
                                                     alt="{{ $file->caption ?? 'Bukti donasi' }}"
                                                     class="w-100 h-100"
                                                     style="object-fit: cover;"
                                                     onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgwIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE4MCAxODAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxODAiIGhlaWdodD0iMTgwIiByeD0iOCIgZmlsbD0iI0YzRjRGNiIvPgo8cGF0aCBkPSJNMTA1IDc1QzExNC4zODkgNzUgMTIyIDgzLjYxMTcgMTIyIDk0QzEyMiAxMDQuMzg4IDExNC4zODkgMTEzIDk5IDExM0M4OS42MTEzIDExMyA4MiAxMDQuMzg4IDgyIDk0QzgyIDgzLjYxMTcgODkuNjExMyA3NSA5OSA3NVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTk5IDEyMkM3NC44NjcgMTIyIDU2IDE0MS44NjcgNTYgMTY2SDE0MkMxNDIgMTQxLjg2NyAxMjMuMTMzIDEyMiA5OSAxMjJaIiBmaWxsPSIjRDVENkRCIi8+Cjwvc3ZnPgo=';">
                                            </a>
                                        @elseif(str_contains($file->mime_type, 'pdf'))
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                                                <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 48px;"></i>
                                                <small class="text-muted mt-2 text-truncate px-2">{{ $file->file_name }}</small>
                                            </div>
                                        @else
                                            <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-light">
                                                <i class="mdi mdi-file-document-outline text-secondary" style="font-size: 48px;"></i>
                                                <small class="text-muted mt-2 text-truncate px-2">{{ $file->file_name }}</small>
                                            </div>
                                        @endif

                                        <!-- Tombol Aksi -->
                                        <div class="position-absolute top-0 end-0 m-1 d-flex gap-1">
                                            <a href="{{ Storage::url('uploads/donasi_bencana/' . $file->file_name) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-light shadow-sm"
                                               title="Lihat">
                                                <i class="mdi mdi-eye text-info"></i>
                                            </a>
                                            <a href="{{ Storage::url('uploads/donasi_bencana/' . $file->file_name) }}"
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
                        <div class="text-center py-4 bg-light-subtle rounded">
                            <img src="{{ asset('assets-admin/images/placeholder.jpg') }}"
                                 alt="Tidak ada bukti"
                                 class="mb-2"
                                 style="width: 80px; height: 80px; opacity: 0.6;">
                            <div class="text-muted">
                                <h6 class="mb-1">Belum ada bukti donasi</h6>
                                <p class="mb-0 small">Bukti donasi akan ditampilkan di sini setelah diupload</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Tombol Hapus --}}
                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                    <form action="{{ route('donasi-bencana.destroy', $donasi->donasi_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin ingin menghapus data donasi ini?')">
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
