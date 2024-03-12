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
    <!-- Option 1: Include in HTML -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- @if (env('APP_ENV') == 'local') --}}
    <link rel="icon" href="{{ asset('/img/logo_co.ico') }}">
    <link href="{{ asset('/css/mobiscroll.javascript.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    {{-- @else
        <link rel="icon" href="./public/img/logo_co.ico" >
        <link rel="stylesheet" href="./public/css/mobiscroll.javascript.min.css">
        <link href="./public/css/custom.css" rel="stylesheet">
        
    @endif --}}

</head>

<body class="fondo_general" style="width: 100%">
    
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"> --}}
    </script>
    <script src="https://kit.fontawesome.com/252b802fc2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.INIT_MIN_MINUTE_CHATTER = `{{ env('INIT_MIN_MINUTE_CHATTER') }}`;
        window.INIT_MAX_MINUTE_CHATTER = `{{ env('INIT_MAX_MINUTE_CHATTER') }}`;
        window.SECOND_MIN_MINUTE_CHATTER = `{{ env('SECOND_MIN_MINUTE_CHATTER') }}`;
        window.SECOND_MAX_MINUTE_CHATTER = `{{ env('SECOND_MAX_MINUTE_CHATTER') }}`;
    </script>
    {{-- @if (env('APP_ENV') == 'local') --}}
        
        <script src="{{ asset('/js/mobiscroll.javascript.min.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        @stack('schedule')
        @stack('chatters')
        @stack('copyText')
    {{-- @else
       
        <script src="./public/js/mobiscroll.javascript.min.js"></script>
        <script src="./public/js/custom.js"></script>
        @stack('schedule')
        @stack('chatters')
        @stack('copyText')
    @endif --}}
   
</body>

</html>
