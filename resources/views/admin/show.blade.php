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
        <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    @else
        <link href="./public/css/custom.css" rel="stylesheet">
    @endif

</head>

<body class="bg-primary" style="width: 100%">
    @include('admin.nav')
    <div class="container bg-primary">
        <div class="row">
            <div class="col-12 justify-content-lg-center ">

                <div class="container mt-5 ">
                    <div class="row">
                        <a href="{{ route('admin-list') }}"><button type="button"
                                class="btn btn-dark">Volver</button></a>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-2">
                                            <h5>Nombre</h5>
                                        </div>
                                        <div class="col-2">
                                            <h5>Email</h5>
                                        </div>
                                        <div class="col-2">
                                            <h5>Rol</h5>
                                        </div>
                                        <div class="col-2">
                                            <h5>Canal</h5>
                                        </div>
                                        <div class="col-2">
                                            <h5>Zona horaria</h5>
                                        </div>
                                        <div class="col-2">
                                           
                                        </div>
                                        <div class="col-2">
                                            <h6>{{ $user->name }}</h6>
                                        </div>
                                        <div class="col-2">
                                            <h6>{{ $user->email }}</h6>
                                        </div>
                                        <div class="col-2">
                                            <h6>{{ $user->role->name }}</h6>
                                        </div>
                                        <div class="col-2">
                                            <h6>{{ $user->channel }}</h6>
                                        </div>
                                        <div class="col-2">
                                            <h6>{{ $user->time_zone }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-center">Agenda Semanal</h4>

                                @foreach ($date_array as $key => $days)
                                    <div class="col-lg-2 col-md-4  col-sm-12 my-4">
                                        <input class="form-control form-control-lg bg-warning text-center"
                                            type="text" placeholder="{{ trans('user.create.' . $key) }}" disabled>

                                        @foreach ($days['times'] as $time)
                                            <input class="form-control form-control-lg bg-light text-center"
                                                type="text" placeholder="{{ $time }}" disabled>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <h4 class="text-center">Puntaje</h4>
                            <h6>Punteje Semanal</h6>
                            @if (isset($user->score->points_week))
                                {{ $user->score->points_week }}
                            @else
                                0
                            @endif

                            <h6>Punteje Dia</h6>
                            @if (isset($user->score->points_day))
                                {{ $user->score->points_day }}
                            @else
                                0
                            @endif

                            <h6>Neo coins</h6>

                            @if (isset($user->score->neo_coins))
                                {{ $user->score->neo_coins }}
                            @else
                                0
                            @endif

                            <h6>Users Watching
                                {{ (isset($user->score->count_users) ? '(' . $user->score->count_users . ')' : '0') .
                                    (isset($date) ? ' Fecha: ' . $date : '') }}
                            </h6>

                            @if (isset($user->score->users_data))
                                <h5>
                                    @foreach (json_decode($user->score->users_data) as $watch_user)
                                        {{ $watch_user->user_name . ' - ' }}
                                    @endforeach
                                </h5>

                            @endif
                        </div>
                        <div class="col-lg-12">
                            @if($user->role_id == 3)
                            <h4 class="text-center">Streamers Apoyados</h4>
                                @if (count($streamers_supported )> 0)
                                    @foreach ($streamers_supported as $streamer)
                                        {{$streamer['name'] . ' - ' . $streamer['time']}}
                                    @endforeach
                                @else
                                <h5 class="text-center">--</h5>
                                @endif
                                @endif
                        </div>



                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/252b802fc2.js" crossorigin="anonymous"></script>
</body>

</html>
