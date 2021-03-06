<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>{{!empty($title_page) ? $title_page:''}} ITATS LANGUAGE CENTER</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo2.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
        type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('argon/assets/css/argon.css?v=1.2.0')}}" type="text/css">

     <!-- Mazer CSS -->
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{asset('argon/assets/css/custom.css')}}" type="text/css">
    {{-- Datatables --}}
    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="{{asset('mazer/assets/js/extensions/sweetalert2.js')}}"></script>
    <script src="{{asset('mazer/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
</head>

<body>
    @include('public/layouts/navbar')

    @include('public/layouts/features')

    @include('public/layouts/header')

    @yield('content')

    @include('public/layouts/footer')
    <!-- Argon Scripts -->
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
    <!-- Custom Script -->
    <script src="{{asset('js/register/register.js')}}"></script>
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