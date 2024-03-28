@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status', ['user' => $user])
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary mb-4">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card bg-success">
                                        <div class="card-body text-start text-center">
                                            <h3 class="text-light ">Streams en Directo</h3>
                                        </div>
                                    </div>
                                </div>
                                @if ($show_streams)
                              
                                    @foreach ($streams as $key => $stream)
                                   
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="card banner">
                                                <div class="card-body text-center">
                                                    <h3 class="text-light text-center">{{ $stream['name'] }}</h3>
                                                    @if (env('APP_ENV') == 'local')
                                                        <img src="{{ $stream['img'] }} " alt="tag"
                                                            class="w-50  m-1 text-center " style="height: 200px">
                                                    @else
                                                        <img src=" {{ $stream['img'] }}" alt="tag"
                                                            class="w-50 m-1 text-center " style="height: 200px">
                                                    @endif
                                                    <div class="col">
                                                        {{-- nuevos cambios --}}
                                                        <p id="contador" style="display: none"></p>
                                                        <p id="contadorDos" style="display: none"></p>
                                                        <p id="{{'twich_id'.$key}}"  style="display: none">{{ $stream['twich_id'] }}</p>
                                                        <a id="{{'url'.$key}}" style="" href="{{ 'https://www.twitch.tv/' . $stream['login'] }}">
                                                        </a>
                                                       
                                                        {{-- <button class="btn btn-primary"><a
                                                                href="{{ 'https://www.twitch.tv/' . $stream['login'] }}"
                                                                target="_blank"
                                                                style="text-decoration: none;color:white">Ver
                                                                Stream</a></button>  --}}

                                                                {{-- nuevos cambios--}}
                                                                @if ($key == 0)
                                                                <button class="btn btn-primary"><a
                                                                    href="#" onclick="abrirVentana(); return false;"
                                                                    style="text-decoration: none;color:white">Ver
                                                                    Stream</a></button>
                                                                @else
                                                                <button class="btn btn-primary"><a
                                                                    href="#" onclick="abrirVentanaSegunda(); return false;"
                                                                    style="text-decoration: none;color:white">Ver
                                                                    Stream</a></button>
                                                                @endif
                                                               

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card ">
                                                    <div class="card-body text-start text-dark">
                                                        <p>Por ahora no hay streams vuelve en hora puntual, para ver los
                                                            streams asignados de la hora.

                                                        </p>
                                                        <p><b>Siguiente stream:</b>{{ $date_string }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif


                                <div class="col-6 text-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <input type="text" class="form-control" aria-label="Default" name="times" id="times"
                    aria-describedby="inputGroup-sizing-default" value="{{ $times }}" style="display: none"> --}}
            @endif

            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('chatters')
    {{-- @if (env('APP_ENV') == 'local')
        <script src="{{ asset('/js/setTime.js') }}"></script>
    @else
        <script src="./public/js/setTime.js"></script>
    @endif --}}
@endpush
