<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0 m-0">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                            <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{-- <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img"> --}}
                                <img src="./public/img/logo.webp" alt="tag" class="profile-img">
                            </a>
                            <ul class="dropdown-menu m-0" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('summary') }}">Resumen</a></li>
                                <li><a class="dropdown-item" href="{{ route('support') }}">Apoyar</a></li>
                                <li><a class="dropdown-item" href="#">Agendar</a></li>
                                <li><a class="dropdown-item" href="{{ route('my_agendas') }}">Mis Agendas</a></li>
                                <li><a class="dropdown-item" href="#">Historial</a></li>
                                <li><a class="dropdown-item" href="#">Donaciones</a></li>
                                <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            {{-- </div> --}}
        {{-- </div> --}}



    </div>
</nav>
