{{-- Di header.blade.php --}}
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
      <img src="{{ asset('assets-admin/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
      <img src="{{ asset('assets-admin/images/logo-mini.svg') }}" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
      <!-- Quick Stats di Header -->
      <li class="nav-item dropdown d-none d-md-flex">
        <a class="nav-link" href="{{ route('warga.index') }}">
          <div class="text-center">
            <i class="mdi mdi-account-multiple mr-1"></i>
            <span class="font-weight-medium">Warga</span>
          </div>
        </a>
      </li>

      <li class="nav-item dropdown d-none d-md-flex">
        <a class="nav-link" href="{{ route('kejadian-bencana.index') }}">
          <div class="text-center">
            <i class="mdi mdi-alert-circle mr-1"></i>
            <span class="font-weight-medium">Bencana</span>
          </div>
        </a>
      </li>

      <!-- User Profile -->
      <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text d-none d-md-inline-flex">Naila Yohanda</span>
          {{-- <img class="img-xs rounded-circle" src="{{ asset('assets-admin/images/faces/face8.jpg') }}" alt="Profile image"> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-account mr-2"></i> My Profile
          </a>
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-settings mr-2"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-logout mr-2"></i> Sign Out
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>
