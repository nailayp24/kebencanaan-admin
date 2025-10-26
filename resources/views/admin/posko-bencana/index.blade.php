{{-- tez --}}
@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Posko Bencana</h2>
    <a href="{{ route('posko-bencana.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus"></i> Tambah Posko
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
                        <th>Nama Posko</th>
                        <th>Kejadian Bencana</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Penanggung Jawab</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posko as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kejadian->jenis_bencana }} - {{ $item->kejadian->lokasi_text }}</td>
                        <td>{{ Str::limit($item->alamat, 50) }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>{{ $item->penanggung_jawab }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('posko-bencana.edit', $item->posko_id) }}" class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('posko-bencana.destroy', $item->posko_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus posko {{ $item->nama }}?')">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data posko bencana</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posko->hasPages())
        <div class="mt-3">
            {{ $posko->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
