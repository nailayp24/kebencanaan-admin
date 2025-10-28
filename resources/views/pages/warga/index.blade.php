{{-- resources/views/admin/warga/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Warga</h2>
    <a href="{{ route('warga.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus"></i> Tambah Warga
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
                        <td>{{ $loop->iteration }}</td>
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
                                <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
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
                        <td colspan="8" class="text-center text-muted">Tidak ada data warga</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($warga->hasPages())
        <div class="mt-3">
            {{ $warga->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
