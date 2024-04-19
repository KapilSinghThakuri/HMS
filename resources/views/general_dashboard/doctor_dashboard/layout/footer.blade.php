<div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('admin_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('admin_assets/js/Chart.bundle.js')}}"></script>
    <script src="{{ asset('admin_assets/js/chart.js')}}"></script>
    <script src="{{ asset('admin_assets/js/app.js')}}"></script>
     <!-- Include Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Nepali Date Picker -->
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>