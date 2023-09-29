@extends('layouts.app')

@section('content')

 
    <div class="container bg-primary">
        <div class="row">
            <div class="col-md-4 justify-content-center">
                <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="rounded-circle w-50">
            </div>
            <div class="col-md-4">
               <div class="row">
                <div class="col-4 p-0 ">
                  <h5 class="text-center">Puntaje del dia</h5>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <input class="pr-5 form-control form-control-lg " type="text" placeholder="0/10">
                  </div>
                </div>
               </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                 <div class="col-4 p-0 ">
                   <h5 class="text-center">Puntaje de Semana</h5>
                 </div>
                 <div class="col-7">
                   <div class="form-group">
                     <input class="pr-5 form-control form-control-lg " type="text" placeholder="0/10">
                   </div>
                 </div>
                </div>
             </div>
          <div class="col-md-12 pt-5 w-100">
            <div class="card bg-dark">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body bg-dark">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{ __('You are logged in!') }}
                    <div class="row">
                        <div class="col-6">
                            <div class="col-md-12 pt-5 w-100">
                                <div class="card">
                                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                    
                                    <div class="card-body">
                                       <h1>Nivel</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-md-12 pt-5 w-100">
                                <div class="card">
                                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                    
                                    <div class="card-body">
                                        <h1>Preferidos</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-md-12 pt-5 w-100">
                                <div class="card">
                                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                    
                                    <div class="card-body">
                                        <img src="{{ asset('/img/rango.jpg') }}" alt=""  class="rounded-circle w-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-md-12 pt-1 w-100">
            <div class="card bg-secondary">
                <div class="card-body bg-secondary">
                    <h5>COMPARTE TU LINK CON UN AMIGO</h5>
                    <p>asdasdasdasdasdasdasdasdsadasdasdasdasdasdasdasdasdasdasdsadasdasdsadsadasdas</p>
                    <div class="form-group">
                        <input class="pr-5 form-control form-control-lg " type="text" placeholder="0/10">
                      </div>
                </div>
            </div>
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                
        </div>
        </div>
    </div>
@endsection
