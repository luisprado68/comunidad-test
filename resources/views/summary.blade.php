@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            {{-- <div class="d-flex justify-content-between">
                <div><img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img"></div>
                <div class="row">
                    <div class="col-s-12 col-l-3"><input class="form-control form-control-lg" type="text" placeholder="0/10"></div>
                    <div class="col-s-12"><input class="form-control form-control-lg" type="text" placeholder="0/10"></div>
                </div>
                <div class="row">
                    <div class="col-s-12"><input class="form-control form-control-lg" type="text" placeholder="0/10"></div>
                    <div class="col-s-12"><input class="form-control form-control-lg" type="text" placeholder="0/10"></div>
                </div>
            </div> --}}
            <div class="col-md-12 pt-5 w-100">
                <div class="card bg-dark">

                    <div class="card-body bg-dark">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img">
                                <label class="text-light" for="">Score Día</label>
                            </div>
                            <div class="col-4 offset-2">
                                <div class="row">
                                    <div class="col">
                                        <label class="text-light" for="">Score Día</label>
                                        <input class="form-control form-control-lg bg-warning text-center" type="text" placeholder="0/10">
                                    </div>
                                    <div class="col">
                                        <label class="text-light" for="">Score Sem</label>
                                        <input class="form-control form-control-lg bg-warning text-center" type="text" placeholder="0/10">
                                    </div>
                                </div>

                            </div>
                            <div class="col-2 offset-2">
                                <div class="input-group mb-3 ">
                                    <div class="input-group-prepend bg-dark">
                                        <span class="input-group-text bg-primary text-light" id="basic-addon1">Tokens</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0" aria-label="0"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend bg-dark">
                                        <span class="input-group-text bg-primary text-light" id="basic-addon1">Apoyo Máximo</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
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
                                <img src="{{ asset('/img/rango.jpg') }}" alt="tag" class="w-25 m-5">
                                <p class="text-light">Bronce</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}


            </div>
            <div class="col-md-12 pt-1 w-100">
                <div class="card bg-secondary">
                    <div class="card-body footer text-light ">
                        <h5>COMPARTE TU LINK CON UN AMIGO</h5>
                        <p>Comparte este link con un colega streamer y gana 10 puntos cuando él haga su primer directo con la comunidad.</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="https://www.comunidadsp.com/referrer/lucho952000" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn bg-dark text-light" type="button">Copiar</button>
                            </div>
                          </div>
                    </div>
                </div>
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}


            </div>
        </div>
    </div>
@endsection
