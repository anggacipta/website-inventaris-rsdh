<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/LOGO_RS.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{--  Select2  --}}
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />

    {{--  Date Range  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/toastr-js/build/toastr.min.css') }}">

    {{--  Sweet Alert 2  --}}
    <script src="{{ asset('assets/sweetalert2/package/dist/sweetalert2.all.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/package/dist/sweetalert2.min.css') }}">

    {{--  Jquery  --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('dashboard.admin.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        @yield('content')
    </div>
</div>
<!--  Body Wrapper End -->
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
<script src="{{ asset('assets/js/theme/theme.js') }}"></script>

<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.js') }}"></script>
{{--    <script src="{{ asset('assets/js/widget/widgets-chart.js') }}"></script>--}}
{{--  DateRange  --}}
<script type="text/javascript" src="{{ asset('assets/daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('#tahun_pengadaan').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        });
    });
    $(function() {
        $('#date2').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        });
    });
</script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}""></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
{{--<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>--}}
{{--<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>--}}
{{--<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>--}}
{{--<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>--}}
{{--<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>--}}
{{--<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>--}}
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
{{--  Select2  --}}
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
{{-- Toastr --}}
<script type="text/javascript" src="{{ asset('assets/toastr-js/build/toastr.min.js') }}"></script>
<script>
    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
    toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
    toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
@yield('scripts')
</body>

</html>
