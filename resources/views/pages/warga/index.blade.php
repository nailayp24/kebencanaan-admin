{{-- resources/views/admin/warga/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Warga</h2>
        <a href="{{ route('warga.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Tambah Warga
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {{-- FILTER & SEARCH FORM --}}
            <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    {{-- Filter Jenis Kelamin --}}
                    <div class="col-md-2">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($jenisKelaminOptions as $key => $value)
                                <option value="{{ $key }}"
                                    {{ request('jenis_kelamin') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Agama --}}
                    <div class="col-md-2">
                        <label class="form-label">Agama</label>
                        <select name="agama" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Agama</option>
                            @foreach ($agamaOptions as $agama)
                                <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Pekerjaan --}}
                    <div class="col-md-2">
                        <label class="form-label">Pekerjaan</label>
                        <select name="pekerjaan" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Pekerjaan</option>
                            @foreach ($pekerjaanOptions as $pekerjaan)
                                <option value="{{ $pekerjaan }}"
                                    {{ request('pekerjaan') == $pekerjaan ? 'selected' : '' }}>
                                    {{ $pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Search --}}
                    <div class="col-md-4">
                        <label class="form-label">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Cari NIK, nama, telepon, atau email...">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-magnify"></i> Search
                            </button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="btn btn-outline-secondary">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Reset Filter --}}
                    <div class="col-md-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary w-100">
                            <i class="mdi mdi-refresh"></i> Reset
                        </a>
                    </div>

                    {{-- Info Filter Aktif --}}
                    @if (request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('search'))
                        <div class="col-12">
                            <div class="alert alert-info py-2">
                                <small>
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Filter aktif:
                                    @if (request('jenis_kelamin'))
                                        <span class="badge bg-primary me-2">
                                            Jenis Kelamin:
                                            {{ $jenisKelaminOptions[request('jenis_kelamin')] ?? request('jenis_kelamin') }}
                                        </span>
                                    @endif
                                    @if (request('agama'))
                                        <span class="badge bg-primary me-2">
                                            Agama: {{ request('agama') }}
                                        </span>
                                    @endif
                                    @if (request('pekerjaan'))
                                        <span class="badge bg-primary me-2">
                                            Pekerjaan: {{ request('pekerjaan') }}
                                        </span>
                                    @endif
                                    @if (request('search'))
                                        <span class="badge bg-primary me-2">
                                            Pencarian: "{{ request('search') }}"
                                        </span>
                                    @endif
                                </small>
                            </div>
                        </div>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $item)
                            <tr>
                                <td>{{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->no_ktp }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->jenis_kelamin == 'L' ? 'primary' : 'success' }}">
                                        {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->telp ?? '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data warga {{ $item->nama }}?')">
                                                <i class="mdi mdi-delete"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="mdi mdi-account-off-outline me-2"></i>
                                    @if (request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('search'))
                                        Tidak ada data warga yang sesuai dengan filter
                                    @else
                                        Tidak ada data warga
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $warga->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>
@endsection
