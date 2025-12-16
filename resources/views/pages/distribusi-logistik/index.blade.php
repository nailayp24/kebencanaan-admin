@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-truck-delivery me-2 text-primary"></i>Data Distribusi Logistik
                    </h5>
                    <a href="{{ route('distribusi-logistik.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Tambah Distribusi
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
                    <form method="GET" action="{{ route('distribusi-logistik.index') }}">
                        <div class="row g-3 align-items-end">
                            {{-- Filter Logistik --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-package-variant me-1 text-warning"></i>Logistik
                                </label>
                                <div class="dropdown-filter">
                                    <select name="logistik_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Logistik</option>
                                        @foreach($logistikOptions as $item)
                                            <option value="{{ $item->logistik_id }}"
                                                {{ request('logistik_id') == $item->logistik_id ? 'selected' : '' }}>
                                                {{ $item->nama_barang }} ({{ $item->satuan }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Posko --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-home-group me-1 text-info"></i>Posko
                                </label>
                                <div class="dropdown-filter">
                                    <select name="posko_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Posko</option>
                                        @foreach($poskoOptions as $item)
                                            <option value="{{ $item->posko_id }}"
                                                {{ request('posko_id') == $item->posko_id ? 'selected' : '' }}>
                                                {{ $item->nama }}
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
                                               placeholder="Cari penerima...">
                                        @if(request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                               class="btn btn-outline-secondary border-start-0" type="button">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Info Filter Aktif --}}
                            @if(request('logistik_id') || request('posko_id') || request('search'))
                                <div class="col-12 mt-3 pt-3 border-top">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <small class="text-muted me-2">Filter aktif:</small>
                                        @if(request('logistik_id'))
                                            @php
                                                $selectedLogistik = $logistikOptions->firstWhere('logistik_id', request('logistik_id'));
                                            @endphp
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-flex align-items-center">
                                                <i class="mdi mdi-package-variant me-1"></i>
                                                {{ $selectedLogistik ? $selectedLogistik->nama_barang : 'Logistik tidak ditemukan' }}
                                                <a href="{{ request()->fullUrlWithQuery(['logistik_id' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if(request('posko_id'))
                                            @php
                                                $selectedPosko = $poskoOptions->firstWhere('posko_id', request('posko_id'));
                                            @endphp
                                            <span class="badge bg-info-subtle text-info border border-info-subtle d-flex align-items-center">
                                                <i class="mdi mdi-home-group me-1"></i>
                                                {{ $selectedPosko ? $selectedPosko->nama : 'Posko tidak ditemukan' }}
                                                <a href="{{ request()->fullUrlWithQuery(['posko_id' => null]) }}"
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
                                        <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-sm btn-outline-danger ms-auto">
                                            <i class="mdi mdi-refresh me-1"></i> Reset Semua
                                        </a>
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
                                <th>Tanggal</th>
                                <th>Logistik</th>
                                <th>Posko</th>
                                <th class="text-center">Jumlah</th>
                                <th>Penerima</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($distribusi as $item)
                                <tr>
                                    <td class="text-center text-muted">{{ ($distribusi->currentPage() - 1) * $distribusi->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-medium">{{ $item->tanggal->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ $item->tanggal->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        @if($item->logistik)
                                            <div class="fw-medium">{{ $item->logistik->nama_barang }}</div>
                                            <small class="text-muted">{{ $item->logistik->satuan }}</small>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">Logistik Tidak Ditemukan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->posko)
                                            <div class="fw-medium">{{ $item->posko->nama }}</div>
                                            <small class="text-muted">{{ Str::limit($item->posko->alamat, 30) }}</small>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">Posko Tidak Ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                            {{ number_format($item->jumlah) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $item->penerima }}</div>
                                        @if($item->keterangan)
                                            <small class="text-muted">{{ Str::limit($item->keterangan, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('distribusi-logistik.show', $item->distribusi_id) }}"
                                               class="btn btn-sm btn-outline-info px-2"
                                               title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('distribusi-logistik.edit', $item->distribusi_id) }}"
                                               class="btn btn-sm btn-outline-warning px-2"
                                               title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('distribusi-logistik.destroy', $item->distribusi_id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2"
                                                        onclick="return confirm('Hapus distribusi ini?')"
                                                        title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="mdi mdi-truck-remove-outline display-4 text-muted"></i>
                                        <div class="mt-3 text-muted">
                                            @if(request('logistik_id') || request('posko_id') || request('search'))
                                                Tidak ada data distribusi yang sesuai dengan filter
                                            @else
                                                Belum ada data distribusi
                                            @endif
                                        </div>
                                        @if(request('logistik_id') || request('posko_id') || request('search'))
                                            <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-outline-primary mt-2">
                                                <i class="mdi mdi-refresh me-1"></i> Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('distribusi-logistik.create') }}" class="btn btn-primary mt-2">
                                                <i class="mdi mdi-plus me-1"></i> Tambah Distribusi Pertama
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($distribusi->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div class="text-muted small">
                            Menampilkan {{ $distribusi->firstItem() }} - {{ $distribusi->lastItem() }} dari {{ $distribusi->total() }} data
                        </div>
                        <div>
                            {{ $distribusi->links('pagination::bootstrap-5') }}
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
    }
</style>
@endpush
