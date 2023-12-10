<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Comunidadsn') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @if (env('APP_ENV') == 'local')
       
        <link href="{{ asset('/css/mobiscroll.javascript.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">

    @else
        <link rel="stylesheet" href="./public/css/mobiscroll.javascript.min.css">
        <link href="./public/css/custom.css" rel="stylesheet">
        
    @endif

</head>

<body class="" style="width: 100%">

    @if (session()->has('user'))
        @include('layouts.nav', ['user' => session('user')])
    @else
        @include('layouts.nav')
    @endif

    <main class="py-4">
        @yield('content')
    </main>
    {{-- @include('main') --}}


{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/252b802fc2.js" crossorigin="anonymous"></script>
    
    @if (env('APP_ENV') == 'local')
        
        <script src="{{ asset('/js/mobiscroll.javascript.min.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        @stack('schedule')
        @stack('chatters')
    @else
       
        <script src="./public/js/mobiscroll.javascript.min.js"></script>
        <script src="./public/js/custom.js"></script>
        @stack('schedule')
        @stack('chatters')
    @endif
   
</body>

</html>
