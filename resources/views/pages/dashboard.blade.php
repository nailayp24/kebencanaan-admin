{{-- resources/views/pages/dashboard.blade.php --}}
@extends('layouts.admin.app')

@section('content')

{{-- Welcome Section --}}
@auth
<div class="row mb-3">
    <div class="col-12">
        <div class="card bg-gradient-primary text-white border-0">
            <div class="card-body p-3">
                <div class="row align-items-center g-2">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <i class="mdi mdi-hand-wave" style="font-size: 32px;"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h5>
                                <div class="d-flex align-items-center small">
                                    <i class="mdi mdi-email-outline me-1"></i>
                                    <span class="me-2">{{ Auth::user()->email }}</span>
                                    <span class="badge bg-white text-dark">
                                        <i class="mdi mdi-account-badge me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                    </span>
                                </div>
                                <div class="small mt-1">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    <strong>Login Terakhir:</strong>
                                    {{ session('last_login') ?? 'Belum pernah login' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-end">
                        <div class="bg-white text-primary rounded p-2">
                            <div class="fw-bold small">{{ now()->locale('id')->isoFormat('DD MMMM YYYY') }}</div>
                            <div class="small">{{ now()->format('H:i') }} WIB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth



{{-- Statistik Utama --}}
<div class="row mb-3">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 small">Total Warga</p>
                        <h5 class="fw-bold mb-0">{{ $totalWarga ?? 0 }}</h5>
                        <p class="text-muted mb-0 small">Orang terdaftar</p>
                    </div>
                    <div class="ms-2">
                        <i class="mdi mdi-account-multiple text-primary" style="font-size: 28px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 small">Kejadian Bencana</p>
                        <h5 class="fw-bold mb-0">{{ $totalKejadian ?? 0 }}</h5>
                        <p class="text-muted mb-0 small">Total kejadian</p>
                    </div>
                    <div class="ms-2">
                        <i class="mdi mdi-alert-circle text-danger" style="font-size: 28px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 small">Posko Bencana</p>
                        <h5 class="fw-bold mb-0">{{ $totalPosko ?? 0 }}</h5>
                        <p class="text-muted mb-0 small">Posko aktif</p>
                    </div>
                    <div class="ms-2">
                        <i class="mdi mdi-home-assistant text-success" style="font-size: 28px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1 small">Total Donasi</p>
                        <h5 class="fw-bold mb-0">Rp {{ number_format($totalNilaiDonasi ?? 0, 0, ',', '.') }}</h5>
                        <p class="text-muted mb-0 small">Nilai terkumpul</p>
                    </div>
                    <div class="ms-2">
                        <i class="mdi mdi-hand-heart text-info" style="font-size: 28px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Aksi Cepat --}}
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold text-primary mb-3">
                    <i class="mdi mdi-lightning-bolt-circle me-1"></i> Aksi Cepat
                </h6>
                <div class="row g-2">
                    <div class="col-md-3 col-6">
                        <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm w-100 py-2">
                            <i class="mdi mdi-account-plus me-1"></i> Tambah Warga
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-warning btn-sm w-100 py-2">
                            <i class="mdi mdi-alert-plus me-1"></i> Lapor Bencana
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('posko-bencana.create') }}" class="btn btn-success btn-sm w-100 py-2">
                            <i class="mdi mdi-home-plus me-1"></i> Buat Posko
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('donasi-bencana.create') }}" class="btn btn-info btn-sm w-100 py-2">
                            <i class="mdi mdi-cash-plus me-1"></i> Input Donasi
                        </a>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->role == 'super_admin')
                <div class="alert alert-danger mt-3 p-2 mb-0">
                    <div class="d-flex justify-content-between align-items-center small">
                        <div>
                            <i class="mdi mdi-shield-account me-1"></i>
                            <strong>Akses Super Admin</strong>
                            <span class="badge bg-light text-dark ms-1">Kontrol Sistem Penuh</span>
                        </div>
                        <a href="{{ route('user.index') }}" class="btn btn-danger btn-sm py-1 px-2">
                            <i class="mdi mdi-account-multiple me-1"></i> Kelola Pengguna
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Data Terbaru & Status --}}
<div class="row mb-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold text-primary mb-3">
                    <i class="mdi mdi-alert-circle-outline me-1"></i> Kejadian Bencana Terbaru
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th width="40%">Jenis Bencana</th>
                                <th width="20%">Tanggal</th>
                                <th width="25%">Status</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($kejadianTerbaru)
                                @forelse($kejadianTerbaru as $kejadian)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center small">
                                            <i class="mdi mdi-alert-circle text-danger me-2"></i>
                                            {{ Str::limit($kejadian->jenis_bencana, 15) }}
                                        </div>
                                    </td>
                                    <td class="small">{{ $kejadian->tanggal->format('d/m/Y') }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'dilaporkan' => 'secondary',
                                                'diverifikasi' => 'info',
                                                'ditangani' => 'warning',
                                                'selesai' => 'success'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$kejadian->status_kejadian] ?? 'secondary' }} small">
                                            {{ ucfirst($kejadian->status_kejadian) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}"
                                           class="btn btn-sm btn-outline-warning p-1" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-2 small">
                                        <i class="mdi mdi-alert-circle-outline me-1"></i> Tidak ada data
                                    </td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="4" class="text-center text-muted py-2 small">
                                    <i class="mdi mdi-alert-circle-outline me-1"></i> Data tidak tersedia
                                </td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 text-end">
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-arrow-right me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold text-primary mb-3">
                    <i class="mdi mdi-account-multiple me-1"></i> Warga Terbaru
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th width="50%">Nama</th>
                                <th width="30%">No. KTP</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($wargaTerbaru)
                                @forelse($wargaTerbaru as $warga)
                                <tr>
                                    <td class="small">{{ Str::limit($warga->nama, 18) }}</td>
                                    <td class="small">{{ Str::limit($warga->no_ktp, 12, '...') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                           class="btn btn-sm btn-outline-primary p-1" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-2 small">
                                        <i class="mdi mdi-account-off-outline me-1"></i> Tidak ada data
                                    </td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="3" class="text-center text-muted py-2 small">
                                    <i class="mdi mdi-account-off-outline me-1"></i> Data tidak tersedia
                                </td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 text-end">
                    <a href="{{ route('warga.index') }}" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-arrow-right me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Kejadian --}}
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold text-primary mb-3">
                    <i class="mdi mdi-chart-bar me-1"></i> Status Kejadian Bencana
                </h6>
                <div class="row g-2">
                    <div class="col-md-3 col-6">
                        <div class="border border-secondary rounded p-2 text-center">
                            <h5 class="text-secondary mb-1 fw-bold">{{ $kejadianDilaporkan ?? 0 }}</h5>
                            <p class="text-muted mb-0 small">Dilaporkan</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border border-info rounded p-2 text-center">
                            <h5 class="text-info mb-1 fw-bold">{{ $kejadianDiverifikasi ?? 0 }}</h5>
                            <p class="text-muted mb-0 small">Diverifikasi</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border border-warning rounded p-2 text-center">
                            <h5 class="text-warning mb-1 fw-bold">{{ $kejadianDitangani ?? 0 }}</h5>
                            <p class="text-muted mb-0 small">Ditangani</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="border border-success rounded p-2 text-center">
                            <h5 class="text-success mb-1 fw-bold">{{ $kejadianSelesai ?? 0 }}</h5>
                            <p class="text-muted mb-0 small">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    }
    .card {
        border-radius: 0.375rem;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem !important;
        font-size: 0.875rem !important;
    }
    .table-sm th,
    .table-sm td {
        padding: 0.5rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto slide setiap 6 detik
        $('#kebencanaanSlideshow').carousel({
            interval: 6000,
            pause: 'hover'
        });
    });
</script>
@endpush
