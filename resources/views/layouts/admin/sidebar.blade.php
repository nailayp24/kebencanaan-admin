{{-- resources/views/layouts/admin/sidebar.blade.php --}}
<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="text-wrapper">
            <p class="profile-name">
                <i class="mdi mdi-account-circle me-2"></i>Admin Bina Desa
            </p>
            <small class="designation text-muted">
                <i class="mdi mdi-shield-account me-1"></i>Administrator
            </small>
          </div>
        </div>
      </div>
    </li>

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="menu-icon mdi mdi-view-dashboard-outline"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Fitur Utama -->
    <li class="nav-item nav-category">
      <span class="nav-link">
        <i class="mdi mdi-apps me-1"></i>Fitur Utama
      </span>
    </li>

    <!-- Modul A - Kebencanaan -->
    <li class="nav-item {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
        <i class="menu-icon mdi mdi-alert-circle-outline"></i>
        <span class="menu-title">Kejadian</span>
      </a>
    </li>

    <!-- Modul B - Posko Bencana -->
    <li class="nav-item {{ request()->is('posko-bencana*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('posko-bencana.index') }}">
        <i class="menu-icon mdi mdi-home-assistant"></i>
        <span class="menu-title">Posko Bencana</span>
      </a>
    </li>

    <!-- Master Data -->
    <li class="nav-item nav-category">
      <span class="nav-link">
        <i class="mdi mdi-database me-1"></i>Master Data
      </span>
    </li>

    <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('user.index') }}">
        <i class="menu-icon mdi mdi-account-cog-outline"></i>
        <span class="menu-title">User</span>
      </a>
    </li>

    <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('warga.index') }}">
        <i class="menu-icon mdi mdi-account-group-outline"></i>
        <span class="menu-title">Warga</span>
      </a>
    </li>

  </ul>
</nav>
