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
                                <td>{{ $loop->iteration + ($donasi->currentPage() - 1) * $donasi->perPage() }}</td>
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
                                    Tidak ada data donasi bencana
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($donasi->hasPages())
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        {{ $donasi->firstItem() }}-{{ $donasi->lastItem() }} of {{ $donasi->total() }}
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        {{-- Previous --}}
                        @if ($donasi->onFirstPage())
                            <button class="btn btn-light btn-sm" disabled>
                                <i class="mdi mdi-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $donasi->previousPageUrl() }}" class="btn btn-light btn-sm">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Select --}}
                        <select class="form-select form-select-sm" style="width: 70px;"
                            onchange="window.location.href = this.value">
                            @for ($page = 1; $page <= $donasi->lastPage(); $page++)
                                <option value="{{ $donasi->url($page) }}"
                                    {{ $page == $donasi->currentPage() ? 'selected' : '' }}>
                                    {{ $page }}
                                </option>
                            @endfor
                        </select>

                        {{-- Next --}}
                        @if ($donasi->hasMorePages())
                            <a href="{{ $donasi->nextPageUrl() }}" class="btn btn-light btn-sm">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        @else
                            <button class="btn btn-light btn-sm" disabled>
                                <i class="mdi mdi-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
