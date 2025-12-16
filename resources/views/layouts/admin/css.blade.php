{{-- resources/views/layouts/admin/css.blade.php --}}
<!-- plugin css -->
<link href="{{ asset('assets-admin/vendor/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets-admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
<!-- end plugin css -->

<!-- common css -->
<link href="{{ asset('assets-admin/css/app.css') }}" rel="stylesheet">
<!-- end common css -->

<style>
/* ===== EMERGENCY FIXES ===== */
/* Reset semua inline style yang bermasalah */
#dropdownMenu * {
    visibility: visible !important;
    opacity: 1 !important;
    display: block !important;
}

#dropdownMenu .dropdown-header *,
#dropdownMenu .dropdown-body * {
    color: inherit !important;
    background: transparent !important;
}

/* ===== RESET & GLOBAL STYLES ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fb;
    overflow-x: hidden;
}

/* ===== LAYOUT CONTAINER ===== */
.container-scroller {
    display: flex;
    min-height: 100vh;
    position: relative;
}

/* ===== SIDEBAR ===== */
.sidebar {
    display: flex;
    flex-direction: column;
    height: 100vh;
    width: 260px;
    background: white;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.05);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
    overflow: hidden; /* Ubah dari auto ke hidden */
}

/* Logo di Sidebar - SAMAKAN TINGGI DENGAN HEADER */
.sidebar-brand {
    padding: 0 20px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    background: #1e88e5;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}


.sidebar-brand img {
    max-height: 150px;
    width: auto;

}

/* Style untuk scrollbar sidebar */
.sidebar-nav::-webkit-scrollbar {
    width: 6px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.1);
    border-radius: 3px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.2);
}

/* User Profile di Sidebar */
.sidebar-profile {
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.profile-image {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin: 0 auto 10px;
    overflow: hidden;
    border: 3px solid #1e88e5;
}

.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.profile-role {
    font-size: 12px;
    color: #666;
}

.profile-role .badge {
    background: linear-gradient(135deg, #ff5252 0%, #d32f2f 100%);
    padding: 3px 10px;
    border-radius: 12px;
    color: white;
    font-size: 11px;
}

/* Navigation Menu */
.sidebar-nav {
    padding: 20px 0;
}

.nav-item {
    margin-bottom: 5px;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #555;
    text-decoration: none;
    transition: all 0.3s;
    border-left: 3px solid transparent;
}

.nav-link:hover,
.nav-link.active {
    background: rgba(30, 136, 229, 0.08);
    color: #1e88e5;
    border-left-color: #1e88e5;
}

.nav-link .menu-icon {
    font-size: 20px;
    margin-right: 15px;
    width: 24px;
    text-align: center;
}

.nav-link .menu-title {
    font-size: 14px;
    font-weight: 500;
}

.sidebar.minimized .menu-title {
    display: none;
}

.sidebar.minimized .nav-link {
    padding: 12px 15px;
    justify-content: center;
}

.sidebar.minimized .menu-icon {
    margin-right: 0;
    font-size: 22px;
}

/* Category Title */
.nav-category {
    padding: 15px 20px 5px;
    font-size: 11px;
    text-transform: uppercase;
    color: #888;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.sidebar.minimized .nav-category {
    display: none;
}

/* ===== MAIN CONTENT AREA ===== */
.main-panel {
    flex: 1;
    margin-left: 260px;
    transition: all 0.3s ease;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: calc(100% - 260px);
}

.main-panel.minimized {
    margin-left: 70px;
    width: calc(100% - 70px);
}

/* ===== TOP NAVBAR ===== */
.top-navbar {
    background: #1e88e5;
    color: white;
    padding: 0 25px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 999;
    width: 100%;
}

/* Hamburger Button */
.hamburger-btn {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 4px;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.hamburger-btn:hover {
    background: rgba(255, 255, 255, 0.1);
}

.hamburger-btn i {
    font-size: 24px;
}

/* Search Bar */
.search-container {
    flex: 1;
    max-width: 500px;
    margin: 0 30px;
}

.search-box {
    position: relative;
}

.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.7);
}

.search-box input {
    width: 100%;
    padding: 10px 15px 10px 45px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 4px;
    color: white;
    font-size: 14px;
    transition: all 0.3s;
}

.search-box input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.search-box input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

/* Right Side Menu */
.top-navbar-right {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
}

/* ===== USER DROPDOWN - SIMPLE VERSION ===== */
.user-dropdown {
    position: relative;
    cursor: pointer;
    z-index: 1001;
}

.user-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.3s;
    background: transparent;
}

.user-toggle:hover {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 8px;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-size: 14px;
    font-weight: 500;
    color: white;
}

.user-role {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.8);
}

.dropdown-arrow {
    font-size: 18px;
    color: white;
}

/* ===== FIX OVERFLOW & VISIBILITY ===== */
.top-navbar-right,
.user-dropdown {
    overflow: visible !important;
}

/* Pastikan tidak ada parent yang menutupi */
.container-scroller,
.main-panel,
.top-navbar {
    overflow: visible !important;
}

/* ===== FIX NOTIFICATION BELL ===== */
.notification-icon .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #f44336;
    color: white;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #1e88e5;
}

/* ===== RESPONSIVE ADJUSTMENTS ===== */
@media (max-width: 767px) {
    .user-info {
        display: none;
    }

    .user-toggle {
        padding: 6px 8px;
    }

    .notification-icon {
        margin-right: 10px;
    }
}

/* ===== DASHBOARD STYLES ===== */
.content-wrapper {
    flex: 1;
    padding: 30px;
    background: #f5f7fb;
    min-height: calc(100vh - 130px);
}

/* Welcome Card */
.card.bg-gradient-primary {
    background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
    border: none;
    border-radius: 15px;
    color: white;
    overflow: hidden;
}

/* Statistics Cards */
.card-statistics {
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: none;
    transition: transform 0.3s;
}

.card-statistics:hover {
    transform: translateY(-5px);
}

.card-statistics .text-muted {
    color: #666;
    font-size: 14px;
}

.card-statistics .font-weight-bold {
    font-size: 28px;
    font-weight: 700;
    color: #333;
}

.card-statistics .icon-lg {
    font-size: 45px;
    opacity: 0.8;
}

/* Quick Actions */
.btn-primary {
    background: #1e88e5;
    border-color: #1e88e5;
}

.btn-warning {
    background: #ff9800;
    border-color: #ff9800;
    color: white;
}

.btn-success {
    background: #4caf50;
    border-color: #4caf50;
}

.btn-info {
    background: #2196f3;
    border-color: #2196f3;
}

.btn-danger {
    background: #f44336;
    border-color: #f44336;
}

.btn-outline-danger {
    color: #f44336;
    border-color: #f44336;
}

.btn-outline-danger:hover {
    background: #f44336;
    color: white;
}

/* Table Styles */
.table {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    background: #f8f9fa;
    border-bottom: 2px solid #e0e0e0;
    font-weight: 600;
    color: #333;
}

.table-hover tbody tr:hover {
    background-color: rgba(30, 136, 229, 0.05);
}

/* Badge Styles */
.badge {
    font-weight: 500;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #ff5252 0%, #d32f2f 100%);
    color: white;
}

.badge.bg-primary { background: #1e88e5; }
.badge.bg-secondary { background: #757575; }
.badge.bg-success { background: #4caf50; }
.badge.bg-warning { background: #ff9800; }
.badge.bg-info { background: #2196f3; }
.badge.bg-light { background: #f5f5f5; color: #333; }

/* Alert Styles */
.alert-danger {
    background: rgba(244, 67, 54, 0.1);
    border-color: rgba(244, 67, 54, 0.3);
    color: #d32f2f;
}

.alert-warning {
    background: rgba(255, 152, 0, 0.1);
    border-color: rgba(255, 152, 0, 0.3);
    color: #f57c00;
}

.alert-info {
    background: rgba(33, 150, 243, 0.1);
    border-color: rgba(33, 150, 243, 0.3);
    color: #1565c0;
}

/* Card Border Colors */
.card.border-secondary { border-color: #757575; }
.card.border-info { border-color: #2196f3; }
.card.border-warning { border-color: #ff9800; }
.card.border-success { border-color: #4caf50; }

/* Grid Margins */
.grid-margin {
    margin-bottom: 30px;
}

.stretch-card {
    display: flex;
    align-items: stretch;
    justify-content: stretch;
}

.stretch-card > .card {
    width: 100%;
    min-height: 100%;
}

/* ===== FOOTER ===== */
.footer {
    background: white;
    border-top: 1px solid #eee;
    padding: 20px 30px;
    text-align: center;
    color: #666;
    font-size: 14px;
}

/* ===== WHATSAPP BUTTON ===== */
.whatsapp-float {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #25d366;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    z-index: 1000;
    transition: all 0.3s;
    text-decoration: none;
}

.whatsapp-float:hover {
    background: #128C7E;
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
}

.whatsapp-float i {
    font-size: 32px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .sidebar {
        transform: translateX(-100%);
        z-index: 1002;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .main-panel {
        margin-left: 0 !important;
        width: 100% !important;
    }

    .main-panel.minimized {
        margin-left: 0 !important;
        width: 100% !important;
    }

    .search-container {
        display: none;
    }

    .content-wrapper {
        padding: 20px;
    }

    .user-info {
        display: none;
    }

    .grid-margin {
        margin-bottom: 20px;
    }

    /* Mobile overlay */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        display: none;
    }
}

@media (max-width: 768px) {
    .top-navbar {
        padding: 0 15px;
    }

    .hamburger-btn {
        padding: 6px 10px;
    }

    .content-wrapper {
        padding: 15px;
    }

    .card-statistics .font-weight-bold {
        font-size: 24px;
    }

    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-float i {
        font-size: 26px;
    }
}

/* Utility Classes */
.text-white { color: white; }
.text-muted { color: #666; }
.text-primary { color: #1e88e5; }
.text-danger { color: #f44336; }
.text-warning { color: #ff9800; }
.text-success { color: #4caf50; }
.text-info { color: #2196f3; }

.mb-0 { margin-bottom: 0; }
.mt-0 { margin-top: 0; }
.mb-1 { margin-bottom: 0.25rem; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 1rem; }
.mb-4 { margin-bottom: 1.5rem; }
.mt-1 { margin-top: 0.25rem; }
.mt-2 { margin-top: 0.5rem; }
.mt-3 { margin-top: 1rem; }
.mt-4 { margin-top: 1.5rem; }
.ms-1 { margin-left: 0.25rem; }
.ms-2 { margin-left: 0.5rem; }
.ms-3 { margin-left: 1rem; }
.ms-auto { margin-left: auto; }
.me-1 { margin-right: 0.25rem; }
.me-2 { margin-right: 0.5rem; }
.me-3 { margin-right: 1rem; }

.d-block { display: block; }
.d-none { display: none; }
.d-flex { display: flex; }
.d-inline-flex { display: inline-flex; }

.justify-content-between { justify-content: space-between; }
.align-items-center { align-items: center; }
.flex-grow-1 { flex-grow: 1; }

.text-center { text-align: center; }
.text-end { text-align: right; }

.font-weight-bold { font-weight: 700; }
.font-weight-medium { font-weight: 500; }

.rounded { border-radius: 4px; }
.rounded-circle { border-radius: 50%; }

.w-100 { width: 100%; }
.h-100 { height: 100%; }

.border-top { border-top: 1px solid #dee2e6; }
.border-bottom { border-bottom: 1px solid #dee2e6; }

.py-3 { padding-top: 1rem; padding-bottom: 1rem; }
.p-2 { padding: 0.5rem; }
.p-3 { padding: 1rem; }

/* Icon sizes */
.icon-lg { font-size: 45px; }

/* Table responsive */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}


</style>
