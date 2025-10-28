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
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->nama }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $item->kejadian->jenis_bencana }}</span><br>
                            <small class="text-muted">{{ $item->kejadian->lokasi_text }}</small>
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
                                   class="btn btn-warning"
                                   title="Edit Posko">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('posko-bencana.destroy', $item->posko_id) }}" method="POST" class="d-inline">
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
                            Tidak ada data posko bencana
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posko->hasPages())
        <div class="mt-4">
            {{ $posko->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
