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

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle-outline me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
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
                        <td>{{ $loop->iteration + ($kejadian->currentPage() - 1) * $kejadian->perPage() }}</td>
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
                                    'selesai' => 'success'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$item->status_kejadian] ?? 'secondary' }}">
                                {{ ucfirst($item->status_kejadian) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('kejadian-bencana.edit', $item->kejadian_id) }}"
                                   class="btn btn-warning"
                                   title="Edit Kejadian">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('kejadian-bencana.destroy', $item->kejadian_id) }}" method="POST" class="d-inline">
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
                            Tidak ada data kejadian bencana
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kejadian->hasPages())
        <div class="mt-4">
            {{ $kejadian->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
