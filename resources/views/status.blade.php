<div class="col-md-12 pt-5 w-100">
    <div class="card bg-dark">

        <div class="card-body bg-dark">
            <div class="row">
                {{-- <div class="col-2">
                    @if (env('APP_ENV') == 'local')
                        <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img">
                    @else
                        <img src="./public/img/logo.webp" alt="tag" class="profile-img">
                    @endif
                    <label class="text-light" for="">Score Día</label>
                </div> --}}
                <div class="col-4 offset-2">
                    <div class="row">
                        <div class="col">
                            <label class="text-light" for="">Puntaje Día</label>
                            <input class="form-control form-control-lg bg-warning text-center" type="text"
                                placeholder="{{session('points_day'). '/10'}}" disabled>
                        </div>
                        <div class="col">
                            <label class="text-light" for="">Puntaje Semanal</label>
                            <input class="form-control form-control-lg bg-warning text-center" type="text"
                                placeholder="{{session('points_week'). '/60'}}" disabled>
                        </div>
                    </div>

                </div>
                <div class="col-2 offset-2">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend bg-dark">
                            <span class="input-group-text bg-primary text-light" id="basic-addon1">NeoCoins</span>
                        </div>
                        <input type="text" class="form-control" placeholder="0" aria-label="0"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend bg-dark">
                            <span class="input-group-text bg-primary text-light" id="basic-addon1" style="font-size: 1rem;">Apoyo Máx</span>
                        </div>
                        <input type="text" class="form-control" placeholder="0" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
