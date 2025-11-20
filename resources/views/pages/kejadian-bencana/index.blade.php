{{-- resources/views/admin/kejadian-bencana/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="mdi mdi-alert-circle-outline me-2"></i>Data Kejadian Bencana
        </h2>
        <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus me-1"></i> Tambah Kejadian
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
            <form method="GET" action="{{ route('kejadian-bencana.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    {{-- Filter Jenis Bencana --}}
                    <div class="col-md-3">
                        <label class="form-label">Jenis Bencana</label>
                        <select name="jenis_bencana" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisBencanaOptions as $jenis)
                                <option value="{{ $jenis }}"
                                    {{ request('jenis_bencana') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-3">
                        <label class="form-label">Status Kejadian</label>
                        <select name="status_kejadian" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $status)
                                @php
                                    $statusColors = [
                                        'dilaporkan' => 'warning',
                                        'diverifikasi' => 'info',
                                        'ditangani' => 'primary',
                                        'selesai' => 'success',
                                    ];
                                @endphp
                                <option value="{{ $status }}"
                                    {{ request('status_kejadian') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
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
                                   placeholder="Cari jenis bencana, lokasi, atau dampak...">
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
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary w-100">
                            <i class="mdi mdi-refresh"></i> Reset
                        </a>
                    </div>

                    {{-- Info Filter Aktif --}}
                    @if(request('jenis_bencana') || request('status_kejadian') || request('search'))
                        <div class="col-12">
                            <div class="alert alert-info py-2">
                                <small>
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Filter aktif:
                                    @if(request('jenis_bencana'))
                                        <span class="badge bg-primary me-2">
                                            Jenis: {{ request('jenis_bencana') }}
                                        </span>
                                    @endif
                                    @if(request('status_kejadian'))
                                        <span class="badge bg-primary me-2">
                                            Status: {{ ucfirst(request('status_kejadian')) }}
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
                            <th>Jenis Bencana</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>RT/RW</th>
                            <th>Dampak</th>
                            <th>Status</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kejadian as $item)
                            <tr>
                               <td>{{ ($kejadian->currentPage() - 1) * $kejadian->perPage() + $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->jenis_bencana }}</strong>
                                </td>
                                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($item->lokasi_text, 30) }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->rt }}/{{ $item->rw }}</span>
                                </td>
                                <td>{{ Str::limit($item->dampak, 50) }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'dilaporkan' => 'warning',
                                            'diverifikasi' => 'info',
                                            'ditangani' => 'primary',
                                            'selesai' => 'success',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$item->status_kejadian] ?? 'secondary' }}">
                                        {{ ucfirst($item->status_kejadian) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('kejadian-bencana.edit', $item->kejadian_id) }}"
                                            class="btn btn-warning" title="Edit Kejadian">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('kejadian-bencana.destroy', $item->kejadian_id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus kejadian bencana {{ $item->jenis_bencana }}?')"
                                                title="Hapus Kejadian">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                 <td colspan="8" class="text-center text-muted py-4">
                                    <i class="mdi mdi-alert-off-outline me-2"></i>
                                    @if(request('jenis_bencana') || request('status_kejadian') || request('search'))
                                        Tidak ada data kejadian bencana yang sesuai dengan filter
                                    @else
                                        Tidak ada data kejadian bencana
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="mt-3">
                    {{ $kejadian->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </div>
@endsection
