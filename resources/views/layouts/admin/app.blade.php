{{-- resources/views/layouts/admin/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>BINA DESA - @yield('title', 'Dashboard')</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <!-- CSS -->
  @include('layouts.admin.css')

  <!-- Additional Styles -->
  @stack('plugin-styles')
  @stack('styles')
</head>
<body>
  <div class="container-scroller">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <!-- Main Wrapper -->
    <div class="main-panel" id="mainPanel">
      <!-- Header -->
      @include('layouts.admin.header')

      <!-- Main Content -->
      <div class="content-wrapper">
        @yield('content')
      </div>

      <!-- Footer -->
      @include('layouts.admin.footer')
    </div>
  </div>

  <!-- WhatsApp Float -->
  <a href="https://wa.me/6285376297229?text=Halo%20Admin%20Bina%20Desa"
     class="whatsapp-float"
     target="_blank"
     title="Hubungi WhatsApp Admin">
    <i class="mdi mdi-whatsapp"></i>
  </a>

  <!-- JavaScript -->
  @include('layouts.admin.js')

  <!-- Additional Scripts -->
  @stack('plugin-scripts')
  @stack('scripts')
</body>
</html>
