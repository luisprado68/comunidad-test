@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status')
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary">
                        <div class="card-body ">
                            <div class="row">
                                @foreach ($streams as $streams)
                                <div class="col-6">
                                    <div class="card banner">
                                        <div class="card-body text-center">
                                            <h3 class="text-light text-center">Stream Designado</h3>
                                            @if (env('APP_ENV') == 'local')
                                                <img src="{{$streams->user->img_profile}} " alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @else
                                                <img src=" {{$streams->user->img_profile}}" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                   
                                @endforeach
                                <div class="col-6">
                                    <div class="card banner">
                                        <div class="card-body text-center">
                                            <h3 class="text-light text-center">Stream Designado</h3>
                                            @if (env('APP_ENV') == 'local')
                                                <img src="{{ asset('/img/stream.avif') }}" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @else
                                                <img src="./public/img/stream.avif" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card banner ">
                                        <div class="card-body text-center">
                                            <h3 class="text-light text-center">Stream Designado</h3>
                                            @if (env('APP_ENV') == 'local')
                                                <img src="{{ asset('/img/stream.avif') }}" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @else
                                                <img src="./public/img/stream.avif" alt="tag"
                                                    class="w-50 m-1 text-center ">
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
