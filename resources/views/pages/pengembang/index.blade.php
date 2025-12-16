@extends('layouts.admin.app')

@section('title', 'Identitas Pengembang')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Minimalis -->
    <div class="bg-white border-bottom py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h4 fw-bold text-dark mb-1">
                        <i class="mdi mdi-account-circle me-2"></i>Identitas Pengembang
                    </h1>
                    <p class="text-muted mb-0 small">
                        Pengembang Sistem SIGANA - Sistem Informasi Manajemen Bencana
                    </p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="mdi mdi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Card Profil Utama -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Kolom Kiri - Foto & Info Dasar -->
                            <div class="col-md-5 border-end">
                                <!-- Foto Profil -->
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block mb-3">
                                        <img src="{{ asset('assets-admin/images/pengembang/naila-yohanda-putri.jpeg') }}"
                                             alt="Naila Yohanda Putri"
                                             class="rounded-circle shadow"
                                             style="width: 160px; height: 160px; object-fit: cover;">
                                    </div>
                                    <h4 class="fw-bold text-dark mb-2">Naila Yohanda Putri</h4>
                                    <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                                        <span class="badge bg-primary-subtle text-primary">
                                            <i class="mdi mdi-school me-1"></i> Mahasiswa
                                        </span>
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="mdi mdi-code-braces me-1"></i> Developer
                                        </span>
                                    </div>
                                </div>

                                <!-- Informasi Akademik -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-dark mb-3">
                                        <i class="mdi mdi-account-card-details me-2"></i> Data Akademik
                                    </h6>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted small">NIM</span>
                                                <span class="fw-semibold">2457301107</span>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted small">Program Studi</span>
                                                <span class="fw-semibold">Sistem Informasi</span>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted small">Institusi</span>
                                                <span class="fw-semibold">Politeknik Caltex Riau</span>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted small">Semester</span>
                                                <span class="fw-semibold">3 (Tiga)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kontak -->
                                <div>
                                    <h6 class="fw-semibold text-dark mb-3">
                                        <i class="mdi mdi-contact-mail me-2"></i> Kontak
                                    </h6>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-email text-success"></i>
                                                </div>
                                                <div>
                                                    <div class="small text-muted">Email</div>
                                                    <div class="fw-semibold">naylayohandaputri@gmail.com</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-phone text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="small text-muted">Telepon</div>
                                                    <div class="fw-semibold">+62 812 3456 7890</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-danger-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-map-marker text-danger"></i>
                                                </div>
                                                <div>
                                                    <div class="small text-muted">Lokasi</div>
                                                    <div class="fw-semibold">Pekanbaru, Riau</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Media Sosial & Detail -->
                            <div class="col-md-7 ps-lg-4">
                                <!-- Media Sosial & Portfolio -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-dark mb-3">
                                        <i class="mdi mdi-link-variant me-2"></i> Media Sosial & Portfolio
                                    </h6>
                                    <div class="row g-2">
                                        <!-- LinkedIn -->
                                        <div class="col-12">
                                            <a href="https://www.linkedin.com/in/naila-yohanda-putri-1ba3b6252"
                                               target="_blank"
                                               class="text-decoration-none">
                                                <div class="card border hover-shadow-sm mb-2">
                                                    <div class="card-body py-2 px-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary-subtle rounded p-2 me-3">
                                                                <i class="mdi mdi-linkedin text-primary fs-5"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="fw-medium">LinkedIn</div>
                                                                <div class="text-muted small">linkedin.com/in/naila-yohanda-putri</div>
                                                            </div>
                                                            <i class="mdi mdi-open-in-new text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- GitHub -->
                                        <div class="col-12">
                                            <a href="https://github.com/nailayp24"
                                               target="_blank"
                                               class="text-decoration-none">
                                                <div class="card border hover-shadow-sm mb-2">
                                                    <div class="card-body py-2 px-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-dark-subtle rounded p-2 me-3">
                                                                <i class="mdi mdi-github text-dark fs-5"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="fw-medium">GitHub</div>
                                                                <div class="text-muted small">github.com/nailayp24</div>
                                                            </div>
                                                            <i class="mdi mdi-open-in-new text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Instagram -->
                                        <div class="col-12">
                                            <a href="https://www.instagram.com/nailayohanda"
                                               target="_blank"
                                               class="text-decoration-none">
                                                <div class="card border hover-shadow-sm mb-2">
                                                    <div class="card-body py-2 px-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-danger-subtle rounded p-2 me-3">
                                                                <i class="mdi mdi-instagram text-danger fs-5"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="fw-medium">Instagram</div>
                                                                <div class="text-muted small">instagram.com/nailayohanda</div>
                                                            </div>
                                                            <i class="mdi mdi-open-in-new text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Portofolio Website -->
                                        <div class="col-12">
                                            <div class="card border hover-shadow-sm">
                                                <div class="card-body py-2 px-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-info-subtle rounded p-2 me-3">
                                                            <i class="mdi mdi-web text-info fs-5"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="fw-medium">Portofolio</div>
                                                            <div class="text-muted small">https://nailayp.lovable.app</div>
                                                        </div>
                                                        <span class="badge bg-primary">SIGANA</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Keahlian Teknis -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-dark mb-3">
                                        <i class="mdi mdi-cogs me-2"></i> Keahlian Teknis
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-danger-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-laravel text-danger"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">Laravel Framework</div>
                                                    <div class="text-muted small">API Development</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-success-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-database text-success"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">MySQL Database</div>
                                                    <div class="text-muted small">Database Management</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-info-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-bootstrap text-info"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">Bootstrap 5</div>
                                                    <div class="text-muted small">Frontend Framework</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-warning-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-git text-warning"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">Git Version Control</div>
                                                    <div class="text-muted small">Version Management</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-purple-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-language-php text-purple"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">PHP Programming</div>
                                                    <div class="text-muted small">Backend Development</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center p-2 border rounded">
                                                <div class="bg-primary-subtle rounded p-2 me-3">
                                                    <i class="mdi mdi-api text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium">API Development</div>
                                                    <div class="text-muted small">System Integration</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tentang Pengembang -->
                                <div>
                                    <h6 class="fw-semibold text-dark mb-3">
                                        <i class="mdi mdi-information me-2"></i> Tentang Pengembang
                                    </h6>
                                    <div class="bg-light-subtle p-3 rounded">
                                        <p class="mb-0">
                                            Mahasiswa aktif Program Studi Sistem Informasi di Politeknik Caltex Riau semester 3,
                                            dengan fokus pada pengembangan sistem berbasis web. Saat ini sedang mengembangkan
                                            <strong>SIGANA (Sistem Informasi Manajemen Bencana)</strong> sebagai proyek tugas akhir
                                            untuk mendukung penanganan bencana secara digital dan efisien.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <i class="mdi mdi-calendar-edit me-1"></i>
                                Profil terakhir diperbarui: {{ date('d M Y') }}
                            </div>
                            <div class="d-flex gap-2">
                                <button onclick="window.print()" class="btn btn-sm btn-outline-secondary">
                                    <i class="mdi mdi-printer me-1"></i> Cetak
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-check me-1"></i> Selesai
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1) !important;
}
.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}
.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1) !important;
}
.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
}
.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}
.bg-dark-subtle {
    background-color: rgba(33, 37, 41, 0.1) !important;
}
.bg-purple-subtle {
    background-color: rgba(111, 66, 193, 0.1) !important;
}

.bg-light-subtle {
    background-color: #f8f9fa !important;
}

.hover-shadow-sm:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.card {
    border-radius: 10px;
    border-color: #e9ecef;
}

.list-group-item {
    background-color: transparent;
}

.rounded {
    border-radius: 8px !important;
}

.badge {
    border-radius: 6px;
    font-weight: 500;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}

/* Icon GitHub yang jelas */
.mdi-github.text-dark {
    color: #212529 !important;
}

/* Untuk border elemen */
.border {
    border-color: #e9ecef !important;
}
</style>
@endpush
