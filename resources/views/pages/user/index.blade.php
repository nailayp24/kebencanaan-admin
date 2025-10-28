{{-- resources/views/pages/user/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="mdi mdi-account-multiple me-2"></i>Data User
    </h2>
    <a href="{{ route('user.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus me-1"></i> Tambah User
    </a>
</div>

{{-- Flash Messages --}}
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

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-outline me-2"></i>
        {{ session('warning') }}
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataUser as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('user.edit', $item->id) }}"
                                       class="btn btn-warning"
                                       title="Edit User">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    @if($item->id !== auth()->id())
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus user {{ $item->name }}?')"
                                                    title="Hapus User">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger" disabled title="Tidak dapat menghapus akun sendiri">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="mdi mdi-account-off-outline me-2"></i>
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- HAPUS BAGIAN INI (Pagination) --}}
        {{-- @if($dataUser->hasPages())
        <div class="mt-4">
            {{ $dataUser->links() }}
        </div>
        @endif --}}

    </div>
</div>
@endsection
