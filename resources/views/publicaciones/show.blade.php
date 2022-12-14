<x-app-layout>

{{--    libreria boostrap 5--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css', 'resources/js/map.js', 'resources/js/bootstrap.js'])
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">



    <body class="container bg-gray-200">
    <div class="container-fluid ">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5 mt-9">


                <div id="carousel-1" class="carousel slide shadow-lg" data-bs-ride="true">
                    <div class="carousel-inner" {{$cantidad = 1}}>

                        @foreach($imagenes as $imagen)
                            @if($imagen->id_publicacion == $publicacion->id)
                        <div class="carousel-item @if($cantidad == 1) active @endif ratio ratio-1x1 "><img class="rounded" style="object-fit:cover; height:100%; width: 100%;" src="{{asset($imagen->url_imagen)}}" alt="Slide Image" /></div {{++$cantidad}}>
                            @endif
                        @endforeach
               </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="fa fa-arrow-left fa-2x" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="fa fa-arrow-right fa-2x" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li class="active" data-bs-target="#carousel-1" data-bs-slide-to="0"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
                    </ol>
                </div>
            </div>

            <div class="col-lg-7 pb-5 mt-9">
                <h3 class="font-weight-semi-bold">{{$publicacion->titulo_publicacion}}</h3>

                {{--                <%--                agregar a favoritos y contacto--%>--}}
                <div class="d-flex mb-3">
                    {{--                    <div class="text-primary mr-2 ms-2 me-2">--}}
                    {{--                        <a href="#" class="btn btn-outline-primary btn-sm">Agregar a favoritos</a>--}}
                    {{--                    </div>--}}
                    <div class="text-primary mr-2 ms-2 me-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">Contactar</a>
                    </div>
                </div>

                @php
                    $promedio = App\Models\Rating::where('id_publicacion', $publicacion->id)->avg('calificacion');
                    $avg = (float)$promedio;
                    $avg = round($avg, 2);
                @endphp

                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: 'Open Sans', serif;
                        background: #eee;
                    }

                    .content{
                        width: 350px;
                        /*height: 200px;*/
                        margin-top: 30px;
                    }

                    .ratings{
                        background-color:#fff;
                        padding: 50px;
                        border: 1px solid rgba(0, 0, 0, 0.1);
                        box-shadow: 0px 10px 10px #E0E0E0;
                    }

                    .product-rating{

                        font-size: 50px;
                    }

                    .stars i{

                        font-size: 18px;
                        color: #e91e63;
                    }

                    .rating-text{
                        margin-top: 10px;
                    }
                </style>

                <div class="d-flex">
                    <div class="content text-center">
                        <div class="ratings">
                            <span class="product-rating">{{$avg}}</span><span>/5</span>
                            @if($avg == 5)
                                <div class="stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            @elseif($avg < 5 && $avg > 4)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                                </div>
                            @elseif($avg == 4)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </div>
                            @elseif($avg < 4 && $avg > 3)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                                </div>
                            @elseif($avg == 3)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </div>
                            @elseif($avg < 3 && $avg > 2)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                                </div>
                            @elseif($avg == 2)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </div>
                            @elseif($avg < 2 && $avg > 1)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                                </div>
                            @elseif($avg == 1)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                </div>
                            @elseif($avg < 1 && $avg > 0)
                                <div class="stars">
                                <i class="fa fa-star-half-alt"></i>
                                </div>
                            @elseif($avg == 0)
                                <div class="stars">
                                <i class="fa fa-star"></i>
                                </div>
                            @endif
                            <div class="rating-text">
                                <span>{{$ratings->count()}} calificaciones y {{$ratings->where('comentario', '!=', null)->count()}} comentarios</span>
                                <span>poner codigo php visitas</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col w-70 mt-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-semi-bold">Precio mensual</h5>
                            <div class="row align-items-start">
                                <h3 class="font-weight-semi-bold mb-4 col">$ {{ number_format($publicacion->precio_publicacion, 2, ',', '.')  }} ARS</h3>
                                {{--           -----------------AC?? VA EL BOT??N DE MERCADO PAGO-----------------------------------------------------------}}
                                @if($publicacion->estado_publicacion == "Activo")
{{--                                    <a href="{{route('correos.solicitud')}}" class="btn btn-primary btn-block col">Solicitar Alquiler</a>--}}
{{--                                    <input type="month" >--}}
                                    @if(Auth::user()->hasRole('inquilino'))

                                        @if($solicitud->estado_solicitud == "Nulo")
                                                <form action="{{route('correos.solicitud')}}" method="Get">
                                                    @csrf
                                                    <input type="hidden" name="id_publicacion" value="{{$publicacion->id}}">
                                                    <input type="hidden" name="id_usuario" value="{{auth()->id()}}">
                                                    <input type="submit" class="btn btn-primary btn-block col" value="Solicitar Alquiler">
                                                </form>
                                        @elseif($solicitud->estado_solicitud == "Rechazado")
                                                <form action="{{route('correos.solicitud')}}" method="Get">
                                                    @csrf
                                                    <input type="hidden" name="id_publicacion" value="{{$publicacion->id}}">
                                                    <input type="hidden" name="id_usuario" value="{{auth()->id()}}">
                                                    <input type="submit" class="btn btn-primary btn-block col" value="Solicitar Alquiler">
        {{--                                            <p>--}}
        {{--                                            <hr>--}}
        {{--                                                <small class="text-danger">*Su solicitud fue rechazada.</small>--}}
        {{--                                            <br>--}}
        {{--                                                <small class="text-danger">*Si desea puede realizar otra solicitud, pero recomendamos que revise los terminos de la propiedad.</small>--}}
        {{--                                            <br>--}}
        {{--                                            <br>--}}
        {{--                                                <small class="text-danger">Gracias.</small>--}}

        {{--                                            </p>--}}
                                                    @if (session('rechazado') == 'ok')
                                                        <script>
                                                            Swal.fire(
                                                                'Su solicitud fue rechazada!',
                                                                'Si desea puede realizar otra solicitud, pero recomendamos que revise los terminos de la propiedad.',
                                                                'Error'
                                                            )
                                                        </script>
                                                    @endif
                                                </form>
                                        @elseif($solicitud->estado_solicitud == "Aceptado")
        {{--                                        si existen contratos--}}
                                               @if($contratos->count() == 1)
                                                    @if($contratos->first()->confirmacion_inquilino == 0)
                                                        <div class="alert alert-default-info" role="alert">
                                                            <h4 class="alert-heading text-success">Contrato Creado</h4>
                                                            <p>Su contrato de locaci??n ya fue creado</p>
                                                            @if(isset($contrato_id))
                                                                <p>Puede leerlo pulsando aqu??: <a href="{{route('contratos.show',$contrato_id)}}">Leer Contrato</a> </p>
                                                            @endif
                                                            <hr>
                                                            <p class="mb-0">Debera confirmar que acepta los t??rminos y condiciones del mismo para asi habilitar el m??todo de pago.</p>
                                                            <p class="mb-0">Tiene un tiempo de 5 d??as para hacerlo <b>(Desde: </b>{{$contratos->first()->created_at->format('d-m-Y')}} <b>Hasta: </b>{{$contratos->first()->created_at->addDays(5)->format('d-m-Y')}}<b>)</b>.</p>
                                                            <p class="mb-0">Pasado el plazo establecido, si no hubo confirmaci??n, se dara como cancelado al contrato.</p>
                                                        </div>
                                                    @elseif($contratos->first()->confirmacion_inquilino == 1)
                                                        <div class="cho-container"></div>
                                                    @endif
                                               @else
                                                    <div class="alert alert-default-info" role="alert">
                                                        <h4 class="alert-heading text-warning">Contrato en creaci??n</h4>
                                                        <p>Su solicitud de alquiler fue aceptada, pero debe esperar hasta que el propietario defina su contrato de locaci??n</p>
                                                        <hr>
                                                        <p class="mb-0">Este proceso puede durar hasta 3 dias <b>(Desde: </b>{{now()->format('d-m-Y')}} <b>Hasta: </b>{{now()->addDays(3)->format('d-m-Y')}}<b>)</b>.</p>
                                                        <p class="mb-0">Si el propietario no define el contrato en el tiempo estipulado se dara de baja su solicitud nuevamente.</p>
                                                    </div>
                                               @endif
                                        @elseif($solicitud->estado_solicitud == "Pendiente")
                                                <div class="alert alert-default-info" role="alert">
                                                    <h4 class="alert-heading">Solicitud Pendiente</h4>
                                                    <p>La solicitud de alquiler est?? pendiente de a probaci??n por parte del propietario.</p>
                                                    <hr>
                                                    <p class="mb-0">Si el propietario no aprueba la solicitud en 5 dias, se cancelar?? autom??ticamente.</p>
                                                </div>
                                        @endif
                                    @elseif(Auth::user()->hasRole('propietario'))
{{--                                        @if($solicitud->estado_solicitud == "Nulo")--}}
{{--                                                <div class="alert alert-default-info" role="alert">--}}
{{--                                                <h4 class="alert-heading">Atentos a las solicitudes de sus futuros inquilinos</h4>--}}
{{--                                                <p>Eb caso de alguna actualizaci??n le esteremos informando.</p>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                    @endif
                                @elseif($publicacion->estado_publicacion == "Alquilado")

                                    @if(Auth::user()->hasRole('inquilino'))
    {{--                                    si existe la variable de session pagado--}}
                                        @if (Session::has('pagado'))

                                             @if(Session::get('pagado') === true)
                                                <div class="alert alert-success" role="alert">
                                                    <h6 class="alert-heading">Su factura fue pagada!</h6>
                                                </div>
                                            @elseif(Session::get('pagado') === false)
    {{--                                            poner ruta --}}
                                                <form action="#" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="imagen"></label>
                                                        <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                                                        <input type="hidden" name="id_publicacion" value="{{$publicacion->id}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Verificar pago de factura</button>
                                                </form>

                                                <div class="alert alert-danger" role="alert">
                                                    <h6 class="alert-heading">Su factura no fue pagada!</h6>
                                                </div>
                                            @endif
                                        @elseif(Session::get('pagado') === null)

                                            <form action="#" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="imagen"></label>
                                                    <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                                                    <input type="hidden" name="id_publicacion" value="{{$publicacion->id}}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Verificar pago de factura</button>
                                            </form>


                                            <div class="alert alert-warning" role="alert">
                                                <h6 class="alert-heading">Su factura a??n no ha sido pagada!</h6>
                                            </div>
                                        @endif
                                    @elseif(Auth::user()->hasRole('propietario'))
                                        <h1>soy propietario xd</h1>
{{--                                        si se puede hacer que mientras no este verificada la factura que le diga un mensaje que se esta esperando hasta que suba las facturas--}}
{{--                                        despues cuandi se suba la facura y se pague decirle que se verifico la factura y esta pagado el alquiler--}}
                                    @endif

                                @endif
                                {{--           -----------------AC?? VA EL BOT??N DE MERCADO PAGO-----------------------------------------------------------}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row mt-4">
                    <div class="col-6 ">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;"><i class="fas fa-bed text-white w-50 h-50 position-absolute"></i></div>
                            <div>
                                <h6 class="font-weight-semi-bold ms-2 mb-0">{{$publicacion->dormitorios_publicacion}} Habitaciones</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;"><i class="fas fa-bath text-white w-50 h-50 position-absolute"></i></div>
                            <div>
                                <h6 class="font-weight-semi-bold ms-2 mb-0">{{$publicacion->banios_publicacion}} Ba??os</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;"><i class="fas fa-ruler-combined text-white w-50 h-50 position-absolute"></i></div>
                            <div>
                                <h6 class="font-weight-semi-bold ms-2 mb-0">{{$publicacion->superficie_total_terreno}} m2</h6>
                                <small class="text-muted ms-2">Superficie total</small>
                            </div>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;"><i class="fas fa-car text-white w-50 h-50 position-absolute"></i></div>
                            <div>
                                <h6 class="font-weight-semi-bold ms-2 mb-0">{{$publicacion->cochera_publicacion}} Cochera</h6>
                            </div>
                        </div>
                    </div>

                </div>

{{--                Tipo de inquilinos aceptados      --}}

{{--                <div class="row mt-4">--}}
{{--                    <div class="col-12">--}}
{{--                        <h6 class="font-weight-semi-bold">Tipo de inquilinos aceptos/Perfil de inquilinos permitidos</h6>--}}
{{--                        <p class="text-muted"></p>--}}
{{--                        --}}
{{--                    </div>--}}
{{--                </div>--}}
             @foreach($publicacion->publicacion_tipo_inquilino()->get() as $tipoInquilino)
                <div class="col-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;">
{{--                            <i class="fas fa-car text-white w-50 h-50 position-absolute"></i>--}}
                            @switch($tipoInquilino->nombre_tipo_inquilino)
                                @case("Familia")
                                    <i class="fa-solid fa-family-pants text-white w-50 h-50 position-absolute"></i>
                                    @break
                                @case("Estudiante")
                                    <i class="fas fa-user-graduate text-white w-50 h-50 position-absolute"></i>
                                    @break
                                @case("Adultos mayores(60 a??os en adelante)")
                                    <i class="fa-solid fa-person-cane text-white w-50 h-50 position-absolute"></i>
                                    @break
                                @case("Adultos(27 a 59 a??os)")
                                    <i class="fa-solid fa-user-tie-hair text-white w-50 h-50 position-absolute"></i>
                                    @break
                                @case("J??venes(18 a 26 a??os)")
                                    <i class="fa-solid fa-child text-white w-50 h-50 position-absolute"></i>
                                    @break
                                @case("Pareja")
                                    <i class="fa-solid fa-people w-50 h-50 position-absolute"></i>
                                    @break
                                @case("Persona con discapacidad")
                                    <i class="fa-solid fa-wheelchair text-white w-50 h-50 position-absolute"></i>
                                    @break
                            @endswitch
                        </div>
                        <div>
                            <h6 class="font-weight-semi-bold ms-2 mb-0">{{$tipoInquilino->nombre_tipo_inquilino}}</h6>
                        </div>
                    </div>
                </div>
             @endforeach

            {{--            Descripci??n de la publicaci??n--}}
            <div class="row px-xl-5">
                <div class="col">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-semi-bold">Descripci??n</h5>
                            <p class="text-muted">{{$publicacion->descripcion_publicacion}}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{--            listado de comodidades de la base de datos--}}
            <div class="row px-xl-5">
                <div class="col">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-semi-bold">Comodidades</h5>
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">

                                        {{--                                    Recorre el array de comodidades y muestra las que coincidan con la publicaci??n--}}
                                        @foreach($publicacion->caracteristica_comodidades()->get() as $comodidad)

                                            {{--                                        Solamente visualiza 5 comodidades--}}
                                            @if($loop->iteration <= 5)
                                                <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>{{$comodidad->nombre_caracteristica_comodidad}}</li>
                                            @endif

                                            {{--                                        Cuando es mayor a 5 lo coloca dentro de un span oculto y con javascript lo muestra--}}
                                            @if($loop->iteration > 5)

                                                @if($loop->iteration == 6)
                                                    <span id="dots"></span><span id="more" style="display: none">
                                                @endif
                                                <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>{{$comodidad->nombre_caracteristica_comodidad}}</li>
                                                @if($loop->last)
                                                    </span>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                {{--                                si el array tiene m??s de 5 comodidades, muestra el bot??n de ver m??s--}}
                                @if($publicacion->caracteristica_comodidades()->count() > 5)
                                    <button onclick="myFunction()" id="myBtn" class="btn btn-link text-decoration-none text-primary p-0 align-items-center justify-content-center ">Mostrar m??s<i class="fas fa-chevron-down ms-2"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--            Ubicaci??n de la publicaci??n--}}
            <div class="row px-xl-5">
                <div class="col">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="font-weight-semi-bold ms-2 mb-0 h6">Ubicaci??n</h5>
                                    <p class="text-muted">{{$publicacion->calle_publicacion . " - " . $publicacion->altura_publicacion . " - " . $publicacion->ciudad()->first()->nombre_ciudad}}</p>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center justify-content-lg-end">
                                        <div class="bg-primary p-2 mr-3 rounded-circle position-relative" style="height: 32px; width: 32px;"><i class="fas fa-map-marker-alt text-white w-50 h-50 position-absolute"></i></div>
                                        <div>
{{--                                            <a href="https://www.google.com/maps/search/?api=1&query={{$publicacion->latitud_publicacion . ", " . $publicacion->longitud_publicacion  }}&zoom=20" target="_blank">link</a>--}}

                                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$publicacion->latitud_publicacion . ", " . $publicacion->longitud_publicacion  }}&zoom=20" class="font-weight-semi-bold ms-2 mb-0 h6">Ver en el mapa</a> <br>
                                            <small class="text-muted ms-2">{{$publicacion->calle_publicacion}} - {{$publicacion->altura_publicacion}} - {{$publicacion->ciudad()->first()->nombre_ciudad}}</small>
                                        </div>
                                    </div>
                                </div>

                                {{--                            Mapa PROVICIONAL--}}
                                <div class="w-90 m-auto">
                                    <div class="form-row mt-4 shadow-none p-1 mb- bg-light rounded">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary w-45" id="btn-ubicacion">Ver ubicaci??n</button>
                                                        <button type="button" class="btn btn-primary w-45 " id="btn-calcular">Calcular ruta</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="map1" style="width: 100%; height:600px"></div>
                                        <div id="map2" style="width: 100%; height:600px"></div>
                                        {{--                                        longitud y latitud en hidden--}}
                                        <input type="hidden" id="latitud" value="{{$publicacion->latitud_publicacion}}">
                                        <input type="hidden" id="longitud" value="{{$publicacion->longitud_publicacion}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>



            @if($publicacion->id_usuario == Auth::user()->id)
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('preguntas.index',$publicacion)}}" target="_blank" class="boton-telegram" style="position: fixed; bottom: 0; right: 0; z-index: 9999; margin: 25px ;">
                            <i class="fas fa-user-tie fa-4x" aria-hidden="true"> </i>
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <a href="https://t.me/EasyRentBot" target="_blank" class="boton-telegram" style="position: fixed; bottom: 0; right: 0; z-index: 9999; margin: 25px ;">
                            <i class="fa fa-telegram fa-4x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endif



{{--         Calficiacion y comentario       --}}
            <style>
                *{
                margin: 0;
                padding: 0;
                }
                .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
                }
                .rate:not(:checked) > input {
                position:absolute;
                top:-9999px;
                }
                .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
                }
                .rate:not(:checked) > label:before {
                content: '??? ';
                }
                .rate > input:checked ~ label {
                color: #e91e63;
                }
                .rate:not(:checked) > label:hover,
                .rate:not(:checked) > label:hover ~ label {
                color: #e91e63;
                }
                .rate > input:checked + label:hover,
                .rate > input:checked + label:hover ~ label,
                .rate > input:checked ~ label:hover,
                .rate > input:checked ~ label:hover ~ label,
                .rate > label:hover ~ input:checked ~ label {
                color: #e91e63;
                }
            </style>

{{--            si el usuario autenticado ya envio una puntuacion esnconder el fomrulario--}}
{{--            @foreach($ratings as $rating)--}}
{{--                @if($rating->id_usuario == Auth::user()->id)--}}
{{--                    <h5>Solo se permite calificar una vez por usuario. Gracias por su calificacion</h5>--}}
{{--                @else--}}
                    <div id="calificar">
                        <h4 class="text center mb-5"> Califique esta publicacion y deje su comentario  </h4>
                        <div class="border p-2">
                            <form action="{{route('rating.store',$publicacion)}}" method="Post" name="ratingForm" id="ratingForm">
                                @csrf
                                <input type="hidden" name="id_publicacion" value="{{$publicacion->id}}">
                                <input type="hidden" name="id_usuario" value="{{auth()->id()}}">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="comentario" id="comentario" placeholder="Escriba su comentario aqui"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="Submit" class="btn btn-dark">Publicar</button>
                                </div>
                            </form>
                        </div>
                    </div>
{{--                @endif--}}
{{--            @endforeach--}}

             @if($ratings->where('estado', 1)->count() <= 1)
                <h4 class="text-center mb-5">{{$ratings->where('estado', 1)->count()}} comentario</h4>
            @elseif($ratings->where('estado', 1)->count() > 1)
                <h4 class="text-center mb-5">{{$ratings->where('estado', 1)->count()}} comentarios</h4>
            @endif


            @foreach($ratings as $rating)
                    <div class="border p-3">
                        <p class="font-weight-bolder"><b>Escrito por:</b> {{$rating->user->name}} </p>
                        @if($rating->calificacion == 5)
                            <p><b>Calificacion:</b> {{$rating->calificacion}} <span class="red">???????????????</span> </p>
                        @elseif($rating->calificacion == 4)
                            <p><b>Calificacion:</b> {{$rating->calificacion}} <span class="red">????????????</span> </p>
                        @elseif($rating->calificacion == 3)
                            <p><b>Calificacion:</b> {{$rating->calificacion}} <span class="red">?????????</span> </p>
                        @elseif($rating->calificacion == 2)
                            <p><b>Calificacion:</b> {{$rating->calificacion}} <span class="red">??????</span> </p>
                        @elseif($rating->calificacion == 1)
                            <p><b>Calificacion:</b> {{$rating->calificacion}} <span class="red">???</span> </p>
                        @endif
                        <p>{{$rating->comentario}}</p>
                    </div>
            @endforeach


{{--            @include('comentarios.index' , ['comentarios' => $comentarios])--}}
{{--           @livewire('publicaciones.show-coments', ['publicacion' => $publicacion])--}}
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>


    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ??tem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = $publicacion->titulo_publicacion;
        $item->quantity = 1;//aca tiene que ir valor que se obtenga del multiplicador
        $item->unit_price = $publicacion->precio_publicacion;
        $preference->items = array($item);

        //Manejo de las rutas cuando salen de la pagina de pago
        $preference->back_urls = array(
            "success" => route('publicaciones.pagar', $publicacion),
            "failure" => route('publicaciones.pagar', $publicacion),
            "pending" => route('publicaciones.pagar', $publicacion)
        );
//        $preference->auto_return = "approved";

        $preference->save();
    @endphp

    {{--    SDK MercadoPago.js V2--}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    @if(session('alquilado') == 'ok')
        <script>
            Swal.fire(
                'Alquilado!',
                'Ya puede acceder a la comodidad de su nuevo hogar.',
                'success'
            )
        </script>
    @elseif(session('pendiente') == 'pend')
        <script>
            Swal.fire(
                'Pendiente!',
                'Su pago esta pendiente a ser aprobado.',
                'warning'
            )
        </script>
    @elseif(session('rechazado') == 'rej')
        <script>
            Swal.fire(
                'Rechazado!',
                'Su pago fue rechazo. Por favor intente por otro medio de pago.',
                'Error'
            )
        </script>
    @endif

    @if(session('solicitud') == 'ok')
        <script>
            Swal.fire(
                'Solicitud Enviada!',
                'Se envio de manera exitosa un correo con su solicitud del alquiler al propietario.',
                'success'
            )
        </script>
    @endif

    <script>
        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-AR'
        });
        // //deshabilitar el boton de pago
        // document.querySelector("#pay-button").disabled = false;

        //deshanilitar el boton de pago si el estado de la publicacion es igual a Alquilado
        if("{{$publicacion->estado_publicacion}}" == "Alquilado"){
            document.querySelector("#pay-button").disabled = true;
        }
        mp.checkout({
            preference: {
                id: '{{$preference->id}}'// id de la preferencia
            },
            render: {
                container: '.cho-container',
                label: 'Abonar pago mensual',
            }
        });
    </script>

    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Mostrar m??s <i class=\"fas fa-chevron-down ms-2\"></i> ";
                moreText.style.display = "none";

                // agregar icono de arriba <i class="fas fa-chevron-down ms-2"></i>

            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Mostrar menos <i class=\"fas fa-chevron-up ms-2\"></i>";
                moreText.style.display = "inline";
            }
        }
    </script>



{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}

    </body>
</x-app-layout>


















