{{-- resources/views/admin/warga/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-account-group me-2 text-primary"></i>Data Warga
                    </h5>
                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i> Tambah Warga
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
                    <form method="GET" action="{{ route('warga.index') }}">
                        <div class="row g-3 align-items-end">
                            {{-- Filter Jenis Kelamin --}}
                            <div class="col-md-3">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-gender-male-female me-1 text-info"></i>Jenis Kelamin
                                </label>
                                <div class="dropdown-filter">
                                    <select name="jenis_kelamin" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        @foreach ($jenisKelaminOptions as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ request('jenis_kelamin') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Agama --}}
                            <div class="col-md-3">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-star-of-david me-1 text-warning"></i>Agama
                                </label>
                                <div class="dropdown-filter">
                                    <select name="agama" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Agama</option>
                                        @foreach ($agamaOptions as $agama)
                                            <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>
                                                {{ $agama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Filter Pekerjaan --}}
                            <div class="col-md-3">
                                <label class="form-label fw-medium mb-2">
                                    <i class="mdi mdi-briefcase me-1 text-success"></i>Pekerjaan
                                </label>
                                <div class="dropdown-filter">
                                    <select name="pekerjaan" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Semua Pekerjaan</option>
                                        @foreach ($pekerjaanOptions as $pekerjaan)
                                            <option value="{{ $pekerjaan }}"
                                                {{ request('pekerjaan') == $pekerjaan ? 'selected' : '' }}>
                                                {{ $pekerjaan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Search --}}
                            <div class="col-md-3">
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
                                               placeholder="Cari NIK, nama, telepon...">
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
                                <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            </div>

                            {{-- Info Filter Aktif --}}
                            @if(request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('search'))
                                <div class="col-12 mt-3 pt-3 border-top">
                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                        <small class="text-muted me-2">Filter aktif:</small>
                                        @if(request('jenis_kelamin'))
                                            <span class="badge bg-info-subtle text-info border border-info-subtle d-flex align-items-center">
                                                <i class="mdi mdi-gender-male-female me-1"></i>
                                                {{ $jenisKelaminOptions[request('jenis_kelamin')] ?? request('jenis_kelamin') }}
                                                <a href="{{ request()->fullUrlWithQuery(['jenis_kelamin' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if(request('agama'))
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle d-flex align-items-center">
                                                <i class="mdi mdi-star-of-david me-1"></i>
                                                {{ request('agama') }}
                                                <a href="{{ request()->fullUrlWithQuery(['agama' => null]) }}"
                                                   class="ms-2 text-danger" title="Hapus filter">
                                                    <i class="mdi mdi-close-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if(request('pekerjaan'))
                                            <span class="badge bg-success-subtle text-success border border-success-subtle d-flex align-items-center">
                                                <i class="mdi mdi-briefcase me-1"></i>
                                                {{ request('pekerjaan') }}
                                                <a href="{{ request()->fullUrlWithQuery(['pekerjaan' => null]) }}"
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
                                <th>NIK</th>
                                <th>Nama</th>
                                <th width="120" class="text-center">Jenis Kelamin</th>
                                <th width="120">Agama</th>
                                <th width="150">Pekerjaan</th>
                                <th width="120">Telepon</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warga as $item)
                                <tr>
                                    <td class="text-center text-muted">{{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-medium">{{ $item->no_ktp }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $item->nama }}</div>
                                        @if($item->alamat)
                                            <small class="text-muted">{{ Str::limit($item->alamat, 30) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->jenis_kelamin == 'L')
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                                <i class="mdi mdi-gender-male me-1"></i> Laki-laki
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                <i class="mdi mdi-gender-female me-1"></i> Perempuan
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->agama }}</td>
                                    <td>
                                        @if($item->pekerjaan)
                                            @php
                                                // Warna berbeda berdasarkan jenis pekerjaan
                                                $pekerjaanColors = [
                                                    'PNS' => 'primary',
                                                    'Wiraswasta' => 'success',
                                                    'Pedagang' => 'warning',
                                                    'Petani' => 'info',
                                                    'Nelayan' => 'danger',
                                                    'Buruh' => 'secondary',
                                                    'Guru' => 'purple',
                                                    'Dokter' => 'pink',
                                                    'Karyawan Swasta' => 'indigo',
                                                    'Ibu Rumah Tangga' => 'teal',
                                                    'Pelajar/Mahasiswa' => 'orange',
                                                    'Tidak Bekerja' => 'dark',
                                                ];

                                                $color = 'secondary'; // default
                                                foreach($pekerjaanColors as $key => $value) {
                                                    if(str_contains(strtolower($item->pekerjaan), strtolower($key)) ||
                                                       strtolower($item->pekerjaan) == strtolower($key)) {
                                                        $color = $value;
                                                        break;
                                                    }
                                                }

                                                // Mapping warna Bootstrap
                                                $colorClasses = [
                                                    'primary' => ['bg' => 'primary-subtle', 'text' => 'primary', 'icon' => 'briefcase'],
                                                    'success' => ['bg' => 'success-subtle', 'text' => 'success', 'icon' => 'store'],
                                                    'warning' => ['bg' => 'warning-subtle', 'text' => 'warning', 'icon' => 'cart'],
                                                    'info' => ['bg' => 'info-subtle', 'text' => 'info', 'icon' => 'sprout'],
                                                    'danger' => ['bg' => 'danger-subtle', 'text' => 'danger', 'icon' => 'fish'],
                                                    'secondary' => ['bg' => 'secondary-subtle', 'text' => 'secondary', 'icon' => 'briefcase'],
                                                    'purple' => ['bg' => 'purple-subtle', 'text' => 'purple', 'icon' => 'school'],
                                                    'pink' => ['bg' => 'pink-subtle', 'text' => 'pink', 'icon' => 'medical-bag'],
                                                    'indigo' => ['bg' => 'indigo-subtle', 'text' => 'indigo', 'icon' => 'office-building'],
                                                    'teal' => ['bg' => 'teal-subtle', 'text' => 'teal', 'icon' => 'home'],
                                                    'orange' => ['bg' => 'orange-subtle', 'text' => 'orange', 'icon' => 'school'],
                                                    'dark' => ['bg' => 'dark-subtle', 'text' => 'dark', 'icon' => 'sleep'],
                                                ];

                                                $config = $colorClasses[$color] ?? $colorClasses['secondary'];
                                            @endphp
                                            <span class="badge {{ $config['bg'] }} text-{{ $config['text'] }} border border-{{ $config['text'] }}-subtle">
                                                <i class="mdi mdi-{{ $config['icon'] }} me-1"></i>
                                                {{ $item->pekerjaan }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->telp)
                                            <span class="badge bg-info-subtle text-info border border-info-subtle">
                                                <i class="mdi mdi-phone me-1"></i> {{ $item->telp }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                              <a href="{{ route('warga.show', $item->warga_id) }}"
                                                   class="btn btn-sm btn-outline-warning px-2"
                                                   title="Lihat Detail">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                               class="btn btn-sm btn-outline-warning px-2"
                                               title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2"
                                                        onclick="return confirm('Hapus warga {{ $item->nama }}?')"
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
                                        <i class="mdi mdi-account-off-outline display-4 text-muted"></i>
                                        <div class="mt-3 text-muted">
                                            @if(request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('search'))
                                                Tidak ada data warga yang sesuai dengan filter
                                            @else
                                                Belum ada data warga
                                            @endif
                                        </div>
                                        @if(request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('search'))
                                            <a href="{{ route('warga.index') }}" class="btn btn-outline-primary mt-2">
                                                <i class="mdi mdi-refresh me-1"></i> Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2">
                                                <i class="mdi mdi-plus me-1"></i> Tambah Warga Pertama
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($warga->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div class="text-muted small">
                            Menampilkan {{ $warga->firstItem() }} - {{ $warga->lastItem() }} dari {{ $warga->total() }} data
                        </div>
                        <div>
                            {{ $warga->links('pagination::bootstrap-5') }}
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

    /* Badge Styling - Pastikan warna terlihat jelas */
    .badge {
        padding: 4px 8px;
        font-weight: 500;
        border-radius: 4px;
        font-size: 12px;
        border-width: 1px;
        border-style: solid;
    }

    /* Custom color classes untuk badge pekerjaan */
    .bg-purple-subtle {
        background-color: rgba(111, 66, 193, 0.1) !important;
    }

    .text-purple {
        color: #6f42c1 !important;
    }

    .border-purple-subtle {
        border-color: rgba(111, 66, 193, 0.2) !important;
    }

    .bg-pink-subtle {
        background-color: rgba(232, 62, 140, 0.1) !important;
    }

    .text-pink {
        color: #e83e8c !important;
    }

    .border-pink-subtle {
        border-color: rgba(232, 62, 140, 0.2) !important;
    }

    .bg-indigo-subtle {
        background-color: rgba(102, 16, 242, 0.1) !important;
    }

    .text-indigo {
        color: #6610f2 !important;
    }

    .border-indigo-subtle {
        border-color: rgba(102, 16, 242, 0.2) !important;
    }

    .bg-teal-subtle {
        background-color: rgba(32, 201, 151, 0.1) !important;
    }

    .text-teal {
        color: #20c997 !important;
    }

    .border-teal-subtle {
        border-color: rgba(32, 201, 151, 0.2) !important;
    }

    .bg-orange-subtle {
        background-color: rgba(253, 126, 20, 0.1) !important;
    }

    .text-orange {
        color: #fd7e14 !important;
    }

    .border-orange-subtle {
        border-color: rgba(253, 126, 20, 0.2) !important;
    }

    .bg-dark-subtle {
        background-color: rgba(52, 58, 64, 0.1) !important;
    }

    .text-dark {
        color: #343a40 !important;
    }

    .border-dark-subtle {
        border-color: rgba(52, 58, 64, 0.2) !important;
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

    /* Button Styling */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
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
    }
</style>
@endpush
