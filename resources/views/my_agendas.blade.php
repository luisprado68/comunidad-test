@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @include('status')
            <div class="col-md-12 pt-1 w-100">
                <div class="card bg-secondary">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12">
                                <div class="card banner">
                                    <div class="card-body text-start text-light">
                                        <p>Tu stream debe estar encendido y evitando problemas técnicos minimo 10 minutos ANTES de la hora. </p>
                                        <p>PROHIBIDO chat en modo solo seguidores. Si al entrar hay chat modo solo seguidores, no se les dara follow ni dar los puntos. </p>
                                        <p>PROHIBIDO cerrar directo o enviar raid ANTES de que finalice la hora.</p>
                                        <p>Si los usuarios no puede chatear libremente, nos reservamos el derecho de cancelar el apoyo sin devolución de puntos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card banner ">
                                    <div class="card-body text-start">
                                        <h3 class="text-light ">Mis próximos streams</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
