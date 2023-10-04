@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @include('status')
            <div class="col-md-12 pt-1 w-100">
                <div class="card bg-secondary">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-6">
                                <div class="card banner">
                                    <div class="card-body text-center">
                                        <h3 class="text-light text-center">Stream Designado</h3>
                                        {{-- <img src="{{ asset('/img/stream.avif') }}" alt="tag" class="w-50 m-1 text-center "> --}}
                                        <img src="./public/img/stream.avif" alt="tag"  class="w-50 m-1 text-center ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card banner ">
                                    <div class="card-body text-center">
                                        <h3 class="text-light text-center">Stream Designado</h3>
                                        {{-- <img src="{{ asset('/img/stream.avif') }}" alt="tag" class="w-50 m-1 text-center "> --}}
                                        <img src="./public/img/stream.avif" alt="tag"  class="w-50 m-1 text-center ">
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
