@extends('layouts.admin.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">
                            <i class="mdi mdi-account-details text-primary me-2"></i>Detail Pengguna
                        </h5>
                        <p class="text-muted small mb-0">Informasi lengkap pengguna sistem</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        @if(Auth::check() && Auth::user()->role == 'super_admin')
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                <i class="mdi mdi-pencil me-1"></i> Edit
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body p-3">
                <!-- Profile Header Compact -->
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <!-- Profile Picture Compact -->
                        <div class="position-relative d-inline-block mb-2">
                            @php
                                $defaultAvatar = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iNjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTYwIDc1Qzc0LjkyMzQgNzUgODcgNjIuOTIzNCA4NyA0OEM4NyAzMy4wNzY2IDc0LjkyMzQgMjEgNjAgMjFDNDUuMDc2NiAyMSAzMyAzMy4wNzY2IDMzIDQ4QzMzIDYyLjkyMzQgNDUuMDc2NiA3NSA2MCA3NVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTYwIDg1QzQxLjA3NTMgODUgMjUuNSA5OS41NTUgMjUuNSAxMTguNUg5NC41Qzk0LjUgOTkuNTU1IDc4LjkyNDcgODUgNjAgODVaIiBmaWxsPSIjRDVENkRCIi8+Cjwvc3ZnPgo=';
                                $avatar = $user->profile_picture ? Storage::url($user->profile_picture) : $defaultAvatar;
                            @endphp
                            <img src="{{ $avatar }}" alt="{{ $user->name }}"
                                 class="rounded-circle shadow-sm"
                                 style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #f8f9fa;"
                                 onerror="this.onerror=null; this.src='{{ $defaultAvatar }}'">

                            <!-- Role Badge Compact -->
                            <div class="mt-2">
                                @if($user->role == 'super_admin')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 small">
                                        <i class="mdi mdi-shield-crown me-1"></i> Super Admin
                                    </span>
                                @elseif($user->role == 'admin')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 small">
                                        <i class="mdi mdi-shield-account me-1"></i> Admin
                                    </span>
                                @else
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 small">
                                        <i class="mdi mdi-account me-1"></i> User
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Verification Status Compact -->
                        <div class="mt-2">
                            @if($user->email_verified_at)
                                <span class="badge bg-success-subtle text-success border border-success small">
                                    <i class="mdi mdi-check-circle me-1"></i> Terverifikasi
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning small">
                                    <i class="mdi mdi-clock-alert me-1"></i> Belum Verifikasi
                                </span>
                            @endif
                        </div>

                        <!-- Account Stats Compact -->
                        <div class="mt-3">
                            <div class="row g-2">
                                <div class="col-12 mb-2">
                                    <div class="border rounded p-2 text-center">
                                        <div class="text-primary"><i class="mdi mdi-calendar-clock fs-6"></i></div>
                                        <div class="fw-bold">{{ $user->created_at->diffInDays(now()) }}</div>
                                        <div class="text-muted small">Hari Aktif</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="border rounded p-2 text-center">
                                        <div class="text-info"><i class="mdi mdi-update fs-6"></i></div>
                                        <div class="fw-bold">{{ $user->updated_at->format('d/m') }}</div>
                                        <div class="text-muted small">Update</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <!-- User Info Main -->
                        <div class="mb-4">
                            <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                            <div class="d-flex align-items-center mb-3">
                                <i class="mdi mdi-email-outline text-secondary me-2"></i>
                                <span class="text-muted">{{ $user->email }}</span>
                            </div>
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                <span class="badge bg-light text-dark border small">
                                    <i class="mdi mdi-identifier me-1"></i> ID: {{ $user->id }}
                                </span>
                                <span class="badge bg-light text-dark border small">
                                    <i class="mdi mdi-calendar-plus me-1"></i>
                                    Bergabung: {{ $user->created_at->format('d/m/Y') }}
                                </span>
                                @if($user->last_login_at)
                                    <span class="badge bg-light text-dark border small">
                                        <i class="mdi mdi-clock-check me-1"></i>
                                        Login: {{ $user->last_login_at->format('d/m H:i') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Quick Info Grid -->
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="border rounded p-3">
                                        <h6 class="fw-bold mb-2">
                                            <i class="mdi mdi-information-outline text-primary me-2"></i>Informasi Akun
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Nama Lengkap</small>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-circle-outline text-primary me-2 fs-6"></i>
                                                <span>{{ $user->name }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Email</small>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-email-outline text-primary me-2 fs-6"></i>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Role</small>
                                            <div class="d-flex align-items-center">
                                                @if($user->role == 'super_admin')
                                                    <i class="mdi mdi-shield-crown text-danger me-2 fs-6"></i>
                                                    <span class="fw-medium">Super Administrator</span>
                                                @elseif($user->role == 'admin')
                                                    <i class="mdi mdi-shield-account text-warning me-2 fs-6"></i>
                                                    <span class="fw-medium">Administrator</span>
                                                @else
                                                    <i class="mdi mdi-account text-info me-2 fs-6"></i>
                                                    <span class="fw-medium">User Biasa</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Status</small>
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success-subtle text-success border border-success">
                                                    <i class="mdi mdi-check-circle me-1"></i> Aktif & Terverifikasi
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning border border-warning">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i> Belum Verifikasi
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3">
                                        <h6 class="fw-bold mb-2">
                                            <i class="mdi mdi-history text-primary me-2"></i>Riwayat Akun
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Tanggal Dibuat</small>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-plus text-primary me-2 fs-6"></i>
                                                <span>{{ $user->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Terakhir Diupdate</small>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-edit text-primary me-2 fs-6"></i>
                                                <span>{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted d-block">Login Terakhir</small>
                                            <div class="d-flex align-items-center">
                                                @if($user->last_login_at)
                                                    <i class="mdi mdi-clock-check text-success me-2 fs-6"></i>
                                                    <span>{{ $user->last_login_at->format('d/m/Y H:i') }}</span>
                                                @else
                                                    <i class="mdi mdi-clock-alert text-warning me-2 fs-6"></i>
                                                    <span class="text-warning">Belum pernah login</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">ID Pengguna</small>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-identifier text-primary me-2 fs-6"></i>
                                                <code class="bg-light px-2 py-1 rounded small">{{ $user->id }}</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons (Jika Super Admin) -->
                @if(Auth::check() && Auth::user()->role == 'super_admin')
                <div class="border-top pt-3 mt-3">
                    <h6 class="fw-bold mb-3">
                        <i class="mdi mdi-cog-outline text-primary me-2"></i>Kelola Pengguna
                    </h6>
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit Pengguna
                        </a>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus {{ $user->name }}?')">
                                    <i class="mdi mdi-delete me-1"></i> Hapus Pengguna
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline-secondary btn-sm" disabled>
                                <i class="mdi mdi-delete me-1"></i> Akun Sendiri
                            </button>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Card Footer Compact -->
            <div class="card-footer bg-white border-top py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        <i class="mdi mdi-calendar-clock me-1"></i>Data: {{ now()->format('d/m/Y H:i') }}
                    </div>
                    <div>
                        <a href="{{ route('user.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Daftar Pengguna
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card { border-radius: 0.375rem; }
.card-header { background-color: #f8f9fa; }
.badge { border-radius: 0.25rem; font-weight: 500; }
.btn { border-radius: 0.25rem; }
.small { font-size: 0.85rem; }
.fs-6 { font-size: 1rem !important; }
.bg-opacity-10 { opacity: 0.1; }
.border { border-color: #dee2e6 !important; }
.badge.bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
.badge.bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
.badge.bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
.badge.bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }
.rounded { border-radius: 0.375rem !important; }
@media (max-width: 768px) {
    .card-body { padding: 0.75rem !important; }
    .profile-picture { width: 80px !important; height: 80px !important; }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Copy user ID to clipboard
    $('code').on('click', function() {
        const text = $(this).text();
        navigator.clipboard.writeText(text).then(() => {
            const originalText = $(this).text();
            $(this).text('ID disalin!');
            setTimeout(() => $(this).text(originalText), 1500);
        });
    });
});
</script>
@endpush
