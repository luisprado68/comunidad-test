<div class="col-md-12 pt-1 w-100">
    <div class="card bg-secondary">
        <div class="card-body footer text-light ">
            <h5>COMPARTE TU LINK CON UN AMIGO</h5>
            <p>Comparte este link con un colega streamer y gana 10 puntos cuando él haga su primer directo con la
                comunidad.</p>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ route('referrer', ['user_name' => $user->channel]) }}"
                    aria-label="Recipient's username" aria-describedby="basic-addon2" id="myInput" disabled>
                <div class="input-group-append">
                    <button class="btn bg-dark text-light" type="button" onclick="copy()">Copiar</button>
                </div>
            </div>
        </div>
    </div>
    
</div>
@push('copyText')

    {{-- @if (env('APP_ENV') == 'local') --}}
        <script src="{{ asset('/js/copytext.js') }}"></script>
    {{-- @else
        <script src="./public/js/copytext.js"></script>
    @endif --}}

    

@endpush