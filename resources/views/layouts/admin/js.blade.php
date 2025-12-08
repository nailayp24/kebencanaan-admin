{{-- resources/views/layouts/admin/js.blade.php --}}
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    console.log('BINA DESA Dashboard Loaded');

    // ===== TOGGLE SIDEBAR =====
    $('#hamburgerBtn').on('click', function() {
        if ($(window).width() >= 992) {
            $('#sidebar').toggleClass('minimized');
            $('#mainPanel').toggleClass('minimized');
        } else {
            $('#sidebar').toggleClass('show');
            $('#sidebarOverlay').toggle();
        }
    });

    // Close mobile sidebar
    $('#sidebarOverlay').on('click', function() {
        $('#sidebar').removeClass('show');
        $(this).hide();
    });

    // ===== LOGOUT CONFIRMATION =====
    $('a[href*="logout"]').on('click', function(e) {
        if (!confirm('Yakin ingin logout dari BINA DESA?')) {
            e.preventDefault();
        }
    });

    console.log('Header dropdown should work now');
});
</script>
