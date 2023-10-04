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
            @include('status')
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
                                {{-- <img src="{{ asset('/img/rango.jpg') }}" alt="tag" class="w-25 m-5"> --}}
                                <img src="./public/img/rango.jpg" alt="tag"  class="w-25 m-5">
                                <p class="text-light">Bronce</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
