<x-app-layout>
    <x-slot name="title">Inicio</x-slot>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/material-kit.js' ])

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">


    <body class="about-us bg-gray-200">
    <header class="bg-gradient-dark">
        <div class="page-header min-vh-75" style="background-image: url('https://cdn.loveco-shop.de/magazin/wp-content/uploads/2019/04/alexandra-gorn-485551-unsplash-1060x707.jpg')">
            <span class="mask bg-gradient-dark opacity-5"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto my-auto">
                        <h1 class=" text-white" >Easy-Rent</h1>
                        <p class="lead mb-4 text-white opacity-8">Tu proximo lugar esta aca</p>
                        <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{route('alquileres')}}">Quiero buscar un alquiler</a>
                        <span>ㅤㅤ</span>
                        <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{route('publicaciones.index')}}">Quiero publicar un alquiler</a>
{{--                        @foreach($caracteristicasEsperadas as $car)--}}
                        @if(session('noregistros') == 'ok')
                            <!-- Button trigger modal -->
                            <br>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Completar encuesta de gustos
                            </button>
                        @elseif (session('registros') == 'ok')
                            @foreach($caracteristicasEsperadas as $c)
{{--                                @if($c->isEmpty())--}}
{{--                                    <br>--}}
{{--                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                                        Completar encuesta de gustos--}}
{{--                                    </button>--}}
                                @if($c->id_usuario == auth()->user()->id)
                                    <p class="text-white opacity-8">Usted ya respondio nuestra encuesta de gustos de alquileres</p>
                                @elseif($c->id_usuario != auth()->user()->id)
                                    <!-- Button trigger modal -->
                                    <br>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Completar encuesta de gustos
                                    </button>
                                @endif
                            @endforeach
                        @endif


{{--                        @if($caracteristicasEsperadas->id_usuario == auth()->user()->id)--}}
{{--                                <a class="btn bg-gradient-primary text-white border-radius-lg" href="{{route('caracteristicasEsperadas.edit', $car)}}">Editar mis caracteristicas</a>--}}
{{--                                <p class="lead mb-4 text-white opacity-8">Usted ya respondio nuestra encuesta de gustos de alquileres</p>--}}
{{--                            @elseif($caracteristicasEsperadas->id_usuario != auth()->user()->id)--}}
{{--                                <!-- Button trigger modal -->--}}
{{--                                <br>--}}
{{--                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                                    Completar encuesta de gustos--}}
{{--                                </button>--}}
{{--                            @elseif($caracteristicasEsperadas->id_usuario == null)--}}
{{--                                <!-- Button trigger modal -->--}}
{{--                                <br>--}}
{{--                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                                    Completar encuesta de gustos--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>

        {{--    Modal--}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Encuesta de gustos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{--                    formulario multistep--}}
                        <div class="multisteps-form">
                            <!--progress bar-->
                            <div class="row mt-5">
                                <div class=" ml-auto mr-auto mb-4">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info"
                                                id="progresTipo">Tipo de Inquilino
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Address"
                                                id="progresUbicacion">Tipo de propiedad
                                        </button>
                                        {{--                                        <button class="multisteps-form__progress-btn" type="button" title="Order Info"--}}
                                        {{--                                                id="progresCaracteristica">Ubicacion Preferida--}}
                                        {{--                                        </button>--}}
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresImagen">Ambientes
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresComodidad">Dormitorios
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Baños
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Cocheras
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Precio espereado
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Tipo de incapacidad
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Mascotas
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Servicios
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Caracteristicas opcionales
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                                id="progresTipoInq">Otros tipos de ambientes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                                <form class="multisteps-form__form" action="{{route('encuesta.store')}}" method="POST"
                                      enctype="multipart/form-data" id="form">
                                    @csrf

                                    {{--Tipo de Inquilino--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿En que grupo de inquilino se encontraria usted?</h3>
                                        <div class="multisteps-form__content">

                                            <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                @foreach($tipoInquilino as $tipo)
                                                    <div class="col form-check-inline">
                                                        <input type="checkbox" name="inquilinos[]"
                                                               value="{{$tipo->id}}"
                                                               id="{{$tipo->id}}" class="form-check-input ">
                                                        <label
                                                            for="{{$tipo->id}}">{{$tipo->nombre_tipo_inquilino}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button"
                                                        title="Next">Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--PANEL TIPO DE PROPIEDAD-->
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">Seleccione los tipos de propiedad que desea encontrar:</h3>
                                        <div class="multisteps-form__content">

                                            <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                @foreach($tiposPropiedad as $tipo)
                                                    <div class="col form-check-inline">
                                                        <input type="checkbox" name="propiedades[]"
                                                               value="{{$tipo->id}}"
                                                               id="{{$tipo->id}}" class="form-check-input ">
                                                        <label
                                                            for="{{$tipo->id}}">{{$tipo->nombre_tipo_propiedad}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <div class="col">
                                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                        Anterior
                                                    </button>
                                                </div>
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button"
                                                        title="Next">Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                             Panel de Ubicacion preferida   --}}
                                    {{--                                Arreglar las ids para almacenar bien--}}
                                    {{--                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"--}}
                                    {{--                                         data-animation="scaleIn">--}}
                                    {{--                                        <h3 class="multisteps-form__title">¿Sobre que calle, le gustaria encontrar ese alquiler deseado?</h3>--}}
                                    {{--                                        <div class="multisteps-form__content">--}}
                                    {{--                                            <div>--}}
                                    {{--                                                <div class="input-group input-group-outline my-3 ">--}}
                                    {{--                                                    <label class="form-label">Calle</label>--}}
                                    {{--                                                    <input class="form-control" name="calle1" type="text"--}}
                                    {{--                                                           value="{{old('calle1')}}" id="inputCalle">--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="text-danger" id="divCalle"></div>--}}
                                    {{--                                                <div class="input-group input-group-outline my-3 ">--}}
                                    {{--                                                    <label class="form-label">Calle</label>--}}
                                    {{--                                                    <input class="form-control" name="calle2" type="text"--}}
                                    {{--                                                           value="{{old('calle2')}}" id="inputCalle">--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="text-danger" id="divCalle"></div>--}}
                                    {{--                                                <div class="input-group input-group-outline my-3 ">--}}
                                    {{--                                                    <label class="form-label">Calle</label>--}}
                                    {{--                                                    <input class="form-control" name="calle3" type="text"--}}
                                    {{--                                                           value="{{old('calle3')}}" id="inputCalle">--}}
                                    {{--                                                </div>--}}
                                    {{--                                                <div class="text-danger" id="divCalle"></div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="button-row d-flex mt-4 ">--}}
                                    {{--                                            <div class="col">--}}
                                    {{--                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">--}}
                                    {{--                                                    Anterior--}}
                                    {{--                                                </button>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="col text-md-end">--}}
                                    {{--                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">--}}
                                    {{--                                                    Siguiente--}}
                                    {{--                                                </button>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    {{--                                Ambientes--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Cuantos ambientes le gustaria que posea su vivienda?</h3>
                                        <h6 class="">
                                            *Tenga en cuenta que cuando hablamos de ambientes hacemos referencia habitaciones
                                            del lugar(baños,dormitorios,living,comedor,entre otros).
                                        </h6>
                                        <div class="multisteps-form__content">

                                            <div class="mt-5">
                                                <div class="input-group input-group-outline my-3 ">
                                                    <label class="form-label">Ambientes</label>
                                                    <input class="form-control" name="ambientes" type="number"
                                                           value="{{old('ambientes')}}" id="inputAmbiente">
                                                </div>
                                                <div class="text-danger" id="divAmbiente"></div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                              Dormitorios  --}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Cuantos dormitorios le gustaria en su hogar?</h3>
                                        <div class="mt-5">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Dormitorios</label>
                                                <input class="form-control" name="dormitorios" type="number"
                                                       value="{{old('dormitorios')}}" id="inputDormitorio">
                                            </div>
                                            <div class="text-danger" id="divDormitorio"></div>
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Baños--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Cuantos baños le gustaria en su hogar?</h3>
                                        <div class="multisteps-form__content">

                                            <div class="mt-5">
                                                <div class="input-group input-group-outline my-3 ">
                                                    <label class="form-label">Baños</label>
                                                    <input class="form-control" name="banios" type="number"
                                                           value="{{old('banios')}}" id="inputBanio">
                                                </div>
                                                <div class="text-danger" id="divBanio"></div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Cochera--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Le gustaria que su hogar posea cochera?</h3>
                                        <h6 class="">
                                            *Si su respuesta es si seleccione la cantidad
                                        </h6>
                                        <div class="multisteps-form__content">

                                            <div class="mt-5">
                                                <div class="input-group input-group-outline  my-3 ">
                                                    <label class="form-label">Cochera</label>
                                                    <input class="form-control" name="cocheras" type="number"
                                                           value="{{old('cocheras')}}" id="inputCochera">
                                                </div>
                                                <div class="text-danger" id="divCochera"></div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Precio--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">Indique cuanto dinero esta dispuesto a invertir en su comodidad</h3>
                                        <div class="multisteps-form__content">

                                            <div class="mt-5">
                                                <div class="input-group input-group-outline my-3 ">
                                                    <label class="form-label">Precio Minimo</label>
                                                    <input class="form-control " name="preciomin" type="number"
                                                           value="{{old('preciomin')}}" id="inputPrecio">
                                                </div>
                                                <div class="text-danger" id="divPrecio"></div>
                                            </div>
                                            <div class="mt-5">
                                                <div class="input-group input-group-outline my-3 ">
                                                    <label class="form-label">Precio Maximo</label>
                                                    <input class="form-control " name="preciomax" type="number"
                                                           value="{{old('preciomax')}}" id="inputPrecio">
                                                </div>
                                                <div class="text-danger" id="divPrecio"></div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Discapacidad--}}
                                    {{--                                Poner solo el campo de discapacitados--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Es necesario que su vivienda contemple el acceso para personas con discapacidad?</h3>
                                        <div class="multisteps-form__content">

                                            @foreach($comodidades as $comodidad)
                                                @if($comodidad->id == '1')
                                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                        <h6 class="p-2">{{$comodidad->nombre_comodidad}}</h6>
                                                        @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                            @if($caracteristica->id == '1')
                                                                <div class="col form-check-inline">
                                                                    <input type="checkbox" name="caracteristicas[]"
                                                                           value="{{$caracteristica->id}}"
                                                                           id="{{$caracteristica->id}}" class="form-check-input ">
                                                                    <label
                                                                        for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Mascotas--}}
                                    {{--                                Poner solo el campo de Mascotas--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Usted posee mascotas que quiera que lo acompañen en su nuevo hogar?</h3>
                                        <div class="multisteps-form__content">

                                            @foreach($comodidades as $comodidad)
                                                @if($comodidad->id == '1')
                                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                        <h6 class="p-2">{{$comodidad->nombre_comodidad}}</h6>
                                                        @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                            @if($caracteristica->id == '2')
                                                                <div class="col form-check-inline">
                                                                    <input type="checkbox" name="caracteristicas[]"
                                                                           value="{{$caracteristica->id}}"
                                                                           id="{{$caracteristica->id}}" class="form-check-input ">
                                                                    <label
                                                                        for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Servicios--}}
                                    {{--                                Poner solo el campo de Servicios--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Que tipos de servicios le interesaria que posea su hogar?</h3>
                                        <div class="multisteps-form__content">

                                            @foreach($comodidades as $comodidad)
                                                @if($comodidad->id == '2')
                                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                        <h6 class="p-2">{{$comodidad->nombre_comodidad}}</h6>
                                                        @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                            {{--                                                            @if($caracteristica->id == '1')--}}
                                                            <div class="col form-check-inline">
                                                                <input type="checkbox" name="caracteristicas[]"
                                                                       value="{{$caracteristica->id}}"
                                                                       id="{{$caracteristica->id}}" class="form-check-input ">
                                                                <label
                                                                    for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                            </div>
                                                            {{--                                                            @endif--}}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                Caracteristicas opcionales--}}
                                    {{--                                Poner solo el campo de Servicios--}}
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">¿Que otras caracteristicas opcionales le interesaria remarcar?</h3>
                                        <div class="multisteps-form__content">

                                            @foreach($comodidades as $comodidad)
                                                @if($comodidad->id == '3')
                                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                        <h6 class="p-2">{{$comodidad->nombre_comodidad}}</h6>
                                                        @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                            {{--                                                            @if($caracteristica->id == '1')--}}
                                                            <div class="col form-check-inline">
                                                                <input type="checkbox" name="caracteristicas[]"
                                                                       value="{{$caracteristica->id}}"
                                                                       id="{{$caracteristica->id}}" class="form-check-input ">
                                                                <label
                                                                    for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                            </div>
                                                            {{--                                                            @endif--}}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-primary js-btn-next " type="button" title="Next">
                                                    Siguiente
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Otros ambientes-->
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                         data-animation="scaleIn">
                                        <h3 class="multisteps-form__title">Aparte de los ambientes ya establecidos ¿le gustaria que posea alguna otra opcion?</h3>
                                        <div class="multisteps-form__content">

                                            @foreach($comodidades as $comodidad)
                                                @if($comodidad->id == '4')
                                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                        <h6 class="p-2">{{$comodidad->nombre_comodidad}}</h6>
                                                        @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                            {{--                                                            @if($caracteristica->id == '1')--}}
                                                            <div class="col form-check-inline">
                                                                <input type="checkbox" name="caracteristicas[]"
                                                                       value="{{$caracteristica->id}}"
                                                                       id="{{$caracteristica->id}}" class="form-check-input ">
                                                                <label
                                                                    for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                            </div>
                                                            {{--                                                            @endif--}}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="button-row d-flex mt-4 ">
                                            <div class="col">
                                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                                    Anterior
                                                </button>
                                            </div>
                                            <div class="col text-md-end">
                                                <button class="btn btn-success ml-auto" type="submit" title="Send">Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Responder luego</button>
                            {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                        </div>
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
        <!-- END Section with four info areas left & one card right with image and waves -->
        <!-- -------- START Features w/ pattern background & stats & rocket -------- -->
        <!-- -------- END Features w/ pattern background & stats & rocket -------- -->
        <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100" style="--bs-btn-hover-bg:100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/1.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Alquiler a la vuelta de la facu</h5>
                        <h2 class="card-text"> $ 10.000</h2>
                        <p class="card-text">
                            Departamento con todos los servicios incluidos, internet agua y luz, con una vista increible a la ciudad.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/2.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Un alquiler 1</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/3.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">hover</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/4.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/5.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/6.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/7.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-1x1">
                        <img class="card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="img/rents/8.webp" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>


    </body>

</x-app-layout>
