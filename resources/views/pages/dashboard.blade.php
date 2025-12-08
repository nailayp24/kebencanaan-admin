{{-- resources/views/pages/dashboard.blade.php --}}
@extends('layouts.admin.app')

@section('content')

{{-- Welcome Section dengan Auth::user() --}}
@auth
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="mdi mdi-hand-wave" style="font-size: 48px;"></i>
                            </div>
                            <div>
                                <h2 class="mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0">
                                    <i class="mdi mdi-email-outline me-1"></i>{{ Auth::user()->email }}
                                    •
                                    <span class="badge bg-light text-dark ms-2">
                                        <i class="mdi mdi-account-badge me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                    </span>
                                </p>
                                <p class="mb-0 mt-2">
                                    <i class="mdi mdi-clock-outline me-1"></i>
                                    <strong>Last Login:</strong>
                                    {{ session('last_login') ?? 'Belum pernah login' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-end">
                        <div class="bg-white text-dark rounded p-3">
                            <i class="mdi mdi-calendar-clock me-1"></i>
                            <div class="mt-1">
                                <strong>{{ now()->format('d F Y') }}</strong>
                            </div>
                            <div>
                                <small>{{ now()->format('H:i') }} WIB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

<!-- Statistics Cards -->
<div class="row">
    <!-- Total Warga -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2">Total Warga</p>
                        <h4 class="font-weight-bold mb-0">{{ $totalWarga ?? 0 }}</h4>
                        <p class="text-muted mb-0">Orang terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="mdi mdi-account-multiple text-primary icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Kejadian Bencana -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2">Kejadian Bencana</p>
                        <h4 class="font-weight-bold mb-0">{{ $totalKejadian ?? 0 }}</h4>
                        <p class="text-muted mb-0">Total kejadian</p>
                    </div>
                    <div class="icon">
                        <i class="mdi mdi-alert-circle text-danger icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Posko -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2">Posko Bencana</p>
                        <h4 class="font-weight-bold mb-0">{{ $totalPosko ?? 0 }}</h4>
                        <p class="text-muted mb-0">Posko aktif</p>
                    </div>
                    <div class="icon">
                        <i class="mdi mdi-home-assistant text-success icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Donasi -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <p class="text-muted mb-2">Total Donasi</p>
                        <h4 class="font-weight-bold mb-0">Rp {{ number_format($totalNilaiDonasi ?? 0, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0">Nilai terkumpul</p>
                    </div>
                    <div class="icon">
                        <i class="mdi mdi-hand-heart text-info icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & User Info -->
<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-lightning-bolt-circle me-2"></i>Quick Actions
                </h4>
                <div class="row mt-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('warga.create') }}" class="btn btn-primary w-100 py-3">
                            <i class="mdi mdi-account-plus me-2"></i>
                            <div>Tambah Warga</div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-warning w-100 py-3">
                            <i class="mdi mdi-alert-plus me-2"></i>
                            <div>Lapor Bencana</div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('posko-bencana.create') }}" class="btn btn-success w-100 py-3">
                            <i class="mdi mdi-home-plus me-2"></i>
                            <div>Buat Posko</div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('donasi-bencana.create') }}" class="btn btn-info w-100 py-3">
                            <i class="mdi mdi-cash-plus me-2"></i>
                            <div>Input Donasi</div>
                        </a>
                    </div>
                </div>

                {{-- Super Admin Section --}}
                @if(Auth::check() && Auth::user()->role == 'super_admin')
                <div class="alert alert-danger mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="mdi mdi-shield-account me-2"></i>
                            <strong>Super Admin Access</strong>
                            <span class="badge bg-light text-dark ms-2">Full System Control</span>
                        </div>
                        <a href="{{ route('user.index') }}" class="btn btn-danger">
                            <i class="mdi mdi-account-multiple me-1"></i>User Management
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- User Info -->
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-account-circle me-2"></i>User Information
                </h4>
                <div class="text-center mt-4">
                    <div class="mb-3">
                        <i class="mdi mdi-account" style="font-size: 72px; color: #6c757d;"></i>
                    </div>
                    <h5 class="mb-1">{{ Auth::user()->name ?? 'Guest' }}</h5>
                    <p class="text-muted mb-3">{{ Auth::user()->email ?? 'Not logged in' }}</p>

                    {{-- Role Badge --}}
                    @auth
                    <div class="mb-4">
                        <span class="badge bg-{{ Auth::user()->role == 'super_admin' ? 'danger' : (Auth::user()->role == 'admin' ? 'warning' : 'info') }} p-2" style="font-size: 14px;">
                            <i class="mdi mdi-account-badge me-1"></i>
                            {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                        </span>
                    </div>
                    @endauth

                    {{-- Login Info --}}
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">User ID</small>
                                <div><strong>#{{ Auth::id() ?? 'N/A' }}</strong></div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Last Login</small>
                                <div><strong>{{ session('last_login') ? \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', session('last_login'))->format('H:i') : 'N/A' }}</strong></div>
                            </div>
                        </div>
                    </div>

                    {{-- Logout Button --}}
                    <div class="mt-4">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-outline-danger w-100">
                            <i class="mdi mdi-logout me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row">
    <!-- Kejadian Terbaru -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>Kejadian Bencana Terbaru
                </h4>
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Jenis Bencana</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($kejadianTerbaru)
                                @forelse($kejadianTerbaru as $kejadian)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-alert-circle text-danger me-2"></i>
                                            <span>{{ $kejadian->jenis_bencana }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $kejadian->tanggal->format('d/m/Y') }}</td>
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
                                        <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Edit Kejadian">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                        Tidak ada data kejadian bencana
                                    </td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                                    Data tidak tersedia
                                </td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-right me-1"></i> Lihat Semua Kejadian
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Warga Terbaru -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-account-multiple me-2"></i>Warga Terbaru Terdaftar
                </h4>
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No. KTP</th>
                                <th>Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($wargaTerbaru)
                                @forelse($wargaTerbaru as $warga)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-account text-primary me-2"></i>
                                            <span>{{ $warga->nama }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $warga->no_ktp }}</td>
                                    <td>{{ $warga->pekerjaan }}</td>
                                    <td>
                                        <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit Warga">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        <i class="mdi mdi-account-off-outline me-2"></i>
                                        Tidak ada data warga
                                    </td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    <i class="mdi mdi-account-off-outline me-2"></i>
                                    Data tidak tersedia
                                </td>
                            </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="{{ route('warga.index') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-right me-1"></i> Lihat Semua Warga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Kejadian Overview -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-chart-bar me-2"></i>Status Kejadian Bencana
                </h4>
                <div class="row mt-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-secondary">
                            <div class="card-body text-center">
                                <h2 class="text-secondary">{{ $kejadianDilaporkan ?? 0 }}</h2>
                                <p class="text-muted mb-0">Dilaporkan</p>
                                <small class="text-muted">Menunggu verifikasi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <h2 class="text-info">{{ $kejadianDiverifikasi ?? 0 }}</h2>
                                <p class="text-muted mb-0">Diverifikasi</p>
                                <small class="text-muted">Telah diverifikasi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h2 class="text-warning">{{ $kejadianDitangani ?? 0 }}</h2>
                                <p class="text-muted mb-0">Ditangani</p>
                                <small class="text-muted">Dalam penanganan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <h2 class="text-success">{{ $kejadianSelesai ?? 0 }}</h2>
                                <p class="text-muted mb-0">Selesai</p>
                                <small class="text-muted">Penanganan selesai</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Role Information -->
@auth
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="mdi mdi-shield-account-outline me-2"></i>Informasi Hak Akses Berdasarkan Role
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card border-info h-100">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">
                                    <i class="mdi mdi-account me-2"></i>User Biasa
                                </h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Lihat semua data
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Input data baru
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Edit data sendiri
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-close-circle text-danger me-2"></i>
                                        User Management
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card border-warning h-100">
                            <div class="card-header bg-warning text-white">
                                <h6 class="mb-0">
                                    <i class="mdi mdi-account-star me-2"></i>Administrator
                                </h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Semua hak User Biasa
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Edit semua data
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Hapus data
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-close-circle text-danger me-2"></i>
                                        User Management
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card border-danger h-100">
                            <div class="card-header bg-danger text-white">
                                <h6 class="mb-0">
                                    <i class="mdi mdi-shield-account me-2"></i>Super Admin
                                </h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Semua hak Administrator
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        User Management
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Akses penuh sistem
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        Sistem kontrol penuh
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Current Role Info --}}
                <div class="alert alert-{{ Auth::user()->role == 'super_admin' ? 'danger' : (Auth::user()->role == 'admin' ? 'warning' : 'info') }} mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="mdi mdi-account-circle me-2"></i>
                            <strong>Role Anda Saat Ini:</strong>
                            <span class="badge bg-{{ Auth::user()->role == 'super_admin' ? 'danger' : (Auth::user()->role == 'admin' ? 'warning' : 'info') }} ms-2">
                                {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                            </span>
                        </div>
                        <div>
                            <i class="mdi mdi-login me-1"></i>
                            <small>Terakhir login: {{ session('last_login') ?? 'Belum pernah' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

@endsection
