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
                                <div class="col-6">
                                    <div class="card banner">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">Últimos Apoyos</h3>
                                        </div>

                                    </div>
                                    <div class="card bg-dark text-light mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-lg font-bold text-center">mar. 03 oct. 04:05</div>
                                            </div>
                                            <div class="col">
                                                <div class="text-lg font-bold pt-3">LobatoXY</div>
                                            </div>
                                            <div class="col">
                                                <div class="m-1 bg-danger text-light text-center">Poco tiempo en el stream
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-dark text-light mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-lg font-bold text-center">mar. 03 oct. 04:05</div>
                                            </div>
                                            <div class="col">
                                                <div class="text-lg font-bold pt-3">LobatoXY</div>
                                            </div>
                                            <div class="col">
                                                <div class="m-1 bg-success text-light text-center">Apoyo Completo</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card banner ">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">NeoCoins</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    {{-- @if (env('APP_ENV') == 'local')
                                    <img src="{{ asset('/img/rango.jpg') }}" alt="tag" class="w-25 m-5">
                                @else
                                    <img src="./public/img/rango.jpg" alt="tag" class="w-25 m-5">
                                @endif --}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            
        </div>
    </div>
    @include('layouts.footer')
@endsection
