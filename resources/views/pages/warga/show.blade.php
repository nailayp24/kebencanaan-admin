@extends('layouts.admin.app')

@section('title', 'Detail Warga')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <!-- Header -->
            <div class="card-header bg-white border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">
                            <i class="mdi mdi-account-details text-primary me-2"></i>Detail Warga
                        </h5>
                        <p class="text-muted small mb-0">Informasi lengkap data warga</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-sm btn-warning">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-3">
                <!-- Profile Info -->
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <!-- Avatar -->
                        <div class="mb-3">
                            @php
                                $defaultAvatar = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiByeD0iNjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTYwIDc1Qzc0LjkyMzQgNzUgODcgNjIuOTIzNCA4NyA0OEM4NyAzMy4wNzY2IDc0LjkyMzQgMjEgNjAgMjFDNDUuMDc2NiAyMSAzMyAzMy4wNzY2IDMzIDQ4QzMzIDYyLjkyMzQgNDUuMDc2NiA3NSA2MCA3NVoiIGZpbGw9IiNENUQ2REIiLz4KPHBhdGggZD0iTTYwIDg1QzQxLjA3NTMgODUgMjUuNSA5OS41NTUgMjUuNSAxMTguNUg5NC41Qzk0LjUgOTkuNTU1IDc4LjkyNDcgODUgNjAgODVaIiBmaWxsPSIjRDVENkRCIi8+Cjwvc3ZnPgo=';
                            @endphp
                            <img src="{{ $defaultAvatar }}" alt="{{ $warga->nama }}"
                                 class="rounded-circle border"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <!-- Gender Badge -->
                        <div class="mb-3">
                            @if($warga->jenis_kelamin == 'L')
                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 small">
                                    <i class="mdi mdi-gender-male me-1"></i> Laki-laki
                                </span>
                            @else
                                <span class="badge bg-pink-subtle text-pink border border-pink-subtle px-2 py-1 small">
                                    <i class="mdi mdi-gender-female me-1"></i> Perempuan
                                </span>
                            @endif
                        </div>

                        <!-- ID Card -->
                        <div class="border rounded p-3 mb-3">
                            <div class="text-primary mb-1"><i class="mdi mdi-identifier fs-5"></i></div>
                            <div class="fw-bold fs-6">W-{{ str_pad($warga->warga_id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-muted small">ID Warga</div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h4 class="fw-bold text-dark mb-2">{{ $warga->nama }}</h4>
                            <div class="d-flex align-items-center mb-3">
                                <i class="mdi mdi-card-account-details text-secondary me-2"></i>
                                <span class="text-muted">{{ $warga->no_ktp }}</span>
                            </div>

                            <!-- Badges -->
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge bg-light text-dark border">
                                    <i class="mdi mdi-briefcase me-1"></i>{{ $warga->pekerjaan }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    <i class="mdi mdi-religion me-1"></i>{{ $warga->agama }}
                                </span>
                                @if($warga->telp)
                                    <span class="badge bg-light text-dark border">
                                        <i class="mdi mdi-phone me-1"></i>{{ $warga->telp }}
                                    </span>
                                @endif
                                @if($warga->email)
                                    <span class="badge bg-light text-dark border">
                                        <i class="mdi mdi-email me-1"></i>{{ $warga->email }}
                                    </span>
                                @endif
                            </div>

                            <!-- Info Cards -->
                            <div class="row g-3">
                                <!-- Personal Info -->
                                <div class="col-md-6">
                                    <div class="card border h-100">
                                        <div class="card-header bg-white py-2 px-3">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="mdi mdi-information-outline text-primary me-2"></i>Informasi Pribadi
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Nama Lengkap</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle-outline text-primary me-2"></i>
                                                    <span>{{ $warga->nama }}</span>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted d-block">No KTP</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-card-account-details text-primary me-2"></i>
                                                    <span>{{ $warga->no_ktp }}</span>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Jenis Kelamin</small>
                                                <div class="d-flex align-items-center">
                                                    @if($warga->jenis_kelamin == 'L')
                                                        <i class="mdi mdi-gender-male text-info me-2"></i>
                                                        <span>Laki-laki</span>
                                                    @else
                                                        <i class="mdi mdi-gender-female text-pink me-2"></i>
                                                        <span>Perempuan</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Agama</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-religion text-primary me-2"></i>
                                                    <span>{{ $warga->agama }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact & Job Info -->
                                <div class="col-md-6">
                                    <div class="card border h-100">
                                        <div class="card-header bg-white py-2 px-3">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="mdi mdi-contacts text-primary me-2"></i>Kontak & Pekerjaan
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Pekerjaan</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-briefcase text-primary me-2"></i>
                                                    <span>{{ $warga->pekerjaan }}</span>
                                                </div>
                                            </div>
                                            @if($warga->telp)
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Telepon</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-phone text-primary me-2"></i>
                                                    <span>{{ $warga->telp }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @if($warga->email)
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Email</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-email text-primary me-2"></i>
                                                    <span>{{ $warga->email }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            <div>
                                                <small class="text-muted d-block">ID Warga</small>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-identifier text-primary me-2"></i>
                                                    <code class="bg-light px-2 py-1 rounded small">W-{{ str_pad($warga->warga_id, 4, '0', STR_PAD_LEFT) }}</code>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-top pt-3">
                    <h6 class="fw-bold mb-3">
                        <i class="mdi mdi-cog-outline text-primary me-2"></i>Kelola Data
                    </h6>
                    <div class="d-flex gap-2">
                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus {{ $warga->nama }}?')">
                                <i class="mdi mdi-delete me-1"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-format-list-bulleted me-1"></i> Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-white border-top py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        <i class="mdi mdi-calendar-clock me-1"></i>Data: {{ now()->format('d/m/Y H:i') }}
                    </div>
                    <div>
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Daftar Warga
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
.bg-pink-subtle { background-color: rgba(255, 182, 193, 0.1); }
.text-pink { color: #e83e8c; }
.border-pink-subtle { border-color: #f8d7da; }
@media (max-width: 768px) {
    .card-body { padding: 1rem; }
    .rounded-circle { width: 80px; height: 80px; }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Copy ID to clipboard
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
