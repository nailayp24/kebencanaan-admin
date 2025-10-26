<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    {{-- Profile Section --}}
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link text-center">
        <div class="user-wrapper mb-3">
          <div class="profile-image mb-2">
            {{-- <img src="{{ asset('assets/images/faces/face8.jpg') }}" alt="profile image" class="rounded-circle" width="60"> --}}
          </div>
          <div class="text-wrapper">
            <p class="profile-name fw-bold mb-0">Naila Yohanda Putri</p>
            <small class="designation text-muted">Manager</small>
          </div>
        </div>
        <button class="btn btn-gradient-success btn-sm w-100">
          <i class="mdi mdi-plus"></i> Proyek Baru
        </button>
      </div>
    </li>

    {{-- DASHBOARD --}}
    <li class="nav-item {{ active_class(['dashboard']) }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="menu-icon mdi mdi-view-dashboard-outline"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- DATA POSKO --}}
    <li class="nav-item {{ active_class(['posko*']) }}">
      <a class="nav-link" href="{{ route('posko.index') }}">
        <i class="menu-icon mdi mdi-hospital-building"></i>
        <span class="menu-title">Posko Bencana</span>
      </a>
    </li>

    {{-- DATA KEJADIAN --}}
    <li class="nav-item {{ active_class(['kejadian*']) }}">
      <a class="nav-link" href="{{ route('kejadian.index') }}">
        <i class="menu-icon mdi mdi-clipboard-text-outline"></i>
        <span class="menu-title">Data Kejadian</span>
      </a>
    </li>

    {{-- LOGOUT  --}}
    <li class="nav-item mt-3">
      <a class="nav-link text-danger" href="{{ route('login.index') }}">
        <i class="menu-icon mdi mdi-logout"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>
