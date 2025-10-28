{{-- resources/views/layouts/admin/header.blade.php --}}
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
      <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}" alt="logo" width="35" class="me-2">
      <span class="fw-bold text-primary">Bina Desa</span>
    </a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
      <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}" alt="logo" width="30">
    </a>
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
      <!-- Quick Stats -->
      <li class="nav-item dropdown d-none d-md-flex">
        <a class="nav-link" href="{{ route('warga.index') }}">
          <div class="text-center px-3">
            <i class="mdi mdi-account-group-outline mr-1 text-primary"></i>
            <span class="font-weight-medium">Data Warga</span>
          </div>
        </a>
      </li>

      <li class="nav-item dropdown d-none d-md-flex">
        <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
          <div class="text-center px-3">
            <i class="mdi mdi-alert-circle-outline mr-1 text-warning"></i>
            <span class="font-weight-medium">Kejadian Bencana</span>
          </div>
        </a>
      </li>

      <!-- User Profile -->
      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-account-circle me-2 text-primary"></i>
          <span class="profile-text d-none d-md-inline-flex">Admin Desa</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-account-outline mr-2"></i> Profil Saya
          </a>
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-cog-outline mr-2"></i> Pengaturan
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="mdi mdi-logout mr-2"></i> Keluar
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
