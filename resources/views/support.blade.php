@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status')
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary mb-4">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card bg-success">
                                        <div class="card-body text-start text-center">
                                            <h3 class="text-light ">Mis próximos streams</h3>
                                        </div>
                                    </div>
                                </div>
                                @if ($show_streams)
                                @foreach ($streams as $streams)
                                <div class="col-6">
                                    <div class="card banner">
                                        <div class="card-body text-center">
                                            <h3 class="text-light text-center">{{$streams['name']}}</h3>
                                            @if (env('APP_ENV') == 'local')
                                                <img src="{{$streams['img']}} " alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @else
                                                <img src=" {{$streams['img']}}" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @endif
                                            <div class="col">
                                                <button  class="btn btn-primary"><a href="{{ 'https://www.twitch.tv/' .$streams['login']}}" target="_blank" style="text-decoration: none;color:white">Ver Stream</a></button>
                                                
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
                                                    <p>Por ahora no hay streams vuelve en hora puntual, para ver los streams asignados de la hora. 

                                                    </p>
                                                    <p><b>Siguiente stream:</b>{{$date_string }}</p>
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
            @endif

            @include('layouts.footer')
        </div>
    </div>
@endsection
