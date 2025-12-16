@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-package-variant me-2 text-primary"></i>Data Logistik Bencana
                    </h5>
                    <a href="{{ route('logistik-bencana.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Tambah Logistik
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
                    <form method="GET" action="{{ route('logistik-bencana.index') }}">
                        <div class="row g-3 align-items-end">
                            {{-- Filter Kejadian Bencana --}}
                            <div class="col-md-4">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-alert-circle me-1 text-warning"></i>Kejadian Bencana
                                </label>
                                <div class="dropdown-filter">
                                    <select name="kejadian_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Kejadian</option>
                                        @foreach($kejadianOptions as $kejadian)
                                            <option value="{{ $kejadian->kejadian_id }}"
                                                {{ request('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                                {{ $kejadian->jenis_bencana }} - {{ $kejadian->tanggal_formatted }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Satuan --}}
                            <div class="col-md-3">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-scale-balance me-1 text-info"></i>Satuan
                                </label>
                                <div class="dropdown-filter">
                                    <select name="satuan" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Satuan</option>
                                        @foreach($satuanOptions as $satuan)
                                            <option value="{{ $satuan }}"
                                                {{ request('satuan') == $satuan ? 'selected' : '' }}>
                                                {{ $satuan }}
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
                                               placeholder="Cari nama barang atau sumber...">
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
                                <a href="{{ route('logistik-bencana.index') }}" class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            </div>

                            {{-- Info Filter Aktif --}}
                            @if(request('kejadian_id') || request('satuan') || request('search'))
                                <div class="col-12 mt-3 pt-3 border-top">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <small class="text-muted me-2">Filter aktif:</small>
                                        @if(request('kejadian_id'))
                                            @php
                                                $selectedKejadian = $kejadianOptions->firstWhere('kejadian_id', request('kejadian_id'));
                                            @endphp
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-flex align-items-center">
                                                <i class="mdi mdi-alert-circle me-1"></i>
                                                {{ $selectedKejadian ? $selectedKejadian->jenis_bencana : 'Kejadian tidak ditemukan' }}
                                                <a href="{{ request()->fullUrlWithQuery(['kejadian_id' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if(request('satuan'))
                                            <span class="badge bg-info-subtle text-info border border-info-subtle d-flex align-items-center">
                                                <i class="mdi mdi-scale-balance me-1"></i>
                                                {{ request('satuan') }}
                                                <a href="{{ request()->fullUrlWithQuery(['satuan' => null]) }}"
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
                                <th>Nama Barang</th>
                                <th>Kejadian Bencana</th>
                                <th>Satuan</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Stok Tersedia</th>
                                <th>Sumber</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logistik as $item)
                                <tr>
                                    <td class="text-center text-muted">{{ ($logistik->currentPage() - 1) * $logistik->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-medium">{{ $item->nama_barang }}</div>
                                    </td>
                                    <td>
                                        @if($item->kejadianBencana)
                                            <div class="fw-medium">{{ $item->kejadianBencana->jenis_bencana }}</div>
                                            <small class="text-muted">{{ Str::limit($item->kejadianBencana->lokasi_text, 30) }}</small>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">Kejadian Tidak Ditemukan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->satuan }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                            {{ number_format($item->stok) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $stokTersedia = $item->stok_tersedia;
                                            $class = $stokTersedia > 0 ? 'success' : 'danger';
                                            $bgClass = $stokTersedia > 0 ? 'success-subtle' : 'danger-subtle';
                                            $textClass = $stokTersedia > 0 ? 'success' : 'danger';
                                        @endphp
                                        <span class="badge bg-{{ $bgClass }} text-{{ $textClass }} border border-{{ $textClass }}-subtle px-2 py-1">
                                            {{ number_format($stokTersedia) }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($item->sumber, 20) }}</td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('logistik-bencana.show', $item->logistik_id) }}"
                                               class="btn btn-sm btn-outline-info px-2"
                                               title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('logistik-bencana.edit', $item->logistik_id) }}"
                                               class="btn btn-sm btn-outline-warning px-2"
                                               title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('logistik-bencana.destroy', $item->logistik_id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2"
                                                        onclick="return confirm('Hapus logistik {{ $item->nama_barang }}?')"
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
                                        <i class="mdi mdi-package-variant-off display-4 text-muted"></i>
                                        <div class="mt-3 text-muted">
                                            Tidak ada data logistik
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($logistik->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div class="text-muted small">
                            Menampilkan {{ $logistik->firstItem() }} - {{ $logistik->lastItem() }} dari {{ $logistik->total() }} data
                        </div>
                        <div>
                            {{ $logistik->links('pagination::bootstrap-5') }}
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
    }
</style>
@endpush
