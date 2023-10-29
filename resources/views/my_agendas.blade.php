@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @if (session()->has('user') && env('USER_ACTIVE') == 0)
                @include('link')
            @else
                @include('status')
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card ">
                                        <div class="card-body text-start text-dark">
                                            <p>Esta <b>PROHIBIDO</b> los siguientes comentarios en los chats ya que son
                                                motivo
                                                de baneo ya sea temporal o definitivo: Follow x follow, f4f, fxf, te sigo y
                                                me
                                                sigues, ayúdame a crecer, vengo del grupo o cualquier comentario dando a
                                                conocer
                                                el grupo.
                                            </p>
                                            <p><b>RECUERDA</b> este no es un grupo de FXF.</p>
                                            <p>Tu stream debe estar encendido y evitando problemas técnicos minimo 10
                                                minutos
                                                <b>ANTES</b> de la hora.
                                            </p>
                                            <p><b>PROHIBIDO</b> chat en modo solo seguidores. Si al entrar hay chat modo
                                                solo
                                                seguidores, no se les dara follow ni dar los puntos.</p>
                                            <p><b>PROHIBIDO</b> cerrar directo o enviar raid ANTES de que finalice la hora.
                                            </p>
                                            <p>Si los usuarios no puede chatear libremente, nos reservamos el derecho de
                                                cancelar el apoyo sin devolución de puntos.</p>
                                            <p>Se vera vera en la hora 2 streames del mismo grupo sea A, B, C.</p>


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
            @endif

            
        </div>
    </div>
    @include('layouts.footer')
@endsection
