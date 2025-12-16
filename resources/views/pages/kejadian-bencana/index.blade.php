{{-- resources/views/admin/kejadian-bencana/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-alert-circle-outline me-2 text-primary"></i>Data Kejadian Bencana
                    </h5>
                    <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Tambah Kejadian
                    </a>
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

                {{-- FILTER & SEARCH --}}
                <div class="filter-container bg-light-subtle rounded-3 p-4 mb-4 border">
                    <form method="GET" action="{{ route('kejadian-bencana.index') }}">
                        <div class="row g-3 align-items-end">
                            {{-- Filter Jenis Bencana --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-alert me-1 text-warning"></i>Jenis Bencana
                                </label>
                                <div class="dropdown-filter">
                                    <select name="jenis_bencana" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Jenis</option>
                                        @foreach($jenisBencanaOptions as $jenis)
                                            <option value="{{ $jenis }}"
                                                {{ request('jenis_bencana') == $jenis ? 'selected' : '' }}>
                                                {{ $jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Status --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-flag me-1 text-info"></i>Status Kejadian
                                </label>
                                <div class="dropdown-filter">
                                    <select name="status_kejadian" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Status</option>
                                        @foreach($statusOptions as $status)
                                            <option value="{{ $status }}"
                                                {{ request('status_kejadian') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
                                               placeholder="Cari lokasi, dampak...">
                                        @if(request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                               class="btn btn-outline-secondary border-start-0" type="button">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Reset Button --}}
                            <div class="col-md-1">
                                <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            </div>

                            {{-- Info Filter Aktif --}}
                            @if(request('jenis_bencana') || request('status_kejadian') || request('search'))
                                <div class="col-12 mt-3 pt-3 border-top">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <small class="text-muted me-2">Filter aktif:</small>
                                        @if(request('jenis_bencana'))
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-flex align-items-center">
                                                <i class="mdi mdi-alert me-1"></i>
                                                {{ request('jenis_bencana') }}
                                                <a href="{{ request()->fullUrlWithQuery(['jenis_bencana' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if(request('status_kejadian'))
                                            <span class="badge bg-info-subtle text-info border border-info-subtle d-flex align-items-center">
                                                <i class="mdi mdi-flag me-1"></i>
                                                {{ ucfirst(request('status_kejadian')) }}
                                                <a href="{{ request()->fullUrlWithQuery(['status_kejadian' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
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
                                <th>Jenis Bencana</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th width="100" class="text-center">RT / RW</th>
                                <th>Dampak</th>
                                <th width="120" class="text-center">Status</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kejadian as $item)
                                <tr>
                                    <td class="text-center text-muted fw-medium">
                                        {{ ($kejadian->currentPage() - 1) * $kejadian->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $item->jenis_bencana }}</div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap fw-medium">{{ $item->tanggal->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ $item->tanggal->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ Str::limit($item->lokasi_text, 30) }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="rt-rw-container">
                                            <div class="rt-rw-badge">
                                                <span class="rt-label">RT</span>
                                                <span class="rt-value">{{ str_pad($item->rt, 3, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                            <div class="separator">/</div>
                                            <div class="rt-rw-badge">
                                                <span class="rw-label">RW</span>
                                                <span class="rw-value">{{ str_pad($item->rw, 3, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;" title="{{ $item->dampak }}">
                                            {{ Str::limit($item->dampak, 50) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusColors = [
                                                'dilaporkan' => ['bg' => 'warning-subtle', 'text' => 'warning', 'icon' => 'flag'],
                                                'diverifikasi' => ['bg' => 'info-subtle', 'text' => 'info', 'icon' => 'check-circle'],
                                                'ditangani' => ['bg' => 'primary-subtle', 'text' => 'primary', 'icon' => 'account-hard-hat'],
                                                'selesai' => ['bg' => 'success-subtle', 'text' => 'success', 'icon' => 'check-all'],
                                            ];
                                            $statusConfig = $statusColors[$item->status_kejadian] ?? ['bg' => 'secondary-subtle', 'text' => 'secondary', 'icon' => 'help-circle'];
                                        @endphp
                                        <span class="badge {{ $statusConfig['bg'] }} text-{{ $statusConfig['text'] }} border border-{{ $statusConfig['text'] }}-subtle fw-medium">
                                            <i class="mdi mdi-{{ $statusConfig['icon'] }} me-1"></i>
                                            {{ ucfirst($item->status_kejadian) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('kejadian-bencana.show', $item->kejadian_id) }}"
                                               class="btn btn-sm btn-outline-info px-2"
                                               title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('kejadian-bencana.edit', $item->kejadian_id) }}"
                                               class="btn btn-sm btn-outline-warning px-2"
                                               title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('kejadian-bencana.destroy', $item->kejadian_id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2"
                                                        onclick="return confirm('Hapus kejadian bencana {{ $item->jenis_bencana }}?')"
                                                        title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="mdi mdi-alert-off-outline display-4 text-muted"></i>
                                        <div class="mt-3 text-muted">
                                            @if(request('jenis_bencana') || request('status_kejadian') || request('search'))
                                                Tidak ada data kejadian bencana yang sesuai dengan filter
                                            @else
                                                Belum ada data kejadian bencana
                                            @endif
                                        </div>
                                        @if(request('jenis_bencana') || request('status_kejadian') || request('search'))
                                            <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-outline-primary mt-2">
                                                <i class="mdi mdi-refresh me-1"></i> Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-primary mt-2">
                                                <i class="mdi mdi-plus me-1"></i> Tambah Kejadian Pertama
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($kejadian->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div class="text-muted small">
                            Menampilkan {{ $kejadian->firstItem() }} - {{ $kejadian->lastItem() }} dari {{ $kejadian->total() }} data
                        </div>
                        <div>
                            {{ $kejadian->links('pagination::bootstrap-5') }}
                        </div>
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

    /* RT/RW STYLING YANG JELAS DAN MENONJOL */
    .rt-rw-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2px;
        background: #f8f9fa;
        padding: 4px 6px;
        border-radius: 6px;
        border: 1px solid #dee2e6;
        min-width: 90px;
    }

    .rt-rw-badge {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2px 4px;
        min-width: 28px;
    }

    .rt-label, .rw-label {
        font-size: 9px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1px;
    }

    .rt-value, .rw-value {
        font-size: 13px;
        font-weight: 700;
        color: #495057;
        background: white;
        padding: 1px 4px;
        border-radius: 3px;
        border: 1px solid #ced4da;
        min-width: 24px;
        text-align: center;
        font-family: 'Courier New', monospace;
    }

    .rt-value {
        color: #0d6efd;
        border-color: #b6d4fe;
        background-color: #e7f1ff;
    }

    .rw-value {
        color: #198754;
        border-color: #badbcc;
        background-color: #d1e7dd;
    }

    .separator {
        font-size: 14px;
        font-weight: 600;
        color: #adb5bd;
        margin: 0 2px;
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

    /* Highlight text */
    .fw-semibold {
        font-weight: 600 !important;
    }

    .text-dark {
        color: #212529 !important;
    }

    /* Button Styling */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-container .col-md-4 {
            margin-bottom: 1rem;
        }

        .table-responsive {
            font-size: 13px;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.8rem;
        }

        /* RT/RW Responsive */
        .rt-rw-container {
            min-width: 80px;
            padding: 3px 4px;
        }

        .rt-label, .rw-label {
            font-size: 8px;
        }

        .rt-value, .rw-value {
            font-size: 11px;
            min-width: 20px;
            padding: 1px 3px;
        }

        .separator {
            font-size: 12px;
        }
    }

    @media (max-width: 576px) {
        .rt-rw-container {
            flex-direction: column;
            gap: 1px;
            padding: 3px;
        }

        .separator {
            display: none;
        }

        .rt-rw-badge {
            flex-direction: row;
            gap: 3px;
        }

        .rt-label, .rw-label {
            margin-bottom: 0;
        }
    }
</style>
@endpush
