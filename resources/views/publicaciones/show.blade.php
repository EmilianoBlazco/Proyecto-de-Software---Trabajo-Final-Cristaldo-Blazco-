<x-app-layout>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css', 'resources/js/map.js', 'resources/js/bootstrap.js'])
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>


                {{--                <%--                agregar a favoritos y contacto--%>--}}
                <div class="d-flex mb-3">
{{--                    <div class="text-primary mr-2 ms-2 me-2">--}}
{{--                        <a href="#" class="btn btn-outline-primary btn-sm">Agregar a favoritos</a>--}}
{{--                    </div>--}}
                    <div class="text-primary mr-2 ms-2 me-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">Contactar</a>
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
                                <h6 class="font-weight-semi-bold ms-2 mb-0">{{$publicacion->banios_publicacion}} Baños</h6>
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

                <div class="col w-70 mt-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-semi-bold">Precio mensual</h5>
                            <div class="row align-items-start">
                                <h3 class="font-weight-semi-bold mb-4 col">$ {{ number_format($publicacion->precio_publicacion, 2, ',', '.')  }} ARS</h3>
                                {{--           -----------------ACÁ VA EL BOTÓN DE MERCADO PAGO-----------------------------------------------------------}}
                                <a href="#" class="btn btn-primary btn-block col">Solicitar Alquiler</a>
                                <div class="cho-container"></div>
                                {{--           -----------------ACÁ VA EL BOTÓN DE MERCADO PAGO-----------------------------------------------------------}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{--            Descripción de la publicación--}}
            <div class="row px-xl-5">
                <div class="col">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-semi-bold">Descripción</h5>
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

                                        {{--                                    Recorre el array de comodidades y muestra las que coincidan con la publicación--}}
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
                                {{--                                si el array tiene más de 5 comodidades, muestra el botón de ver más--}}
                                @if($publicacion->caracteristica_comodidades()->count() > 5)
                                    <button onclick="myFunction()" id="myBtn" class="btn btn-link text-decoration-none text-primary p-0 align-items-center justify-content-center ">Mostrar más<i class="fas fa-chevron-down ms-2"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--            Ubicación de la publicación--}}
            <div class="row px-xl-5">
                <div class="col">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="font-weight-semi-bold ms-2 mb-0 h6">Ubicación</h5>
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
                                                        <button type="button" class="btn btn-primary w-45" id="btn-ubicacion">Ver ubicación</button>
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

            {{--            Comentarios--}}
           @livewire('publicaciones.show-coments', ['publicacion' => $publicacion])
        </div>
    </div>


    @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = $publicacion->titulo_publicacion;
        $item->quantity = 1;
        $item->unit_price = $publicacion->precio_publicacion;
        $preference->items = array($item);

        //Manejo de las rutas cuando salen de la pagina de pago
        $preference->back_urls = array(
        "success" => route('publicaciones.pagar', $publicacion),
        "failure" => "http://www.tu-sitio/failure",
        "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->save();
    @endphp

    {{--    SDK MercadoPago.js V2--}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

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
                label: 'Pagar',
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
                btnText.innerHTML = "Mostrar más <i class=\"fas fa-chevron-down ms-2\"></i> ";
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


















