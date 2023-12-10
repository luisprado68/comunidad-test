@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 pt-5 w-100">
                @if (session()->has('user') && session('status') == 0)
                    @include('link')
                @else
                    <div class="card bg-dark">

                        <div class="card-body bg-dark">
                            <div class="row">

                                <div class="col-12">
                                    <div class="col-md-12 w-100">
                                        <div class="card ">
                                            {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                                            <div class="row">
                                                <div class="col-12 m-2">

                                                    <h1 class="text-center">NEO COMMUNITY</h1>
                                                    <h6 class="">Bienvenido a la comunidad mas grande de streamers,
                                                        donde
                                                        podrás conocer creadores de contenido para que puedan interactuar,
                                                        hacer
                                                        colaboraciones, torneos y eventos.</h6>
                                                    <h6>QUE TENGO QUE HACER?</h6>
                                                    <ul>
                                                        <li>
                                                            <h6>Apoya los directos de los streamers y genera puntos.</h6>
                                                        </li>
                                                        <li>
                                                            <h6>Esos puntos te servirán para que tengas apoyo y muchos
                                                                beneficios.</h6>
                                                            {{-- {{session('test')}} --}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if (!session()->has('user'))
                                                
                                                <div class="col">
                                                    <div class="card-body text-center">
                                                        @if (env('APP_ENV') == 'local')
                                                            <a class="dropdown-item" href="{{ route('login-test') }}"><button
                                                                    type="button" class="btn btn-lg twich-button"
                                                                    style=""><i class="fa-brands fa-twitch"></i> Únete
                                                                    con
                                                                    TWITCH</button></a>
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('login') }}"><button
                                                                    type="button" class="btn btn-lg twich-button"
                                                                    style=""><i class="fa-brands fa-twitch"></i> Únete
                                                                    con
                                                                    TWITCH</button></a>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card-body text-center">

                                                        <button type="button" class="btn btn-lg kick-button"
                                                            style="">
                                                            <i class="fa-brands fa-kickstarter"></i> Únete con
                                                            KICK</button>
                                                    </div>
                                                </div>
                                                @endif
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-12 pt-5 w-100">
                                        <div class="card">
                                            <h6 class="text-center">Streamers en directo.</h6>

                                            <div class="row">
                                                <div class="col m-2">
                                                    <div class="card bg-dark"
                                                        style="height: 150px; background-color: violet">
                                                        <div class="w-50">sss</div>
                                                    </div>
                                                </div>
                                                <div class="col m-2">
                                                    <div class="card bg-dark" style="height: 150px">
                                                        <div class="w-50">sss</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-12 pt-5 w-100">
                                        <div class="card">
                                            <h6 class="text-center">Streamers en directo.</h6>

                                            <div class="row">
                                                <div class="col m-2">
                                                    <div class="card bg-dark" style="height: 150px">
                                                        <div class="w-50">sss</div>
                                                    </div>
                                                </div>
                                                <div class="col m-2">
                                                    <div class="card bg-dark" style="height: 150px">
                                                        <div class="w-50">sss</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif



            </div>
           
        </div>
    </div>
    @include('layouts.footer')
@endsection
