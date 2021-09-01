<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>{{!empty($title_page) ? $title_page:''}} ITATS LANGUAGE CENTER</title>


    {{-- LOGO --}}
    <link rel="icon" href="{{asset('images/logo2.png')}}" type="image/png">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('mazer/assets/images/favicon.svg')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
        type="text/css">

    <link rel="stylesheet" href="{{asset('css/customprofileadmin.css')}}">


    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('argon/assets/css/argon.css?v=1.2.0')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/css/custom.css')}}" type="text/css">

    {{-- Mazer CSS --}}
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/css/pages/app.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/sweetalert2/sweetalert2.min.css')}}">

    {{-- DATATABLES --}}
    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
        
</head>

<body>
    @include('admin/layouts/navbar')

    @include('admin/layouts/features')

    @include('admin/layouts/header')

    @yield('content')

    @include('admin/layouts/footer')

    <!-- Core -->
    <script src="{{asset('argon/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}">
    </script>

    <!-- Optional JS -->
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('argon/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>

    <!-- Argon JS -->
    <script src="{{asset('argon/assets/js/argon.js?v=1.2.0')}}"></script>

    <!-- Mazer JS -->
    <script src="{{asset('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('mazer/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('mazer/assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('mazer/assets/js/main.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('mazer/assets/js/extensions/sweetalert2.js')}}"></script>
    <script src="{{asset('mazer/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('datatables/dataTables.bootstrap4.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    <script>
        $(document).ready(function () {
        $(document).click(function (event) {
            var click = $(event.target);

           $(".g-sidenav-pinned").removeClass("g-sidenav-pinned") 
        });
    });
    </script>

    @stack('js')
</body>

</html>