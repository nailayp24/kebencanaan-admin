{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <!-- Total Warga -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                    <div class="float-left">
                        <i class="mdi mdi-account-multiple text-primary icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Total Warga</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $totalWarga ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Terdaftar dalam sistem
                </p>
            </div>
        </div>
    </div>

    <!-- Total Kejadian Bencana -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                    <div class="float-left">
                        <i class="mdi mdi-alert-circle text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Kejadian Bencana</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $totalKejadian ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                    <i class="mdi mdi-alert mr-1" aria-hidden="true"></i> Total kejadian tercatat
                </p>
            </div>
        </div>
    </div>

    <!-- Total Posko -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                    <div class="float-left">
                        <i class="mdi mdi-home-assistant text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Posko Bencana</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{ $totalPosko ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                    <i class="mdi mdi-map-marker mr-1" aria-hidden="true"></i> Posko aktif
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                    <div class="float-left">
                        <i class="mdi mdi-plus-circle text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Quick Actions</p>
                        <div class="fluid-container">
                            <div class="mt-2">
                                <a href="{{ route('warga.create') }}" class="btn btn-sm btn-primary mb-1">Tambah Warga</a>
                                <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-sm btn-warning mb-1">Lapor Bencana</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kejadian Terbaru -->
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h2 class="card-title mb-0">Kejadian Bencana Terbaru</h2>
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jenis Bencana</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($kejadianTerbaru)
                                @forelse($kejadianTerbaru as $kejadian)
                                <tr>
                                    <td>{{ $kejadian->jenis_bencana }}</td>
                                    <td>{{ $kejadian->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit($kejadian->lokasi_text, 30) }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'dilaporkan' => 'secondary',
                                                'diverifikasi' => 'info',
                                                'ditangani' => 'warning',
                                                'selesai' => 'success'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$kejadian->status_kejadian] ?? 'secondary' }}">
                                            {{ ucfirst($kejadian->status_kejadian) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}" class="btn btn-sm btn-warning">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data kejadian bencana</td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">Data tidak tersedia</td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Statistik Cepat</h4>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-account-multiple text-primary icon-md"></i>
                            <div class="ml-3">
                                <h6 class="mb-0">{{ $totalWarga ?? 0 }}</h6>
                                <p class="text-muted mb-0">Warga</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-alert-circle text-danger icon-md"></i>
                            <div class="ml-3">
                                <h6 class="mb-0">{{ $totalKejadian ?? 0 }}</h6>
                                <p class="text-muted mb-0">Kejadian</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Actions</h4>
                <div class="d-grid gap-2">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-account-plus"></i> Tambah Warga
                    </a>
                    <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-warning">
                        <i class="mdi mdi-alert-plus"></i> Lapor Bencana
                    </a>
                    <a href="{{ route('posko-bencana.create') }}" class="btn btn-success">
                        <i class="mdi mdi-home-plus"></i> Buat Posko
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
