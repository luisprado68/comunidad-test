<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0 m-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/static_files/images/logos/dbkLogo.png" alt="DBK Logo"
                height="72"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link mx-2 active item-nav" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/img/logo.webp') }}" alt="tag" class="profile-img">
                    </a>
                    <ul class="dropdown-menu m-0" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Apoyar</a></li>
                        <li><a class="dropdown-item" href="#">Agendar</a></li>
                        <li><a class="dropdown-item" href="#">Mis Agendas</a></li>
                        <li><a class="dropdown-item" href="#">Historial</a></li>
                        <li><a class="dropdown-item" href="#">Donaciones</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
            <a class="nav-link mx-2" href="#">Cerrar Sesión</a>
            <a class="nav-link mx-2" href="#">Cerrar Sesión<span class="ms-2">&#x2192;</span></a>
          </li> --}}
            </ul>
        </div>
    </div>
</nav>
