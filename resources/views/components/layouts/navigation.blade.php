<nav class="navbar navbar-expand-lg navbar-dark navbar-absolute shadow-none" style="backdrop-filter:blur(5px); background-color: rgba(240,128,128, .15);">
    <div class="container">
        <a class="navbar-brand text-black" href="javascript:">Aca va el logo xd</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-header-2" aria-controls="navbar-header-2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-header-2">
            <ul class="navbar-nav mx-auto">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link text-black" href="{{route('inicio')}}">--}}
{{--                        Inicio--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link text-black" href="{{ route('alquileres.index')}}">
                        Alquilar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="{{ route('publicaciones.index')}}">
                        Publicar
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://twitter.com/">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white mx-2" href="https://www.facebook.com/">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://www.instagram.com/">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
                <li class="nav-item my-auto ms-3 ms-sm-0">
                    <a href="/login" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
