<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          {{-- <div class="profile-image">
            <img src="{{ asset('assets-admin/images/faces/face8.jpg') }}" alt="profile image">
          </div> --}}
          <div class="text-wrapper">
            <p class="profile-name">Admin Bina Desa</p>
            <small class="designation text-muted">Administrator</small>
          </div>
        </div>
      </div>
    </li>

    <!-- Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="menu-icon mdi mdi-view-dashboard"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Data Master -->
    <li class="nav-item nav-category">
      <span class="nav-link">Data Master</span>
    </li>

    <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('warga.index') }}">
        <i class="menu-icon mdi mdi-account-multiple"></i>
        <span class="menu-title">Data Warga</span>
      </a>
    </li>

    <!-- Kebencanaan -->
    <li class="nav-item nav-category">
      <span class="nav-link">Kebencanaan</span>
    </li>

    <li class="nav-item {{ request()->is('kejadian-bencana*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
        <i class="menu-icon mdi mdi-alert-circle"></i>
        <span class="menu-title">Kejadian Bencana</span>
      </a>
    </li>

    <li class="nav-item {{ request()->is('posko-bencana*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('posko-bencana.index') }}">
        <i class="menu-icon mdi mdi-home-assistant"></i>
        <span class="menu-title">Posko Bencana</span>
      </a>
    </li>

    <!-- Manajemen User -->
    <li class="nav-item nav-category">
      <span class="nav-link">Manajemen User</span>
    </li>

    <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('user.index') }}">
        <i class="menu-icon mdi mdi-account-multiple"></i>
        <span class="menu-title">Data User</span>
      </a>
    </li>

  </ul>
</nav>
