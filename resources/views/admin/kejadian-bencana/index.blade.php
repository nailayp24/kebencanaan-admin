{{-- resources/views/admin/kejadian-bencana/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Kejadian Bencana</h2>
    <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus"></i> Tambah Kejadian Bencana
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Bencana</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>RT/RW</th>
                        <th>Dampak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- PERBAIKAN: Gunakan $kejadian, bukan $posko --}}
                    @forelse($kejadian as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($kejadian->currentPage() - 1) * $kejadian->perPage() }}</td>
                        <td>{{ $item->jenis_bencana }}</td>
                        <td>{{ $item->tanggal_formatted ?? $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->lokasi_text }}</td>
                        <td>{{ $item->rt }}/{{ $item->rw }}</td>
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
                            <div class="btn-group">
                                <a href="{{ route('kejadian-bencana.edit', $item->kejadian_id) }}" class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('kejadian-bencana.destroy', $item->kejadian_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus kejadian bencana {{ $item->jenis_bencana }}?')">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada data kejadian bencana</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kejadian->hasPages())
        <div class="mt-3">
            {{ $kejadian->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
