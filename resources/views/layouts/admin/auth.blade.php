<!DOCTYPE html>
<html>
<head>
  <title>Login - Bina Desa</title>
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
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      padding: 20px;
    }
    .auth-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      padding: 2.5rem;
      width: 100%;
      max-width: 420px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .auth-logo {
      text-align: center;
      margin-bottom: 2rem;
    }
    .auth-logo h2 {
      color: #1e3c72;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }
    .auth-logo p {
      color: #666;
      font-size: 0.9rem;
    }
    .form-label {
      font-weight: 500;
      color: #333;
      margin-bottom: 0.5rem;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.25);
    }
    .btn-primary {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
    }
    .auth-footer {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid #eee;
    }
    .auth-footer a {
      color: #1e3c72;
      text-decoration: none;
      font-weight: 500;
    }
    .auth-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      {{-- START MAIN CONTENT --}}
      @yield('content')
      {{-- END MAIN CONTENT --}}
    </div>
  </div>

  {{-- START JS --}}
  @include('layouts.admin.js')
  {{-- END JS --}}
</body>
</html>
