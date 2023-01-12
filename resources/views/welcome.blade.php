

@vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css'])
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">






<body class="about-us bg-gray-200">

<header class="bg-gradient-dark">
    <div class="page-header min-vh-75" style="background-image: url('https://cdn.loveco-shop.de/magazin/wp-content/uploads/2019/04/alexandra-gorn-485551-unsplash-1060x707.jpg')">
        <span class="mask bg-gradient-dark opacity-5"></span>
        <div class="container">

{{--            INICIO DE NAVBAR--}}

            <nav class="navbar navbar-expand-lg border-radius-xl top-0 z-index-fixed shadow fixed-top my-3 py-2 start-5 end-5 " style="backdrop-filter:blur(2px); background-color: rgba(255, 255, 255, .75);">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="${pageContext.request.contextPath}/mainpage/" rel="tooltip" title="Pagina de inicio" data-placement="bottom" target="_blank">
                        Easy-Rent
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="true" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                          </span>
                    </button>
                    <div class="navbar-collapse pt-3 pb-2 py-lg-0 w-100 collapse show" id="navigation" style="">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">


                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages5" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md">search</i>
                                    Buscar
                                    {{--                        <img src="../../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">--}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                            Refinar busqueda
                                        </h6>
                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Departamentos</span>
                                        </a>
                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Casas</span>
                                        </a>
                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Monoambientes</span>
                                        </a>
                                    </div>
                                    {{--                        <%--Duplicado para cuando la barra esta colapsada--%>--}}
                                    <div class="d-lg-none">
                                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                            Refinar busqueda
                                        </h6>

                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Departamentos</span>
                                        </a>
                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Casas</span>
                                        </a>
                                        <a href="#" class="dropdown-item border-radius-md">
                                            <span>Monoambientes</span>
                                        </a>
                                    </div>
                                </div>
                            </li>


                            <li class="nav-item dropdown dropdown-hover mx-2">

                                <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user me-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        @if (Route::has('login'))
                                            @auth
                                                <a href="{{ url('/dashboard') }}" class="dropdown-item border-radius-md">Dashboard</a>
                                            @else

                                                <a href="{{ route('login') }}" class="dropdown-item border-radius-md">Log in</a>

                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}" class="dropdown-item border-radius-md">Register</a>
                                                @endif
                                            @endauth
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

{{--            FIN DE NAVBAR--}}

            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mx-auto my-auto">
                    <h1 class=" text-white" >Easy-Rent</h1>
                    <p class="lead mb-4 text-white opacity-8">Tu proximo lugar esta aca</p>

                    <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{route('alquileres.index')}}">Quiero buscar un alquiler</a>
                    @if (Route::has('login'))
                        @auth
                            <span>ㅤㅤ</span>
                            <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{route('publicaciones.index')}}">Quiero publicar un alquiler</a>
                        @else
                            <span>ㅤㅤ</span>
                            <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{ route('login') }}">Quiero publicar un alquiler</a>
                        @endauth
                    @endif

                </div>
            </div>
        </div>
    </div>
</header>
<!-- -------- END HEADER 7 w/ text and video ------- -->
<div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
    <!-- Section with four info areas left & one card right with image and waves -->
    <section class="py-7">
        <div class="container">
            <h3 class="text-center mb-5">Es simple</h3>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card card-body border-0 shadow-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-shape-primary rounded me-3">
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="icon-text">
                                <h5 class="mb-0">Busca</h5>
                            </div>
                        </div>
                        <p class="mt-3 mb-0">Busca el alquiler que mas te guste, con la mejor ubicacion y el mejor precio.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card card-body border-0 shadow-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-shape-success rounded me-3">
                                <i class="fa fa-handshake"></i>
                            </div>
                            <div class="icon-text">
                                <h5 class="mb-0">Contacta</h5>
                            </div>
                        </div>
                        <p class="mt-3 mb-0">Contacta al dueño del alquiler y arregla los detalles de la operacion.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card card-body border-0 shadow-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-shape-warning rounded me-3">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="icon-text">
                                <h5 class="mb-0">Disfruta</h5>
                            </div>
                        </div>
                        <p class="mt-3 mb-0">Disfruta de tu nuevo hogar y de la mejor experiencia de alquiler.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


</body>









