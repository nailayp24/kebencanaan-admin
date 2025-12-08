{{-- resources/views/pages/user/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="mdi mdi-account-multiple me-2"></i>Data User
    </h2>
    @if(Auth::check() && Auth::user()->role == 'super_admin')
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
        {{-- FILTER & SEARCH FORM --}}
        <form method="GET" action="{{ route('user.index') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                {{-- Search --}}
                <div class="col-md-6">
                    <label class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Cari nama atau email...">
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

                {{-- Filter Status --}}
                <div class="col-md-3">
                    <label class="form-label">Status Verifikasi</label>
                    <select name="email_verified_at" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="verified" {{ request('email_verified_at') == 'verified' ? 'selected' : '' }}>
                            Terverifikasi
                        </option>
                        <option value="not_verified" {{ request('email_verified_at') == 'not_verified' ? 'selected' : '' }}>
                            Belum Verifikasi
                        </option>
                    </select>
                </div>

                {{-- Filter Role --}}
                <div class="col-md-3">
                    <label class="form-label">Filter Role</label>
                    <select name="role" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Role</option>
                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>
                            Super Admin
                        </option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>
                            User
                        </option>
                    </select>
                </div>

                {{-- Reset Filter --}}
                <div class="col-md-3">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary w-100">
                        <i class="mdi mdi-refresh"></i> Reset Filter
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Foto & Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status Verifikasi</th>
                        <th>Tanggal Dibuat</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataUser as $item)
                        <tr>
                            <td>{{ ($dataUser->currentPage() - 1) * $dataUser->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Foto Profil -->
                                    <div class="avatar me-3">
                                        @if($item->profile_picture)
                                            <img src="{{ Storage::url($item->profile_picture) }}"
                                                 alt="{{ $item->name }}"
                                                 class="rounded-circle"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                <span class="text-white">{{ strtoupper(substr($item->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Nama -->
                                    <div>
                                        <strong>{{ $item->name }}</strong>
                                        <div class="small text-muted">ID: {{ $item->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if($item->role == 'super_admin')
                                    <span class="badge bg-danger">Super Admin</span>
                                @elseif($item->role == 'admin')
                                    <span class="badge bg-warning">Admin</span>
                                @else
                                    <span class="badge bg-info">User</span>
                                @endif
                            </td>
                            <td>
                                @if($item->email_verified_at)
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning">Belum Verifikasi</span>
                                @endif
                            </td>
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
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="mdi mdi-account-off-outline me-2"></i>
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $dataUser->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@else
{{-- TAMPILKAN PESAN ERROR UNTUK NON-SUPER ADMIN --}}
<div class="alert alert-danger">
    <div class="text-center py-5">
        <i class="mdi mdi-shield-alert" style="font-size: 72px; color: #dc3545;"></i>
        <h3 class="mt-4">Access Denied!</h3>
        <p class="text-muted">Hanya <strong>Super Admin</strong> yang dapat mengakses halaman User Management.</p>
        <p>Role Anda:
            <span class="badge bg-{{ Auth::user()->role == 'admin' ? 'warning' : 'info' }}">
                {{ ucfirst(Auth::user()->role) }}
            </span>
        </p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
            <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endif
@endsection
