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
                                <div class="col">
                                    <div class="card banner">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">Habilitación de Agendas</h3>
                                        </div>
                                    </div>
                                    <div class="card bg-dark text-light mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Platino: 14:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold text-left mx-2">Oro: 15:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Plata: 16:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Bronce: 17:00</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card bg-dark text-light mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-lg font-bold text-left mt-2 mb-2 mx-2">Aún no están
                                                    habilitadas las reservas para tu rango</div>
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
    @include('layouts.footer')
@endsection
