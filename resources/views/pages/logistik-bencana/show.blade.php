{{-- resources/views/pages/logistik-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="mdi mdi-package-variant-eye me-2"></i> Detail Logistik
                    </h5>
                    <div class="btn-group" role="group">
                        <a href="{{ route('logistik-bencana.edit', $logistik->logistik_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('logistik-bencana.index') }}"
                           class="btn btn-outline-secondary btn-sm ms-2">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                {{-- Informasi Utama --}}
                <div class="row mb-4">
                    {{-- Informasi Logistik --}}
                    <div class="col-md-8">
                        <div class="card border h-100">
                            <div class="card-body p-3">
                                <h6 class="mb-3 fw-bold text-primary">
                                    <i class="mdi mdi-package me-2"></i> Informasi Logistik
                                </h6>

                                <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Nama Barang</label>
                                            <div class="fw-bold h5">{{ $logistik->nama_barang }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Satuan</label>
                                            <div class="fw-bold">{{ $logistik->satuan }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Sumber</label>
                                            <div class="fw-bold">
                                                <span class="badge bg-secondary">{{ $logistik->sumber }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Stok Total</label>
                                            <div class="fw-bold h4 text-primary">
                                                {{ number_format($logistik->stok, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Stok Tersedia</label>
                                            <div class="fw-bold h4
                                                @if($logistik->stok_tersedia > 0) text-success @else text-danger @endif">
                                                {{ number_format($logistik->stok_tersedia, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>

                                    @if($logistik->keterangan)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Keterangan</label>
                                            <div class="p-2 bg-light rounded small">{{ $logistik->keterangan }}</div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Bencana --}}
                    <div class="col-md-4">
                        <div class="card border h-100">
                            <div class="card-body p-3">
                                <h6 class="mb-3 fw-bold text-primary">
                                    <i class="mdi mdi-alert me-2"></i> Informasi Bencana
                                </h6>

                                @if($logistik->kejadianBencana)
                                    <div class="form-group mb-3">
                                        <label class="form-label text-muted small mb-1">Jenis Bencana</label>
                                        <div class="fw-bold">{{ $logistik->kejadianBencana->jenis_bencana }}</div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label text-muted small mb-1">Tanggal Kejadian</label>
                                        <div class="fw-bold">{{ $logistik->kejadianBencana->tanggal->format('d/m/Y') }}</div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label text-muted small mb-1">Lokasi Kejadian</label>
                                        <div class="fw-bold small">{{ $logistik->kejadianBencana->lokasi_text }}</div>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <i class="mdi mdi-alert-circle-outline text-warning fs-4 mb-2 d-block"></i>
                                        <div class="text-muted small">Data kejadian tidak ditemukan</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Distribusi --}}
                <div class="card border mb-4">
                    <div class="card-body p-3">
                        <h6 class="mb-3 fw-bold text-primary">
                            <i class="mdi mdi-truck-delivery me-2"></i> Riwayat Distribusi
                            <span class="badge bg-primary ms-2">{{ $logistik->distribusi->count() }}</span>
                        </h6>

                        @if($logistik->distribusi->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                        <tr class="small">
                                            <th width="15%">Tanggal</th>
                                            <th width="30%">Posko Penyaluran</th>
                                            <th width="20%">Penerima</th>
                                            <th width="10%">Jumlah</th>
                                            <th width="15%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logistik->distribusi as $distribusi)
                                            <tr class="small">
                                                <td>{{ $distribusi->tanggal->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($distribusi->posko)
                                                        <div>{{ $distribusi->posko->nama }}</div>
                                                        <small class="text-muted">{{ $distribusi->posko->penanggung_jawab }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $distribusi->penerima }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ number_format($distribusi->jumlah, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'direncanakan' => 'warning',
                                                            'dikirim' => 'info',
                                                            'diterima' => 'success',
                                                            'dibatalkan' => 'danger',
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColors[$distribusi->status] ?? 'secondary' }}">
                                                        {{ ucfirst($distribusi->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('distribusi-logistik.show', $distribusi->distribusi_id) }}"
                                                       class="btn btn-sm btn-outline-info py-0 px-2">
                                                        <i class="mdi mdi-eye fs-6"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="mdi mdi-truck-remove text-muted fs-4 mb-2 d-block"></i>
                                <div class="text-muted small">Belum ada data distribusi</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Informasi Waktu dan Catatan --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body p-3">
                                <h6 class="mb-3 fw-bold text-primary">
                                    <i class="mdi mdi-clock me-2"></i> Informasi Waktu
                                </h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Dibuat Pada</label>
                                            <div class="fw-bold">{{ $logistik->created_at->format('d/m/Y') }}</div>
                                            <div class="text-muted small">{{ $logistik->created_at->format('H:i') }} WIB</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-muted small mb-1">Terakhir Diubah</label>
                                            <div class="fw-bold">{{ $logistik->updated_at->format('d/m/Y') }}</div>
                                            <div class="text-muted small">{{ $logistik->updated_at->format('H:i') }} WIB</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body p-3">
                                <h6 class="mb-3 fw-bold text-primary">
                                    <i class="mdi mdi-information me-2"></i> Catatan Stok
                                </h6>

                                <div class="alert alert-info small mb-0 py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calculator me-2"></i>
                                        <div>
                                            <strong>Stok Tersedia = Stok Total - Total yang sudah didistribusikan</strong>
                                            <div class="small mt-1">
                                                @php
                                                    $totalDistribusi = $logistik->distribusi->sum('jumlah');
                                                @endphp
                                                {{ number_format($logistik->stok, 0, ',', '.') }} - {{ number_format($totalDistribusi, 0, ',', '.') }} =
                                                {{ number_format($logistik->stok_tersedia, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <div>
                        <a href="{{ route('logistik-bencana.index') }}"
                           class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                    </div>

                    <div class="btn-group" role="group">
                        <a href="{{ route('logistik-bencana.edit', $logistik->logistik_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('logistik-bencana.destroy', $logistik->logistik_id) }}"
                              method="POST"
                              class="d-inline ms-2"
                              onsubmit="return confirm('Hapus data logistik ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="mdi mdi-delete me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.375rem;
    }

    .card-body {
        padding: 1rem !important;
    }

    .form-label {
        font-size: 0.75rem !important;
        margin-bottom: 0.25rem !important;
    }

    .table-sm {
        font-size: 0.8125rem !important;
    }

    .table-sm th,
    .table-sm td {
        padding: 0.5rem 0.75rem !important;
    }

    .badge {
        font-size: 0.6875rem !important;
        padding: 0.25rem 0.5rem !important;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem !important;
        font-size: 0.8125rem !important;
    }

    .alert {
        padding: 0.5rem 0.75rem !important;
        font-size: 0.8125rem !important;
        margin-bottom: 0 !important;
    }

    h5, h6 {
        margin-bottom: 0.75rem !important;
    }

    /* Compact spacing */
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }

    .pt-3 {
        padding-top: 1rem !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 0.75rem !important;
        }

        .row {
            margin-bottom: 0.5rem !important;
        }

        .col-md-6, .col-md-8, .col-md-4 {
            margin-bottom: 1rem !important;
        }

        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-group {
            width: 100%;
        }

        .btn-group .btn {
            flex: 1;
        }

        .table-responsive {
            font-size: 0.75rem !important;
        }
    }
</style>
@endpush
