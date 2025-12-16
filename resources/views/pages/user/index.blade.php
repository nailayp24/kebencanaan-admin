{{-- resources/views/admin/user/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-account-multiple me-2 text-primary"></i>Data User
                    </h5>
                    @if(Auth::check() && Auth::user()->role == 'super_admin')
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus me-1"></i> Tambah User
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-check-circle-outline fs-5 me-2"></i>
                            <div class="flex-grow-1">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-alert-circle-outline fs-5 me-2"></i>
                            <div class="flex-grow-1">
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-alert-outline fs-5 me-2"></i>
                            <div class="flex-grow-1">
                                {{ session('warning') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->role == 'super_admin')
                    {{-- FILTER & SEARCH --}}
                    <div class="filter-container bg-light-subtle rounded-3 p-4 mb-4 border">
                        <form method="GET" action="{{ route('user.index') }}">
                            <div class="row g-3 align-items-end">
                                {{-- Search --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="mdi mdi-magnify me-1 text-primary"></i>Pencarian
                                    </label>
                                    <div class="search-box">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="mdi mdi-magnify text-primary"></i>
                                            </span>
                                            <input type="text" name="search" class="form-control border-start-0"
                                                   value="{{ request('search') }}"
                                                   placeholder="Cari nama atau email...">
                                            @if(request('search'))
                                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                   class="btn btn-outline-secondary border-start-0" type="button">
                                                    <i class="mdi mdi-close"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Filter Role --}}
                                <div class="col-md-3">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="mdi mdi-account-key me-1 text-warning"></i>Role
                                    </label>
                                    <div class="dropdown-filter">
                                        <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="">Semua Role</option>
                                            <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>
                                                Super Admin
                                            </option>
                                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>
                                                User
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Filter Status --}}
                                <div class="col-md-3">
                                    <label class="form-label fw-medium mb-2">
                                        <i class="mdi mdi-shield-check me-1 text-info"></i>Status Verifikasi
                                    </label>
                                    <div class="dropdown-filter">
                                        <select name="email_verified_at" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            <option value="verified" {{ request('email_verified_at') == 'verified' ? 'selected' : '' }}>
                                                Terverifikasi
                                            </option>
                                            <option value="not_verified" {{ request('email_verified_at') == 'not_verified' ? 'selected' : '' }}>
                                                Belum Verifikasi
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Reset Button --}}
                                <div class="col-md-1">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>

                                {{-- Info Filter Aktif --}}
                                @if(request('search') || request('role') || request('email_verified_at'))
                                    <div class="col-12 mt-3 pt-3 border-top">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <small class="text-muted me-2">Filter aktif:</small>
                                            @if(request('search'))
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle d-flex align-items-center">
                                                    <i class="mdi mdi-magnify me-1"></i>
                                                    "{{ request('search') }}"
                                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                       class="ms-2 text-danger" title="Hapus filter">
                                                        <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </span>
                                            @endif
                                            @if(request('role'))
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-flex align-items-center">
                                                    <i class="mdi mdi-account-key me-1"></i>
                                                    {{ ucfirst(str_replace('_', ' ', request('role'))) }}
                                                    <a href="{{ request()->fullUrlWithQuery(['role' => null]) }}"
                                                       class="ms-2 text-danger" title="Hapus filter">
                                                        <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </span>
                                            @endif
                                            @if(request('email_verified_at'))
                                                <span class="badge bg-info-subtle text-info border border-info-subtle d-flex align-items-center">
                                                    <i class="mdi mdi-shield-check me-1"></i>
                                                    {{ request('email_verified_at') == 'verified' ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                                    <a href="{{ request()->fullUrlWithQuery(['email_verified_at' => null]) }}"
                                                       class="ms-2 text-danger" title="Hapus filter">
                                                        <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50" class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th width="120" class="text-center">Role</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="120" class="text-center">Dibuat</th>
                                    <th width="140" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataUser as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{ ($dataUser->currentPage() - 1) * $dataUser->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-3">
                                                    @if($item->profile_picture)
                                                        <img src="{{ Storage::url($item->profile_picture) }}"
                                                             alt="{{ $item->name }}"
                                                             class="rounded-circle"
                                                             style="width: 36px; height: 36px; object-fit: cover;"
                                                             onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzYiIGhlaWdodD0iMzYiIHZpZXdCb3g9IjAgMCAzNiAzNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjM2IiBoZWlnaHQ9IjM2IiByeD0iMTgiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTE4IDIwQzIxLjMxMzcgMjAgMjQgMTcuMzEzNyAyNCAxNEMyNCAxMC42ODYzIDIxLjMxMzcgOCAxOCA4QzE0LjY4NjMgOCAxMiAxMC42ODYzIDEyIDE0QzEyIDE3LjMxMzcgMTQuNjg2MyAyMCAxOCAyMFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTE4IDIyLjVDMTIuMjA4OCAyMi41IDcuNSAyNy4yMDg4IDcuNSAzM0gyOC41QzI4LjUgMjcuMjA4OCAyMy43OTEyIDIyLjUgMTggMjIuNVoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=='">
                                                    @else
                                                        {{-- Placeholder Avatar (SVG Compressed) --}}
                                                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzYiIGhlaWdodD0iMzYiIHZpZXdCb3g9IjAgMCAzNiAzNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjM2IiBoZWlnaHQ9IjM2IiByeD0iMTgiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTE4IDIwQzIxLjMxMzcgMjAgMjQgMTcuMzEzNyAyNCAxNEMyNCAxMC42ODYzIDIxLjMxMzcgOCAxOCA4QzE0LjY4NjMgOCAxMiAxMC42ODYzIDEyIDE0QzEyIDE3LjMxMzcgMTQuNjg2MyAyMCAxOCAyMFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTE4IDIyLjVDMTIuMjA4OCAyMjUgNy41IDI3LjIwODggNy41IDMzSDI4LjVDMjguNSAyNy4yMDg4IDIzLjc5MTIgMjIuNSAxOCAyMi41WiIgZmlsbD0iI0Q1RDZEQiIvPgo8L3N2Zz4K"
                                                             alt="{{ $item->name }}"
                                                             class="rounded-circle"
                                                             style="width: 36px; height: 36px;">
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="fw-medium">{{ $item->name }}</div>
                                                    <small class="text-muted">ID: {{ $item->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td class="text-center">
                                            @if($item->role == 'super_admin')
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Super Admin</span>
                                            @elseif($item->role == 'admin')
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Admin</span>
                                            @else
                                                <span class="badge bg-info-subtle text-info border border-info-subtle">User</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->email_verified_at)
                                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                    <i class="mdi mdi-check-circle me-1"></i> Terverifikasi
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                                    <i class="mdi mdi-clock-outline me-1"></i> Belum Verifikasi
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="text-nowrap">{{ $item->created_at->format('d/m/Y') }}</div>
                                            <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 justify-content-center">
                                                {{-- TOMBOL SHOW --}}
                                                <a href="{{ route('user.show', $item->id) }}"
                                                   class="btn btn-sm btn-outline-info px-2"
                                                   title="Lihat Detail">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                {{-- TOMBOL EDIT --}}
                                                <a href="{{ route('user.edit', $item->id) }}"
                                                   class="btn btn-sm btn-outline-warning px-2"
                                                   title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                {{-- TOMBOL DELETE --}}
                                                @if($item->id !== auth()->id())
                                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger px-2"
                                                                onclick="return confirm('Hapus user {{ $item->name }}?')"
                                                                title="Hapus">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary px-2" disabled title="Akun sendiri">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            {{-- Placeholder Empty State --}}
                                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iMjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTYwIDQwQzcwLjYwOTUgNDAgNzkgNDguNjA5NSA3OSA1OS4yNUM3OSA2OS44OTA1IDcwLjYwOTUgNzguNSA2MCA3OC41QzQ5LjM5MDUgNzguNSA0MSA2OS44OTA1IDQxIDU5LjI1QzQxIDQ4LjYwOTUgNDkuMzkwNSA0MCA2MCA0MFoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTYwIDg0LjVDNDMuNjMwNyA4NC41IDMwLjUgOTcuNjMwNyAzMC41IDExNEg4OS41Qzg5LjUgOTcuNjMwNyA3Ni4zNjkyIDg0LjUgNjAgODQuNVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTk0IDMwSDc2VjM0SDk0VjMwWiIgZmlsbD0iI0Q1RDZEQiIvPgo8cGF0aCBkPSJNNjIgMzBINDZWMzRINjJWMzBaIiBmaWxsPSIjRDVENkRCIi8+CjxwYXRoIGQ9Ik0yNiAzMEg0NlYzNEgyNlYzMFoiIGZpbGw9IiNENUQ2REIiLz4KPC9zdmc+Cg=="
                                                 alt="No users"
                                                 class="mb-3"
                                                 style="width: 120px; height: 120px;">
                                            <div class="mt-3 text-muted">
                                                @if(request('search') || request('role') || request('email_verified_at'))
                                                    Tidak ada data user yang sesuai dengan filter
                                                @else
                                                    Belum ada data user
                                                @endif
                                            </div>
                                            @if(request('search') || request('role') || request('email_verified_at'))
                                                <a href="{{ route('user.index') }}" class="btn btn-outline-primary mt-2">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset Filter
                                                </a>
                                            @else
                                                <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                                    <i class="mdi mdi-plus me-1"></i> Tambah User Pertama
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if($dataUser->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="text-muted small">
                                Menampilkan {{ $dataUser->firstItem() }} - {{ $dataUser->lastItem() }} dari {{ $dataUser->total() }} data
                            </div>
                            <div>
                                {{ $dataUser->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                @else
                    {{-- TAMPILAN UNTUK NON-SUPER ADMIN --}}
                    <div class="text-center py-5">
                        {{-- Placeholder Access Denied --}}
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iMjAiIGZpbGw9IiNGNkUyRTMiLz4KPHBhdGggZD0iTTY2LjY0MjggMzguNjM4Mkw4NS42NjQ0IDU3LjkzMzFMMTAxLjIxMyA0Mi4zMTM5TDk3LjA5MTIgMzguMTM5NUw4NS42NjQ0IDQ5LjY1MjRMNzAuMzE2NyAzNC4yMTkyTDY2LjY0MjggMzguNjM4MloiIGZpbGw9IiNEQzM1NDUiLz4KPHBhdGggZD0iTTk0IDY1LjY2NjdIODZWNzFIOThWNTNIMzZWNzFINDhWNjUuNjY2N0g0MFY1OC4zMzMzSDk0VjY1LjY2NjdaIiBmaWxsPSIjREMzNTQ1Ii8+CjxyZWN0IHg9IjQ1IiB5PSI4MCIgd2lkdGg9IjMwIiBoZWlnaHQ9IjYiIHJ4PSIzIiBmaWxsPSIjREMzNTQ1Ii8+Cjwvc3ZnPgo="
                             alt="Access Denied"
                             class="mb-3"
                             style="width: 120px; height: 120px;">
                        <h3 class="mt-4">Akses Ditolak!</h3>
                        <p class="text-muted">Hanya <strong>Super Admin</strong> yang dapat mengakses halaman User Management.</p>
                        <p>Role Anda:
                            <span class="badge bg-{{ Auth::user()->role == 'admin' ? 'warning-subtle text-warning border border-warning-subtle' : 'info-subtle text-info border border-info-subtle' }}">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Filter Container */
    .filter-container {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    /* Dropdown Styling */
    .dropdown-filter .form-select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        background-color: white;
        font-size: 14px;
        padding: 6px 12px;
        height: 36px;
        transition: border-color 0.15s ease-in-out;
    }

    .dropdown-filter .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    /* Search Box */
    .search-box .input-group {
        border-radius: 4px;
        overflow: hidden;
    }

    .search-box .input-group-text {
        background-color: white;
        border: 1px solid #ced4da;
        border-right: none;
        color: #0d6efd;
        padding: 0.375rem 0.75rem;
    }

    .search-box input {
        border: 1px solid #ced4da;
        border-left: none;
        font-size: 14px;
        padding: 6px 12px;
        height: 36px;
        color: #000;
    }

    .search-box input::placeholder {
        color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Badge Styling */
    .badge {
        padding: 4px 8px;
        font-weight: 500;
        border-radius: 4px;
        font-size: 12px;
    }

    /* Table Styling */
    .table th {
        font-weight: 600;
        font-size: 0.875rem;
        color: #495057;
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        padding: 12px 8px;
    }

    .table td {
        vertical-align: middle;
        padding: 10px 8px;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
    }

    /* Avatar Styling */
    .avatar {
        flex-shrink: 0;
    }

    /* Button Styling */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Button Colors for Actions */
    .btn-outline-info {
        color: #0dcaf0;
        border-color: #0dcaf0;
    }
    .btn-outline-info:hover {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
        color: white;
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }
    .btn-outline-warning:hover {
        background-color: #ffc107;
        border-color: #ffc107;
        color: white;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-outline-secondary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Action Button Group */
    .d-flex.gap-1 {
        gap: 0.25rem !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-container .col-md-4,
        .filter-container .col-md-3 {
            margin-bottom: 1rem;
        }

        .table-responsive {
            font-size: 13px;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.8rem;
        }

        .table td, .table th {
            padding: 8px 4px;
        }

        /* Adjust action column for mobile */
        .d-flex.gap-1 {
            gap: 0.125rem !important;
        }

        .btn-sm.px-2 {
            padding: 0.2rem 0.3rem !important;
        }
    }

    /* Hover Effects */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transition: background-color 0.2s ease;
    }

    .btn-sm {
        transition: all 0.2s ease;
    }

    .btn-sm:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Tooltip Style */
    [title] {
        position: relative;
    }

    [title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
        margin-bottom: 5px;
    }

    [title]:hover::before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: #333;
        margin-bottom: -5px;
        z-index: 1000;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Add confirmation for delete action
    $('form button[type="submit"]').on('click', function(e) {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            e.preventDefault();
        }
    });

    // Tooltip initialization
    $('[title]').tooltip({
        trigger: 'hover',
        placement: 'top'
    });

    // Smooth hover effect for table rows
    $('.table-hover tbody tr').hover(
        function() {
            $(this).css('transform', 'scale(1.002)');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );

    // Action button hover effect
    $('.btn-sm').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});
</script>
@endpush
