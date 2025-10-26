<!DOCTYPE html>
<html>
<head>
  <title>Star Admin Pro Laravel Dashboard Template</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  {{-- START CSS --}}
  @include('layouts.admin.css')
  {{-- END CSS --}}

  @stack('plugin-styles')
  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    {{-- START HEADER --}}
    @include('layouts.admin.header')
    {{-- END HEADER --}}

    <div class="container-fluid page-body-wrapper">
      {{-- START SIDEBAR --}}
      @include('layouts.admin.sidebar')
      {{-- END SIDEBAR --}}

      <div class="main-panel">
        <div class="content-wrapper">
          {{-- START MAIN CONTENT --}}
          @yield('content')
          {{-- END MAIN CONTENT --}}
        </div>

        {{-- START FOOTER --}}
        @include('layouts.admin.footer')
        {{-- END FOOTER --}}
      </div>
    </div>
  </div>

  {{-- START JS --}}
  @include('layouts.admin.js')
  {{-- END JS --}}

  @stack('plugin-scripts')
  @stack('custom-scripts')
</body>
</html>
