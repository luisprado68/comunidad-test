<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0 m-0">
    {{-- @dd(session('user')['profile_image_url']) --}}
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0 m-0"> --}}
    {{-- <div class="container-fluid"> --}}
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        {{-- <div class="col-1">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/img/logo_co.avif') }}"
                        alt="tag" width="100"height="100"></a>
            </div> --}}
        {{-- <div class="col-4 offset-3 ">
                <a class="navbar-brand" href="#"><img src="{{ asset('/img/flayer.jpg') }}" alt="tag"
                        width="500"height="100"></a>
            </div> --}}
        {{-- <div class="col-lg-1 offset-lg-11 col-sm-1 offset-sm-6  "> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            {{-- ms-auto --}}
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                            <a class="nav-link mx-2 active item-nav" aria-current="page"
                                href="{{ route('home') }}">Inicio</a>
                        </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- @if (env('APP_ENV') == 'local') --}}
                        {{-- <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img"> --}}
                        @if (session()->has('user'))
                            {{-- <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img"> --}}
                            <img src="{{ session('user')['profile_image_url'] }}" alt="tag"
                                class="profile-img rounded-circle">
                        @else
                            @if (env('APP_ENV') == 'local')
                                <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img">
                            @else
                                <img src="./public/img/logo.webp" alt="tag" class="profile-img">
                            @endif

                        @endif
                        {{-- @else
                            @if (session()->has('user'))
                            
                                <img src="{{ session('user')['profile_image_url'] }}" alt="tag"
                                    class="profile-img rounded-circle">
                            @else
                                <img src="./public/img/logo.webp" alt="tag" class="profile-img">
                            @endif --}}

                        {{-- @endif --}}



                    </a>
                    <ul class="dropdown-menu m-0" aria-labelledby="navbarDropdownMenuLink">

                        @if (session()->has('user'))
                            {{-- <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img"> --}}
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('summary') }}">Resumen</a></li>
                            <li><a class="dropdown-item" href="{{ route('support') }}">Apoyar</a></li>
                            <li><a class="dropdown-item" href="{{ route('schedule') }}">Agendar</a></li>
                            <li><a class="dropdown-item" href="{{ route('my_agendas') }}">Mis Agendas</a></li>
                            <li><a class="dropdown-item" href="{{ route('history') }}">Historial</a></li>
                            <li><a class="dropdown-item" href="{{ route('donation') }}">Donaciones</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('home') }}">Inicio</a></li>
                        @endif

                    </ul>
                </li>

            </ul>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}



    </div>
</nav>
@push('chatters')
    <script>
        console.log('test');

        var now = new Date();
      
        console.log('manual');
        var manual = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 18, 0, 0, 0);
        console.log(manual);

        console.log('manual_two');
        var manual_two = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 18, 15, 0, 0);
        console.log(manual_two);



        if (now > manual && now <= manual_two) {

        }
        var xmas95 = new Date("2023-12-08T18:16:00");
        console.log('xmas95');
        console.log(xmas95);

        var dos = xmas95.getTime();

        console.log('dos');
        console.log(dos);
        let chattersObteined = false;

        const id = setInterval(() => {


            current = new Date();
            var hour = current.getHours();
            var minute = current.getMinutes();
            console.log(hour + ':' + minute);

            if (minute >= 50 && minute <= 52) {
                console.log('entro');
                clearInterval(id);
               
               
                $.ajax({
                    url: 'chatters',
                    type: "GET",
                   
                    success: function(response) {
                        console.log(response);

                        if (response.status === 'ok') {
                            // $("#edit-dialog").modal("hide");
                            // table.draw();
                            console.log('okkkk');
                            console.log(response);
                            window.location.href = "{{ route('my_agendas') }}";
                        } else {
                            console.log('error');
                            window.alert(response.message);
                            // window.location.href = "{{ route('schedule') }}";
                            location.reload()
                        }
                        // $(".loading").hide();
                    },
                    error: function(data) {

                    }
                });

                
              
            }

        }, 60000);




        

       
    </script>
@endpush
