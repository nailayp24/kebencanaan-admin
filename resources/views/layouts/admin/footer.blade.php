{{-- resources/views/layouts/admin/footer.blade.php --}}
<footer class="footer bg-light border-top py-2 mt-auto">
    <div class="container">
        <div class="row align-items-center g-2">
            <div class="col-md-6 text-center text-md-start">
                <div class="d-flex align-items-center">
                    <div class="me-2 text-primary">
                        <i class="mdi mdi-alert-circle-outline fs-4"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <span class="text-muted">&copy; {{ date('Y') }}</span>
                            <span class="ms-1 fw-bold text-primary">SIGANA</span>
                            <span class="ms-1 text-muted d-none d-md-inline">- Sistem Informasi Manajemen Bencana</span>
                        </div>
                        <small class="text-muted d-md-none mt-1">Sistem Informasi Manajemen Bencana</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex justify-content-center justify-content-md-end align-items-center">
                    <span class="badge bg-primary me-2">v1.0.0</span>
                    <span class="text-muted me-2">|</span>
                    <small class="text-muted">
                        <i class="mdi mdi-refresh me-1"></i>
                        {{ date('d/m/Y') }}
                    </small>
                </div>
                <small class="text-muted mt-1 mt-md-0">
                    <i class="mdi mdi-database me-1"></i>
                    Kejadian • Posko • Donasi • Logistik • Distribusi
                </small>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    font-size: 0.85rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #f0f7ff 100%);
    box-shadow: 0 -1px 8px rgba(0,0,0,0.05);
    border-top: 1px solid #dee2e6 !important;
}

.footer .container {
    max-width: 1200px;
}

.text-primary {
    color: #0d6efd !important;
}

.badge {
    font-size: 0.7rem;
    padding: 0.25em 0.6em;
    font-weight: 500;
}

@media (max-width: 768px) {
    .footer .row {
        text-align: center !important;
    }
    .footer .d-flex {
        justify-content: center !important;
    }
}
</style>
