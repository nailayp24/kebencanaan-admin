{{-- resources/views/layouts/admin/sidebar.blade.php --}}
<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-brand">
        <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}" alt="BINA DESA">
    </div>

    <!-- User Profile -->
    <div class="sidebar-profile">
        <div class="profile-image">
            @if(Auth::check() && Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                     alt="{{ Auth::user()->name }}"
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
                        'user' => 'linear-gradient(135deg, #2196f3 0%, #1976d2 100%)'
                    ];
                @endphp
                <span class="badge" style="background: {{ $roleColors[Auth::user()->role] ?? '#666' }}; color: white;">
                    {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                </span>
            @endauth
        </div>
        <small class="text-muted d-block mt-2">{{ Auth::user()->email ?? 'super@gmail.com' }}</small>

        <!-- Quick Profile Actions -->
        <div class="mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-light"
               style="border-color: rgba(255,255,255,0.3); color: white; font-size: 12px;">
                <i class="mdi mdi-account-edit me-1"></i> Edit Profil
            </a>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
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
        <a href="{{ route('user.index') }}"
           class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-account-cog
                      {{ Auth::user()->role == 'super_admin' ? 'text-danger' : 'text-warning' }}"></i>
            <span class="menu-title">
                Manajemen User
                @if(Auth::user()->role !== 'super_admin')
                <small class="d-block text-warning" style="font-size: 10px;">
                    <i class="mdi mdi-alert-circle-outline"></i> Hanya Super Admin
                </small>
                @endif
            </span>
            @if(Auth::user()->role == 'super_admin')
                <span class="badge bg-danger ms-auto" style="font-size: 9px; padding: 2px 5px;">Super</span>
            @else
                <span class="badge bg-warning text-dark ms-auto" style="font-size: 9px; padding: 2px 5px;">Restricted</span>
            @endif
        </a>

        <div class="nav-category">MANAJEMEN BENCANA</div>
        <a href="{{ route('kejadian-bencana.index') }}" class="nav-link {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-alert-circle"></i>
            <span class="menu-title">Kejadian Bencana</span>
        </a>
        <a href="{{ route('posko-bencana.index') }}" class="nav-link {{ request()->is('posko-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-home-assistant"></i>
            <span class="menu-title">Posko Bencana</span>
        </a>
        <a href="{{ route('donasi-bencana.index') }}" class="nav-link {{ request()->is('donasi-bencana*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-hand-heart"></i>
            <span class="menu-title">Donasi Bencana</span>
        </a>

        <div class="nav-category">PENGATURAN</div>
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="menu-icon mdi mdi-account-edit" style="color: #4B49AC;"></i>
            <span class="menu-title">Profil Saya</span>
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
