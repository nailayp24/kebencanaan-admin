{{-- resources/views/layouts/admin/sidebar.blade.php --}}
<aside class="sidebar" id="sidebar" style="display: flex; flex-direction: column; height: 100vh; overflow: hidden;">
    <!-- Logo -->
    <div class="sidebar-brand" style="flex-shrink: 0;">
        <img src="{{ asset('assets-admin/images/logo/horizontal.png') }}" alt="SIGANA">
    </div>

    <!-- User Profile -->
    <div class="sidebar-profile" style="flex-shrink: 0;">
        <div class="profile-image">
            @if (Auth::check() && Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                    style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #4B49AC;">
            @else
                <div class="avatar-placeholder"
                    style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; border: 3px solid #4B49AC;">
                    <span style="color: white; font-size: 28px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>
        <h4 class="profile-name">{{ Str::limit(Auth::user()->name ?? 'Super Admin', 15) }}</h4>
        <div class="profile-role">
            @auth
                @php
                    $roleColors = [
                        'super_admin' => 'linear-gradient(135deg, #ff5252 0%, #d32f2f 100%)',
                        'admin' => 'linear-gradient(135deg, #ff9800 0%, #f57c00 100%)',
                        'user' => 'linear-gradient(135deg, #2196f3 0%, #1976d2 100%)',
                    ];
                @endphp
                <span class="badge" style="background: {{ $roleColors[Auth::user()->role] ?? '#666' }}; color: white;">
                    {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                </span>
            @endauth
        </div>
        <small class="text-muted d-block mt-2">{{ Auth::user()->email ?? 'super@gmail.com' }}</small>



    <!-- Navigation Menu -->
    <nav class="sidebar-nav" style="flex: 1; overflow-y: auto; min-height: 0;">
        <div class="nav-category">UTAMA</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-view-dashboard"></i>
            <span class="menu-title">Dashboard</span>
        </a>

        <div class="nav-category">MASTER DATA</div>
        <a href="{{ route('warga.index') }}" class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-account-group"></i>
            <span class="menu-title">Data Warga</span>
        </a>

        {{-- MENU "MANAJEMEN USER" ADA UNTUK SEMUA USER --}}
        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
            <i
                class="menu-icon mdi mdi-account-cog
                      {{ Auth::user()->role == 'super_admin' ? 'text-danger' : 'text-warning' }}"></i>
            <span class="menu-title">
                Manajemen User
                @if (Auth::user()->role !== 'super_admin')
                    <small class="d-block text-warning" style="font-size: 10px;">
                        <i class="mdi mdi-alert-circle-outline"></i> Hanya Super Admin
                    </small>
                @endif
            </span>
            @if (Auth::user()->role == 'super_admin')
                <span class="badge bg-danger ms-auto" style="font-size: 9px; padding: 2px 5px;">Super</span>
            @else
                <span class="badge bg-warning text-dark ms-auto"
                    style="font-size: 9px; padding: 2px 5px;">Restricted</span>
            @endif
        </a>

        <div class="nav-category">MANAJEMEN BENCANA</div>
        <a href="{{ route('kejadian-bencana.index') }}"
            class="nav-link {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-alert-circle"></i>
            <span class="menu-title">Kejadian Bencana</span>
        </a>
        <a href="{{ route('posko-bencana.index') }}"
            class="nav-link {{ request()->is('posko-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-home-assistant"></i>
            <span class="menu-title">Posko Bencana</span>
        </a>
        <a href="{{ route('donasi-bencana.index') }}"
            class="nav-link {{ request()->is('donasi-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-hand-heart"></i>
            <span class="menu-title">Donasi Bencana</span>
        </a>

        <a href="{{ route('logistik-bencana.index') }}"
            class="nav-link {{ request()->is('logistik-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-package-variant"></i>
            <span class="menu-title">Logistik Bencana</span>
        </a>
        <a href="{{ route('distribusi-logistik.index') }}"
            class="nav-link {{ request()->is('distribusi-logistik*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-truck-delivery"></i>
            <span class="menu-title">Distribusi Logistik</span>
        </a>

        {{-- MENU "PROFIL PENGEMBANG" UNTUK SEMUA USER --}}
        <div class="nav-category">INFORMASI</div>
        <a href="{{ route('pengembang.index') }}"
            class="nav-link {{ request()->is('pengembang*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-code-tags text-info"></i>
            <span class="menu-title">
                Profil Pengembang
                @if (Auth::check() && Auth::user()->role === 'super_admin')
                    <small class="d-block text-info" style="font-size: 10px;">
                        <i class="mdi mdi-shield-star"></i> Info Developer
                    </small>
                @endif
            </span>
            <span class="badge bg-info ms-auto" style="font-size: 9px; padding: 2px 5px;">Info</span>
        </a>



        <a href="{{ route('logout') }}" class="nav-link text-danger"
            onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="menu-icon mdi mdi-logout"></i>
            <span class="menu-title">Logout</span>
        </a>
    </nav>
</aside>

<!-- Sidebar Logout Form -->
<form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<style>
/* Style untuk menu super admin */
.nav-link.active {
    background: linear-gradient(90deg, rgba(255, 82, 82, 0.2) 0%, transparent 100%);
    border-left: 3px solid #ff5252;
}

/* Style untuk menu info */
.nav-link:hover .mdi-code-tags {
    animation: code-shine 1s infinite alternate;
}

@keyframes code-shine {
    from { text-shadow: 0 0 5px rgba(13, 110, 253, 0.5); }
    to { text-shadow: 0 0 15px rgba(13, 110, 253, 0.8); }
}

.btn-outline-light:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>
