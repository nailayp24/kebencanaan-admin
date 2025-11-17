<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'Sistem Tanggap Darurat Bencana')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  {{-- START CSS --}}
  @include('layouts.admin.css')
  {{-- END CSS --}}

  <style>
    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                  url("{{ asset('assets-admin/images/bencana-bg.png') }}");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 20px;
    }

    .auth-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
    }

    .auth-left {
      background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
      color: white;
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .auth-right {
      padding: 3rem;
      background: white;
    }

    .emergency-badge {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      padding: 8px 20px;
      border-radius: 25px;
      font-size: 0.8rem;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .feature-list {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
    }

    .feature-list li {
      padding: 8px 0;
      color: rgba(255, 255, 255, 0.9);
      font-size: 0.9rem;
    }

    .feature-list i {
      margin-right: 10px;
      font-size: 1.1rem;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .input-group-text {
      background: #dc3545;
      border: none;
      color: white;
      border-radius: 8px 0 0 8px;
    }

    .btn-primary {
      background: #dc3545;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #c82333;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .auth-footer {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid #eee;
    }

    .auth-footer a {
      color: #dc3545;
      text-decoration: none;
      font-weight: 600;
    }

    .auth-footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .auth-left {
        display: none;
      }

      .auth-right {
        padding: 2rem;
      }
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <div class="row g-0">
        {{-- Left Side: Description --}}
        <div class="col-md-6 auth-left">
          <div class="text-center mb-4">
            <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}"
                 alt="Logo Bina Desa"
                 width="80"
                 class="rounded-circle shadow">
          </div>

          <div class="text-center mb-3">
            <span class="emergency-badge">
              <i class="mdi mdi-alert-circle-outline me-1"></i>
              SISTEM TANGGAP DARURAT
            </span>
          </div>

          <h3 class="text-center mb-4">
            <strong>Manajemen Bencana</strong>
          </h3>

          <p class="text-center mb-4">
            Platform terintegrasi untuk penanganan bencana yang cepat dan terkoordinasi
          </p>

          <div class="feature-list">
            <li>
              <i class="mdi mdi-alert-box"></i>
              <strong>Monitoring Kejadian Bencana</strong>
            </li>
            <li>
              <i class="mdi mdi-home-group"></i>
              <strong>Manajemen Posko Darurat</strong>
            </li>
            <li>
              <i class="mdi mdi-account-multiple"></i>
              <strong>Data Pengungsi & Korban</strong>
            </li>
            <li>
              <i class="mdi mdi-hand-heart"></i>
              <strong>Pengelolaan Donasi</strong>
            </li>
            <li>
              <i class="mdi mdi-truck-delivery"></i>
              <strong>Distribusi Logistik</strong>
            </li>
          </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="col-md-6 auth-right">
          {{-- START MAIN CONTENT --}}
          @yield('content')
          {{-- END MAIN CONTENT --}}
        </div>
      </div>
    </div>
  </div>

  {{-- START JS --}}
  @include('layouts.admin.js')
  {{-- END JS --}}
</body>
</html>
