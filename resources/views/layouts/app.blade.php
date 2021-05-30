<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   {{-- LOCAL CSS --}}
   
   <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
   <link rel="stylesheet" href="{{asset('css/custom.css')}}">
   <link rel="stylesheet" href="{{asset('css/customfonts.css')}}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 {{-- lOGO --}}
   <link rel="icon" href="{{asset('images/logo2.png')}}">

   {{-- AOS --}}
   <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
   @stack('css')


    <title>{{!empty($title_page) ? $title_page:''}} ITATS Language Center</title>

 

</head>

<body>
    @include('layouts/header')
    @yield('content')





    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>