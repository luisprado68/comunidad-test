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
                        @if ( $user_model->role_id == 3)
                                        <div class="col-2 mb-4">
                                            <button type="submit" class="btn btn-success"><a class="dropdown-item"
                                                href="{{ route('admin-schedulers') }}">Ver Agendas</a></button>
                                        </div>
                                    
                                            
                                        @endif
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Channel</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dump($users) --}}
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        @if ($user->role_id == 3)
                                            <td> Admin</td>
                                        @else
                                        <td>{{ $user->role->name }}</td>
                                        @endif
                                        
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->channel }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if ($user->status)
                                            <i class="bi bi-check-circle  text-success">Activo</i>
                                            @else
                                            <i class="bi bi-check-circle  text-danger">No activo</i>
                                            
                                        @endif</td>
                                        <td><button type="submit" class="btn btn-primary"><a class="dropdown-item"
                                                    href="{{ route('admin-edit', $user['id']) }}">Edit</a></button>
                                        {{-- @dump($user_model->role_id) --}}
                                        @if ( $user_model->role_id == 3)
                                        
                                    
                                            <button type="submit" class="btn btn-success"><a class="dropdown-item"
                                        href="{{ route('admin-show', $user['id']) }}">Ver</a></button>
                                        @endif
                                      
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Eliminar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="exampleModalLabel">
                                                            Eliminar el usuario
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Desea eliminar al usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-danger"><a
                                                                class="dropdown-item"
                                                                href="{{ route('admin-delete', $user['id']) }}">Eliminar</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
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
