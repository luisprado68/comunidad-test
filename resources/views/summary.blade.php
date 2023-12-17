@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status',['user' => $user])
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card banner">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">Rango</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card banner ">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">Referidos</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    @if (env('APP_ENV') == 'local')
                                        <img src="{{ asset('/img/rango.jpg') }}" alt="tag" class="w-25 m-5">
                                    @else
                                        <img src="./public/img/rango.jpg" alt="tag" class="w-25 m-5">
                                    @endif
                                    <p class="text-light">Bronce</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('share')
            @endif
           
            
        </div>
    </div>
    @include('layouts.footer')
@endsection
