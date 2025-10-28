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

  {{-- WhatsApp Floating Button Styles --}}
  <style>
    /* Floating WhatsApp Button */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
        animation: pulse 2s infinite;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .whatsapp-float:hover {
        background-color: #128C7E;
        transform: scale(1.1);
        color: #FFF;
        text-decoration: none;
        box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
    }

    .whatsapp-float i {
        margin: 0;
    }

    /* Pulse Animation */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* WhatsApp Tooltip */
    .whatsapp-tooltip {
        position: absolute;
        right: 70px;
        bottom: 50%;
        transform: translateY(50%);
        background: #333;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .whatsapp-tooltip::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 100%;
        transform: translateY(-50%);
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent transparent #333;
    }

    .whatsapp-float:hover .whatsapp-tooltip {
        opacity: 1;
        visibility: visible;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 20px;
            right: 20px;
            font-size: 24px;
        }

        .whatsapp-tooltip {
            display: none;
        }
    }

    /* For very small screens */
    @media (max-width: 480px) {
        .whatsapp-float {
            width: 45px;
            height: 45px;
            bottom: 15px;
            right: 15px;
            font-size: 22px;
        }
    }
  </style>

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

  {{-- Floating WhatsApp Button --}}
  <a href="https://wa.me/6285376297229?text=Halo%20Admin%20Bina%20Desa,%20saya%20membutuhkan%20bantuan%20mengenai:"
     class="whatsapp-float"
     target="_blank"
     title="Hubungi WhatsApp Admin">
    <i class="mdi mdi-whatsapp"></i>
    <span class="whatsapp-tooltip">Hubungi WhatsApp Admin</span>
  </a>

  {{-- START JS --}}
  @include('layouts.admin.js')
  {{-- END JS --}}

  {{-- WhatsApp Button JavaScript --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const whatsappButton = document.querySelector('.whatsapp-float');

        // Optional: Add click tracking
        whatsappButton.addEventListener('click', function() {
            // Anda bisa menambahkan analytics tracking di sini
            console.log('WhatsApp button clicked');

            // Contoh: Google Analytics event tracking
            // gtag('event', 'whatsapp_click', {
            //     'event_category': 'Contact',
            //     'event_label': 'Admin WhatsApp'
            // });
        });

        // Optional: Show/hide based on scroll
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scrolling down - hide button
                whatsappButton.style.transform = 'translateY(100px)';
            } else {
                // Scrolling up - show button
                whatsappButton.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        }, false);
    });
  </script>

  @stack('plugin-scripts')
  @stack('custom-scripts')
</body>
</html>
