<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
<script src="{{ url(mix('/js/app.js')) }}" type="text/javascript"></script>

@yield('scriptjs')