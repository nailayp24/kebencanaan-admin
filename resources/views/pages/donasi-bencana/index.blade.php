{{-- resources/views/pages/donasi-bencana/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="mdi mdi-hand-heart me-2"></i>Data Donasi Bencana
        </h2>
        <a href="{{ route('donasi-bencana.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus me-1"></i> Tambah Donasi
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                   {{-- FILTER & SEARCH FORM --}}
            <form method="GET" action="{{ route('donasi-bencana.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    {{-- Filter Kejadian Bencana --}}
                    <div class="col-md-3">
                        <label class="form-label">Kejadian Bencana</label>
                        <select name="kejadian_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kejadian</option>
                            @foreach($kejadianOptions as $kejadian)
                                <option value="{{ $kejadian->kejadian_id }}"
                                    {{ request('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                    {{ $kejadian->jenis_bencana }} - {{ \Carbon\Carbon::parse($kejadian->tanggal)->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Jenis Donasi --}}
                    <div class="col-md-2">
                        <label class="form-label">Jenis Donasi</label>
                        <select name="jenis" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisOptions as $key => $value)
                                <option value="{{ $key }}"
                                    {{ request('jenis') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Search --}}
                    <div class="col-md-4">
                        <label class="form-label">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama donatur atau keterangan...">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-magnify"></i> Search
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                   class="btn btn-outline-secondary">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Reset Filter --}}
                    <div class="col-md-3">
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary w-100">
                            <i class="mdi mdi-refresh"></i> Reset Filter
                        </a>
                    </div>

                    {{-- Info Filter Aktif --}}
                    @if(request('kejadian_id') || request('jenis') || request('search'))
                        <div class="col-12">
                            <div class="alert alert-info py-2">
                                <small>
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Filter aktif:
                                    @if(request('kejadian_id'))
                                        @php
                                            $selectedKejadian = $kejadianOptions->firstWhere('kejadian_id', request('kejadian_id'));
                                        @endphp
                                        <span class="badge bg-primary me-2">
                                            Kejadian: {{ $selectedKejadian ? $selectedKejadian->jenis_bencana : 'Tidak Ditemukan' }}
                                        </span>
                                    @endif
                                    @if(request('jenis'))
                                        <span class="badge bg-primary me-2">
                                            Jenis: {{ $jenisOptions[request('jenis')] ?? request('jenis') }}
                                        </span>
                                    @endif
                                    @if(request('search'))
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
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Donatur</th>
                            <th>Kejadian Bencana</th>
                            <th>Jenis Donasi</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donasi as $item)
                            <tr>
                               <td>{{ ($donasi->currentPage() - 1) * $donasi->perPage() + $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->donatur_nama }}</strong>
                                    @if ($item->keterangan)
                                        <br><small class="text-muted">{{ Str::limit($item->keterangan, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->kejadianBencana)
                                        <span class="badge bg-info">{{ $item->kejadianBencana->jenis_bencana }}</span><br>
                                        <small>{{ Str::limit($item->kejadianBencana->lokasi_text, 40) }}</small>
                                    @else
                                        <span class="badge bg-warning">Data Kejadian Tidak Ditemukan</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $item->jenis == 'uang' ? 'success' : ($item->jenis == 'barang' ? 'warning' : 'info') }}">
                                        {{ $item->jenis_donasi }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->nilai)
                                        <strong>{{ $item->nilai_formatted }}</strong>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('donasi-bencana.show', $item->donasi_id) }}" class="btn btn-info"
                                            title="Lihat Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ route('donasi-bencana.edit', $item->donasi_id) }}"
                                            class="btn btn-warning" title="Edit Donasi">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('donasi-bencana.destroy', $item->donasi_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus donasi {{ $item->donatur_nama }}?')"
                                                title="Hapus Donasi">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="mdi mdi-hand-heart-outline me-2"></i>
                                    @if(request('kejadian_id') || request('jenis') || request('search'))
                                        Tidak ada data donasi yang sesuai dengan filter
                                    @else
                                        Tidak ada data donasi bencana
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="mt-3">
                    {{ $donasi->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>
@endsection
