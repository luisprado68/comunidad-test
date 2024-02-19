@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 pt-5 w-100">
                @if (session()->has('user') && session('status') == 0)

                    @include('link')
                @else
                    <div class="col text-center pb-3">
                        <h4 class="text-light text-center">BIENVENIDO A LA COMUNIDAD MAS GRANDE DE STREAMERS</h4>
                        <h4 class="text-light text-center">DONDE PODRÁS CONOCER CREADORES DE CONTENIDO</h4>
                        <h4 class="text-light text-center">PARA QUE PUEDAN INTERACTUAR,HACER COLABORACIONES, TORNEOS Y EVENTOS.</h4>
                    </div>
                    <div class="card mt-4 bg-dark">
                        {{-- <div class="card-body fondo_claro"> --}}
                        <div class="card-body bg-dark">
                            <div class="row">

                                <div class="col-12">
                                    <div class="col-md-12 w-100">
                                        <div class="card ">
                                            {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                                            <div class="row">
                                                <div class="col-12 m-2">

                                                    <h1 class="text-center pb-3">QUE TENGO QUE HACER?</h1>


                                                    <ul style="list-style: none;" class="text-center p-0">
                                                        <li class="pb-2">
                                                            <h5 class="text-center">Apoya los directos de los streamers y genera puntos.</h5>
                                                        </li>
                                                        <li>
                                                            <h5 class="text-center">Esos puntos te servirán para que tengas apoyo y muchos
                                                                beneficios.</h5>
                                                            {{-- {{session('test')}} --}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if (!session()->has('user'))
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="card-body text-center">
                                                            @if (env('APP_ENV') == 'local')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('login-test') }}"><button type="button"
                                                                        class="btn btn-lg twich-button" style=""><i
                                                                            class="fa-brands fa-twitch"></i> Únete
                                                                        con
                                                                        TWITCH</button></a>
                                                            @else
                                                                <a class="dropdown-item" href="{{ route('login') }}"><button
                                                                        type="button" class="btn btn-lg twich-button"
                                                                        style=""><i class="fa-brands fa-twitch"></i>
                                                                        Únete
                                                                        con
                                                                        TWITCH</button></a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="card-body text-center">
                                                            <a class="dropdown-item" href="https://trovo.live/" target="_blank"><button type="button" class="btn btn-lg trovo-button" 
                                                                style="">
                                                                <img src="{{ asset('/img/trovo.png') }}" alt="" width="25px">
                                                                 Únete con
                                                                TROVO</button></a>
                                                                
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="card-body text-center">
                                                            <a class="dropdown-item" href="https://kick.com/" target="_blank"><button type="button" class="btn btn-lg kick-button"
                                                                style="">
                                                                <i class="fa-brands fa-kickstarter"></i> Únete con
                                                                KICK</button></a>
                                                            
                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-s-12">
                                    <div class="col-md-12 s-12 pt-5 w-100">
                                        <div class="card banner">
                                            <h6 class="text-center">Streamers en directo.</h6>

                                            <div class="row">
                                                <div class="col-md-12 p-3">
                                                    <div class="card streamer-uno" style="height: 150px; background-color: violet">
                                                        {{-- <div class="w-50"></div> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12 p-3">
                                                    <div class="card streamer-dos" style="height: 150px;background-color: violet">
                                                        {{-- <div class="w-50"></div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-s-12">
                                    <div class="col-md-12 pt-5 w-100">
                                        <div class="card banner_trovo">
                                            <h6 class="text-center">Streamers en directo.</h6>

                                            <div class="row">
                                                <div class="col-md-12 p-3">
                                                    <div class="card under" style="height: 150px">
                                                        <div class="w-50"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 p-3">
                                                    <div class="card under" style="height: 150px">
                                                        <div class="w-50"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-s-12">
                                    <div class="col-md-12 s-12 pt-5 w-100">
                                        <div class="card banner_kick">
                                            <h6 class="text-center">Streamers en directo.</h6>

                                            <div class="row">
                                                <div class="col-md-12 p-3">
                                                    <div class="card under" style="height: 150px">
                                                        <div class="w-50"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 p-3">
                                                    <div class="card under" style="height: 150px">
                                                        <div class="w-50"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @if (isset($times))
                        <input type="text" class="form-control" aria-label="Default" name="times" id="times"
                        aria-describedby="inputGroup-sizing-default" value="{{ $times }}" style="display: none">
                    @endif --}}
                   
                @endif



            </div>

        </div>
    </div>
    @include('layouts.footer')
@endsection
@push('chatters')
    {{-- @if (env('APP_ENV') == 'local')
        <script src="{{ asset('/js/setTime.js') }}"></script>
    @else
        <script src="./public/js/setTime.js"></script>
    @endif --}}
@endpush
