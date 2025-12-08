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
            <input type="text" placeholder="Cari di BINA DESA...">
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

            <!-- Dropdown Menu - VERSION SUPER KECIL -->
            <div class="dropdown-menu" id="dropdownMenu">
                <!-- Header Minimal -->
                <div class="dropdown-minimal-header">
                    <div class="minimal-profile">
                        <div class="minimal-avatar">
                            @if(Auth::check() && Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                                     alt="{{ Auth::user()->name }}">
                            @else
                                <div class="minimal-avatar-placeholder">
                                    <span>
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="minimal-info">
                            <div class="minimal-name">{{ Auth::user()->name ?? 'Super Admin' }}</div>
                            <div class="minimal-role">{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Menu Items Minimal -->
                <div class="dropdown-minimal-body">
                    <a href="{{ route('dashboard') }}" class="dropdown-minimal-item">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="dropdown-minimal-item">
                        <i class="mdi mdi-account-edit"></i>
                        <span>Profile</span>
                    </a>

                    <a href="{{ route('profile.photo.edit') }}" class="dropdown-minimal-item">
                        <i class="mdi mdi-camera"></i>
                        <span>Foto</span>
                    </a>

                    @if(Auth::check() && Auth::user()->role == 'super_admin')
                    <div class="dropdown-minimal-divider"></div>
                    <a href="{{ route('user.index') }}" class="dropdown-minimal-item super-minimal">
                        <i class="mdi mdi-account-multiple"></i>
                        <span>Users</span>
                        <span class="super-minimal-badge">S</span>
                    </a>
                    @endif

                    <div class="dropdown-minimal-divider"></div>
                    <form id="header-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="dropdown-minimal-item logout-minimal" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">
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
    justify-content: space-between;
    padding: 0 25px;
    background: #1e88e5;
    color: white;
    height: 70px;
    position: sticky;
    top: 0;
    z-index: 999;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.search-container {
    flex: 1;
    max-width: 500px;
    margin: 0 30px;
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
}

.notification-btn .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #f44336;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    font-size: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #1e88e5;
}

/* ===== USER DROPDOWN ===== */
.user-dropdown {
    position: relative;
    z-index: 1001;
}

.user-toggle {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 3px 6px;
    border-radius: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.user-toggle:hover {
    background: rgba(255,255,255,0.1);
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    border: 1px solid white;
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
    font-size: 12px;
    font-weight: bold;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-size: 11px;
    font-weight: 500;
    line-height: 1.2;
}

.user-role .badge {
    font-size: 9px;
    padding: 1px 3px;
    border-radius: 2px;
    line-height: 1;
}

.dropdown-arrow {
    font-size: 14px;
    color: white;
}

/* ===== DROPDOWN MENU SUPER KECIL ===== */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    width: 220px; /* SANGAT KECIL */
    background: white;
    border-radius: 4px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    z-index: 99999;
    margin-top: 6px;
    border: 1px solid #ddd;
    overflow: hidden;
}

.dropdown-menu.show {
    display: block !important;
    animation: fadeIn 0.15s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-3px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Dropdown Header Minimal */
.dropdown-minimal-header {
    background: #1e88e5;
    padding: 12px;
    color: white;
}

.minimal-profile {
    display: flex;
    align-items: center;
}

.minimal-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.4);
    margin-right: 10px;
    flex-shrink: 0;
}

.minimal-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.minimal-avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.minimal-avatar-placeholder span {
    color: white;
    font-size: 14px;
    font-weight: bold;
}

.minimal-info {
    flex: 1;
    min-width: 0;
}

.minimal-name {
    font-weight: 600;
    font-size: 12px;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.minimal-role {
    color: rgba(255,255,255,0.9);
    font-size: 10px;
    background: rgba(255,255,255,0.15);
    padding: 2px 6px;
    border-radius: 3px;
    display: inline-block;
}

/* Dropdown Body Minimal */
.dropdown-minimal-body {
    padding: 6px 0;
}

.dropdown-minimal-item {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    color: #333;
    text-decoration: none;
    font-size: 12px;
    border-left: 2px solid transparent;
    transition: all 0.15s;
    min-height: 30px;
}

.dropdown-minimal-item:hover {
    background: #f0f7ff;
    border-left-color: #1e88e5;
    padding-left: 14px;
}

.dropdown-minimal-item i {
    margin-right: 8px;
    font-size: 16px;
    width: 18px;
    text-align: center;
    flex-shrink: 0;
}

/* Icons Colors Minimal */
.dropdown-minimal-item .mdi-view-dashboard {
    color: #1e88e5;
}

.dropdown-minimal-item .mdi-account-edit {
    color: #4B49AC;
}

.dropdown-minimal-item .mdi-camera {
    color: #2196f3;
}

.dropdown-minimal-item .mdi-account-multiple {
    color: #ff9800;
}

.dropdown-minimal-item .mdi-logout {
    color: #d32f2f;
}

/* Special Items Minimal */
.dropdown-minimal-divider {
    height: 1px;
    background: #eee;
    margin: 5px 0;
}

.super-minimal {
    background: #fff8e1 !important;
    font-size: 11px !important;
}

.super-minimal-badge {
    background: #d32f2f;
    color: white;
    font-size: 7px;
    padding: 1px 3px;
    border-radius: 2px;
    margin-left: auto;
    font-weight: bold;
    line-height: 1;
}

.logout-minimal {
    color: #d32f2f !important;
    font-weight: 600;
    font-size: 11px !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 767px) {
    .user-info {
        display: none;
    }

    .search-container {
        display: none;
    }

    .dropdown-menu {
        position: fixed;
        top: 60px !important;
        right: 8px !important;
        left: 8px !important;
        width: auto !important;
        max-width: calc(100vw - 16px) !important;
    }

    .user-toggle {
        padding: 2px 4px;
    }

    .user-avatar {
        width: 28px;
        height: 28px;
    }

    .avatar-placeholder span {
        font-size: 10px;
    }

    .notification-btn {
        font-size: 16px;
    }

    .notification-btn .badge {
        width: 12px;
        height: 12px;
        font-size: 7px;
    }
}

/* Untuk layar sangat kecil */
@media (max-width: 480px) {
    .dropdown-menu {
        width: 200px !important;
    }

    .minimal-avatar {
        width: 32px;
        height: 32px;
        margin-right: 8px;
    }

    .minimal-name {
        font-size: 11px;
    }

    .minimal-role {
        font-size: 9px;
    }

    .dropdown-minimal-item {
        padding: 5px 10px;
        font-size: 11px;
    }

    .dropdown-minimal-item i {
        font-size: 14px;
        margin-right: 6px;
    }
}

/* Untuk layar extra kecil (phone portrait) */
@media (max-width: 360px) {
    .top-navbar {
        padding: 0 15px;
    }

    .dropdown-menu {
        width: 180px !important;
    }

    .minimal-avatar {
        width: 30px;
        height: 30px;
    }

    .minimal-name {
        font-size: 10px;
    }

    .dropdown-minimal-item {
        padding: 4px 8px;
        font-size: 10px;
    }
}
</style>

<script>
// SIMPLE DROPDOWN SCRIPT
document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.getElementById('userDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (!userDropdown || !dropdownMenu) {
        console.error('Dropdown elements not found!');
        return;
    }

    // Toggle dropdown saat klik avatar
    userDropdown.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropdownMenu.classList.toggle('show');

        // Positioning untuk desktop
        const rect = userDropdown.getBoundingClientRect();
        if (window.innerWidth > 767) {
            dropdownMenu.style.top = (rect.bottom + window.scrollY) + 'px';
            dropdownMenu.style.right = (window.innerWidth - rect.right) + 'px';
        }
    });

    // Close dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    // Prevent dropdown close saat klik di dalam dropdown
    dropdownMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
