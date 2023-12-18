@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status', ['user' => $user])
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
                <input type="text" class="form-control" aria-label="Default" name="times" id="times"
                    aria-describedby="inputGroup-sizing-default" value="{{ $times }}" style="display: none">
                @include('share')
            @endif


        </div>
    </div>
    @include('layouts.footer')
@endsection
@push('chatters')

    @if (env('APP_ENV') == 'local')
        <script src="{{ asset('/js/setTime.js') }}"></script>
    @else
        <script src="./public/js/setTime.js"></script>
    @endif

    

@endpush
