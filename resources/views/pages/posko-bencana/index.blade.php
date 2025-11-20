{{-- resources/views/admin/posko-bencana/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="mdi mdi-home-group me-2"></i>Data Posko Bencana
        </h2>
        <a href="{{ route('posko-bencana.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus me-1"></i> Tambah Posko
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
               {{-- FILTER & SEARCH FORM --}}
            <form method="GET" action="{{ route('posko-bencana.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    {{-- Filter Kejadian Bencana --}}
                    <div class="col-md-4">
                        <label class="form-label">Filter Kejadian Bencana</label>
                        <select name="kejadian_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kejadian</option>
                            @foreach($kejadianOptions as $kejadian)
                                <option value="{{ $kejadian->kejadian_id }}"
                                    {{ request('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                    {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Spacer untuk memberikan jarak --}}
                    <div class="col-md-1"></div>

                    {{-- Search --}}
                    <div class="col-md-5">
                        <label class="form-label">Pencarian</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama posko, alamat, kontak, atau penanggung jawab...">
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
                    <div class="col-md-2">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary w-100">
                            <i class="mdi mdi-refresh"></i> Reset
                        </a>
                    </div>

                    {{-- Info Filter Aktif --}}
                    @if(request('kejadian_id') || request('search'))
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
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Posko</th>
                            <th>Kejadian Bencana</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Penanggung Jawab</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posko as $item)
                            <tr>
                               <td>{{ ($posko->currentPage() - 1) * $posko->perPage() + $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->nama }}</strong>
                                </td>
                                <td>
                                    @if ($item->kejadianBencana)
                                        <span class="badge bg-info">{{ $item->kejadianBencana->jenis_bencana }}</span><br>
                                        <small class="text-muted">{{ $item->kejadianBencana->lokasi_text }}</small>
                                    @else
                                        <span class="badge bg-warning">Data Kejadian Tidak Ditemukan</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($item->alamat, 50) }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="mdi mdi-phone me-1"></i>{{ $item->kontak }}
                                    </span>
                                </td>
                                <td>{{ $item->penanggung_jawab }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('posko-bencana.edit', $item->posko_id) }}"
                                            class="btn btn-warning" title="Edit Posko">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('posko-bencana.destroy', $item->posko_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus posko {{ $item->nama }}?')"
                                                title="Hapus Posko">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                 <td colspan="7" class="text-center text-muted py-4">
                                    <i class="mdi mdi-home-remove-outline me-2"></i>
                                    @if(request('kejadian_id') || request('search'))
                                        Tidak ada data posko bencana yang sesuai dengan filter
                                    @else
                                        Tidak ada data posko bencana
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $posko->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>
@endsection
