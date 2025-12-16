{{-- resources/views/layouts/admin/header.blade.php --}}
<nav class="top-navbar">
    <!-- Hamburger Button -->
    <button class="hamburger-btn" id="hamburgerBtn">
        <i class="mdi mdi-menu"></i>
    </button>

    <!-- Search Bar -->
    <div class="search-container d-none d-lg-block">
        <div class="search-box">
            <i class="mdi mdi-magnify"></i>
            <input type="text" placeholder="Cari bencana...">
        </div>
    </div>

    <!-- Right Side Menu - FLEX KE KANAN -->
    <div class="top-navbar-right">
        <!-- Notification Bell -->
        <div class="notification-icon">
            <a href="#" class="notification-btn position-relative">
                <i class="mdi mdi-bell-outline"></i>
                <span class="badge">3</span>
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="user-dropdown">
            <div class="user-toggle" id="userDropdown">
                <div class="user-avatar">
                    @if(Auth::check() && Auth::user()->profile_picture)
                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                             alt="{{ Auth::user()->name }}">
                    @else
                        <div class="avatar-placeholder">
                            <span>
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="user-info d-none d-md-block">
                    <div class="user-name">{{ Auth::user()->name ?? 'Super Admin' }}</div>
                    <div class="user-role">
                        <span class="badge" style="background: {{ Auth::user()->role == 'super_admin' ? '#d32f2f' : (Auth::user()->role == 'admin' ? '#f57c00' : '#1976d2') }};">
                            {{ ucfirst(str_replace('_', ' ', Auth::user()->role ?? 'super_admin')) }}
                        </span>
                    </div>
                </div>
                <i class="mdi mdi-chevron-down dropdown-arrow"></i>
            </div>

            <!-- Dropdown Menu - SEJAJAR DENGAN ICON -->
            <div class="dropdown-menu" id="dropdownMenu">
                <!-- Header -->
                <div class="dropdown-header">
                    <div class="dropdown-profile">
                        <div class="dropdown-avatar">
                            @if(Auth::check() && Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                                     alt="{{ Auth::user()->name }}">
                            @else
                                <div class="dropdown-avatar-placeholder">
                                    <span>
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="dropdown-info">
                            <div class="dropdown-name">{{ Auth::user()->name ?? 'Super Admin' }}</div>
                            <div class="dropdown-role">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</div>
                            <div class="dropdown-email">{{ Auth::user()->email ?? 'supAdmin@gmail.com' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="dropdown-body">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>

                    @if(Auth::check() && Auth::user()->role == 'super_admin')
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('user.index') }}" class="dropdown-item super-item">
                        <i class="mdi mdi-account-multiple"></i>
                        <span>Users</span>
                        <span class="super-badge">S</span>
                    </a>
                    @endif

                    <div class="dropdown-divider"></div>
                    <form id="header-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="dropdown-item logout-item" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* ===== HEADER LAYOUT ===== */
.top-navbar {
    display: flex;
    align-items: center;
    padding: 0 20px;
    background: #1e88e5;
    color: white;
    height: 60px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    width: 100%;
    box-sizing: border-box;
}

.hamburger-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 8px;
    margin-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-container {
    flex: 1;
    max-width: 400px;
}

.search-box {
    position: relative;
}

.search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
}

.search-box input {
    width: 100%;
    padding: 8px 15px 8px 35px;
    border: none;
    border-radius: 20px;
    background: rgba(255,255,255,0.9);
    font-size: 14px;
}

.top-navbar-right {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: auto;
}

/* ===== NOTIFICATION ===== */
.notification-icon {
    position: relative;
}

.notification-btn {
    color: white;
    font-size: 18px;
    display: block;
    padding: 5px;
}

.notification-btn .badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #f44336;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    font-size: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #1e88e5;
}

/* ===== USER DROPDOWN ===== */
.user-dropdown {
    position: relative;
}

.user-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 8px;
    border-radius: 20px;
    cursor: pointer;
    transition: background 0.2s;
    background: rgba(255,255,255,0.1);
}

.user-toggle:hover {
    background: rgba(255,255,255,0.2);
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.5);
    flex-shrink: 0;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-placeholder span {
    color: white;
    font-size: 16px;
    font-weight: bold;
}

.user-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-width: 0;
}

.user-name {
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 120px;
}

.user-role .badge {
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    font-weight: 500;
}

.dropdown-arrow {
    font-size: 16px;
    color: white;
    flex-shrink: 0;
}

/* ===== DROPDOWN MENU - SEJAJAR DENGAN ICON ===== */
.dropdown-menu {
    display: none;
    position: absolute;
    top: calc(100% + 5px);
    right: 0;
    width: 280px; /* Dikecilkan */
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    z-index: 1001;
    overflow: hidden;
    border: 1px solid #e0e0e0;
}

.dropdown-menu.show {
    display: block;
    animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Dropdown Header */
.dropdown-header {
    background: linear-gradient(135deg, #1e88e5 0%, #0d47a1 100%);
    padding: 16px; /* Dikecilkan */
    color: white;
}

.dropdown-profile {
    display: flex;
    align-items: center;
}

.dropdown-avatar {
    width: 50px; /* Dikecilkan */
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(255,255,255,0.4);
    margin-right: 12px;
    flex-shrink: 0;
}

.dropdown-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dropdown-avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.dropdown-avatar-placeholder span {
    color: white;
    font-size: 18px; /* Dikecilkan */
    font-weight: bold;
}

.dropdown-info {
    flex: 1;
    min-width: 0;
}

.dropdown-name {
    font-weight: 700;
    font-size: 14px; /* Dikecilkan */
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
}

.dropdown-role {
    color: rgba(255,255,255,0.95);
    font-size: 11px; /* Dikecilkan */
    background: rgba(255,255,255,0.25);
    padding: 2px 8px; /* Dikecilkan */
    border-radius: 10px;
    display: inline-block;
    margin-bottom: 4px;
    font-weight: 500;
}

.dropdown-email {
    font-size: 11px; /* Dikecilkan */
    color: rgba(255,255,255,0.8);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
}

/* Dropdown Body */
.dropdown-body {
    padding: 8px 0; /* Dikecilkan */
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 10px 16px; /* Dikecilkan */
    color: #333;
    text-decoration: none;
    font-size: 13px; /* Dikecilkan */
    font-weight: 500;
    transition: all 0.2s;
    border-left: 3px solid transparent; /* Dikecilkan */
}

.dropdown-item:hover {
    background: #f0f7ff;
    border-left-color: #1e88e5;
    padding-left: 20px; /* Dikecilkan */
}

.dropdown-item i {
    margin-right: 10px; /* Dikecilkan */
    font-size: 18px; /* Dikecilkan */
    width: 20px;
    text-align: center;
    flex-shrink: 0;
}

/* Icons Colors */
.dropdown-item .mdi-view-dashboard {
    color: #1e88e5;
}

.dropdown-item .mdi-account-multiple {
    color: #ff9800;
}

.dropdown-item .mdi-logout {
    color: #d32f2f;
}

/* Special Items */
.dropdown-divider {
    height: 1px;
    background: #eee;
    margin: 6px 0; /* Dikecilkan */
}

.super-item {
    background: #fff8e1 !important;
    position: relative;
}

.super-badge {
    background: #d32f2f;
    color: white;
    font-size: 9px; /* Dikecilkan */
    padding: 1px 5px; /* Dikecilkan */
    border-radius: 3px;
    margin-left: auto;
    font-weight: bold;
}

.logout-item {
    color: #d32f2f !important;
    font-weight: 600;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .top-navbar {
        padding: 0 15px;
        height: 56px;
    }

    .hamburger-btn {
        margin-right: 10px;
        font-size: 18px;
        padding: 6px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
    }

    .user-name {
        font-size: 12px;
        max-width: 100px;
    }

    .user-info {
        display: none;
    }

    .notification-btn {
        font-size: 16px;
    }

    .dropdown-menu {
        position: fixed;
        top: 56px !important;
        right: 10px !important;
        left: auto !important;
        width: 260px !important; /* Lebih kecil di mobile */
    }

    .dropdown-avatar {
        width: 42px;
        height: 42px;
        margin-right: 10px;
    }

    .dropdown-avatar-placeholder span {
        font-size: 16px;
    }

    .dropdown-name {
        font-size: 13px;
    }

    .dropdown-email {
        font-size: 10px;
    }

    .dropdown-item {
        padding: 8px 14px;
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .search-container {
        display: none !important;
    }

    .notification-btn .badge {
        width: 14px;
        height: 14px;
        font-size: 8px;
    }

    .dropdown-menu {
        width: 240px !important;
        right: 5px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.getElementById('userDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const hamburgerBtn = document.getElementById('hamburgerBtn');

    if (userDropdown && dropdownMenu) {
        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function() {
            // Toggle sidebar logic here
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
});
</script>
