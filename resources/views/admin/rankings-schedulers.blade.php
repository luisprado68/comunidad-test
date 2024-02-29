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
        <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
                        @if ( $user_model->role_id == 3 || $user_model->role_id == 1)
                                        <div class="col-2 mb-4 mr-4">
                                            <button type="submit" class="btn btn-success"><a class="dropdown-item"
                                                href="{{ route('admin-schedulers') }}">Ver Agendas</a></button>
                                        </div>
                                        <div class="col-2 mb-4 mr-4">
                                            <a href="{{ route('admin-list') }}"><button type="button"
                                                class="btn btn-dark">Volver</button></a>
                                        </div>
                                        @if ($route->uri == 'admin/deleted-users')
                                            <div class="col-2 mb-4">
                                                <button type="submit" class="btn btn-secondary"><a class="dropdown-item"
                                                    href="{{ route('admin-list') }}"><i class="bi bi-people-fill"> Usuarios</i></a></button>
                                            </div>
                                            
                                        @endif
                                        
                                        <div class="col-2 mb-4">
                                            <button type="submit" class="btn btn-warning"><a class="dropdown-item"
                                                href="{{ route('admin-users-deleted') }}"><i class="bi bi-archive-fill"> Papelera</i></a></button>
                                        </div>
                                        @if ($user_model->role_id == 3 )
                                            <div class="col-2 mb-4">
                                                <button type="submit" class="btn btn-danger"><a class="dropdown-item"
                                                    href="{{ route('admin-schedulers-delete') }}">Eliminar Calendarios</a></button>
                                            </div>
                                        @endif
                                      
                                            
                        @endif
                        
                        @if ($route->uri == 'admin/deleted-users')
                            <h3 class="text-center">Usuarios Eliminados</h3>
                            @else
                            <h3 class="text-center">Usuarios</h3>
                        @endif
                       
                        <table class="table table-responsive table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    {{--<th scope="col">Rol</th>
                                    <th scope="col">Rango</th> --}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Canal</th>
                                    <th scope="col">Top</th>
                                    {{-- <th scope="col">Puntajes de Semanal</th>
                                    <th scope="col">Neo Coins</th> --}}
                                    <th scope="col">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dump($users) --}}
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        
                                        {{-- <td class="fuente_tabla">{{ $user->range->name }}</td> --}}
                                        <td class="fuente_tabla">{{ $user->name }}</td>
                                        <td class="fuente_tabla">{{ $user->channel }}</td>
                                        <td class="fuente_tabla">{{ $user->top }}</td>
                                        {{-- <td class="fuente_tabla">{{ $user->points_week }}</td>
                                        <td class="fuente_tabla">{{ $user->neo_coins }}</td> --}}
                                        <td>@if ($user->status)
                                            <i class="bi bi-check-circle-fill  text-success"></i>
                                            @else
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        @endif</td>
                                       
                                        
                                      
                                      
                                       

                                       
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



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
