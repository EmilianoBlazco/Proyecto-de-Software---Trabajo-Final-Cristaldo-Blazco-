<x-app-layout>
    <x-slot name="title">Modificar una propiedad publicada</x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/validacionModificar.js', 'resources/js/modificarUbicacion.js', 'resources/css/dragAndDropImg.css', 'resources/js/EditDragAndDropImg.js'])

    <body>


    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://www.byverdleds.com/blog/wp-content/uploads/2019/08/LedSalon.jpg');">
        <span class="mask bg-gradient-dark opacity-5"></span>

        <div class="container my-auto mt-9">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="text-white">Modificar su propiedad</h1>
                </div>
            </div>
            <div class="card h-100 align-content-xxl-center mt-3">

                <div class="multisteps-form">
                    <!--progress bar-->
                    <div class="row mt-5">
                        <div class=" ml-auto mr-auto mb-4">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info" id="progresTipo">Tipo de Propiedad</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Address" id="progresUbicacion">Ubicación</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Order Info" id="progresCaracteristica">Características</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Comments" id="progresImagen">Encabezado de la publicación</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Comments" id="progresComodidad">Caracerísticas específicas</button>
                            </div>
                        </div>
                    </div>
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form class="multisteps-form__form" action="{{route('publicaciones.update', $publicacion)}}" method="POST" id="form" enctype="multipart/form-data">
                                @csrf @method('Patch')

                                <!--PANEL TIPO DE PROPIEDAD-->
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Tipo de Propiedad</h3>
                                    <div class="multisteps-form__content">

                                        <div class="form-row mt-4 shadow-none p-3 mb-5 bg-light rounded">
                                            <select class="multisteps-form__select form-control" name="tipo_propiedad" id="inputTipo">
                                                @foreach($tiposPropiedad as $tipoPropiedad)
                                                    <option value="{{$tipoPropiedad->id}}"
                                                            @if($tipoPropiedad->id == $publicacion->id_tipo_propiedad)
                                                                selected
                                                        @endif
                                                    >{{$tipoPropiedad->nombre_tipo_propiedad}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"  id="divTipo" ></div>

                                            {{--                                @error('tipo_propiedad')--}}
                                            {{--                                <small style="color:red">{{$message}}</small>--}}
                                            {{--                                @enderror--}}

                                        </div>
                                        <div>Los campos marcados con un <b>(*)</b> son obligatorios</div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>
                                </div>


                                <!--PANEL UBICACIÓN-->
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Direccion</h3>
                                    <div class="multisteps-form__content">


                                        <div class="form-row mt-4 shadow-none p-3 mb-5 bg-light rounded">
                                            <select class="multisteps-form__select form-control" name="provincia" id="inputProvincia">
                                                <option selected="selected" name="provincia">Seleccione la provincia</option>
                                                @foreach($provincias as $provincia)
                                                    <option value="{{$provincia->id}}"
                                                            @if($provincia->id == $publicacion->ciudad()->first()->provincia()->first()->id)
                                                                selected
                                                        @endif
                                                    >{{$provincia->nombre_provincia}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"  id="divProvincia" ></div>
                                        </div>

                                        <div class="form-row mt-4 shadow-none p-3 mb-5 bg-light rounded">
                                            <select class="multisteps-form__select form-control" name="ciudad" id="inputCiudad">
                                                <option selected="selected" name="ciudad">Seleccione la localidad</option>
                                                @foreach($ciudades as $ciudade)
                                                    <option value="{{$ciudade->id}}"
                                                            @if($ciudade->id == $publicacion->id_ciudad)
                                                                selected
                                                        @endif
                                                    >{{$ciudade->nombre_ciudad}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"  id="divCiudad" ></div>
                                        </div>
                                        <div>
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Calle (*)</label>
                                                <input class="form-control" name="calle" type="text" value="{{old('calle',$publicacion->calle_publicacion)}}" id="inputCalle">
                                            </div>
                                            <div class="text-danger"  id="divCalle" ></div>
                                        </div>

                                        {{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
                                        {{--                                            <div class="col">--}}
                                        {{--                                                <input class="form-control" name="calle" type="text" value="{{old('calle',$publicacion->calle_publicacion)}}">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Altura (*)</label>
                                                <input class="form-control" name="altura" type="number" value="{{old('altura',$publicacion->altura_publicacion)}}" id="inputAlturaPublicacion">
                                            </div>
                                            <div class="text-danger"  id="divAltura" ></div>
                                        </div>

                                        {{--                                        <div class="form-row mt-4 shadow-none p-3 mb-5 bg-light rounded">--}}
                                        {{--                                            <div class="col">--}}
                                        {{--                                                <input class="form-control" name="altura" type="number" placeholder="Altura" value="{{old('altura',$publicacion->altura_publicacion)}}">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}


                                    </div>

                                    <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                        <div class="col">

                                            <div id="map" style="width: 100%; height:450px"></div>

                                            <input type="hidden" id="latitud" name="latitud" value="{{old('latitud',$publicacion->latitud_publicacion)}}" />
                                            <input type="hidden" id="longitud" name="longitud" value="{{old('longitud',$publicacion->longitud_publicacion)}}" />
                                            <div class="text-danger"  id="divMapa" ></div>
                                        </div>
                                    </div>

                                    <div class="button-row d-flex mt-4 " >
                                        <div class="col">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                                        </div>
                                        <div class="col text-md-end">
                                            <button class="btn btn-primary js-btn-next " type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>
                                </div>


                                <!--PANEL CARACTERÍSTICAS-->
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Caracteristicas Generales</h3>
                                    <div class="multisteps-form__content">

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Ambientes</label>
                                                <input class="form-control" name="ambientes" type="number"  value="{{old('ambientes',$publicacion->ambientes_publicacion)}}" id="inputAmbiente">
                                            </div>
                                            <div class="text-danger"  id="divAmbiente" ></div>
                                        </div>

{{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
{{--                                            <div class="col">--}}
{{--                                                <input class="form-control" name="ambientes" type="number" placeholder="Ambientes" value="{{old('ambientes',$publicacion->ambientes_publicacion)}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Dormitorios</label>
                                                <input class="form-control" name="dormitorios" type="number"  value="{{old('dormitorios', $publicacion->dormitorios_publicacion)}}" id="inputDormitorio">
                                            </div>
                                            <div class="text-danger"  id="divDormitorio" ></div>
                                        </div>

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Baños</label>
                                                <input class="form-control" name="baños" type="number" value="{{old('baños', $publicacion->banios_publicacion)}}" id="inputBanio">
                                            </div>
                                            <div class="text-danger"  id="divBanio" ></div>
                                        </div>

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Cochera</label>
                                                <input class="form-control" name="cocheras" type="number" value="{{old('cocheras', $publicacion->cochera_publicacion)}}" id="inputCochera">
                                            </div>
                                            <div class="text-danger"  id="divCochera" ></div>
                                        </div>

{{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
{{--                                            <div class="col">--}}
{{--                                                <input class="form-control" name="cocheras" type="number" placeholder="Cocheras" value="{{old('cocheras', $publicacion->cochera_publicacion)}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Superficie cubierta (<b>m<sup>2</sup></b>)</label>
                                                <input class="form-control" name="cubierta" type="number"  value="{{old('cubierta', $publicacion->superficie_cubierta_casa)}}" id="inputSuperficieCubierta">
                                            </div>
                                            <div class="text-danger"  id="divSuperficieCubierta" ></div>
                                        </div>

{{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
{{--                                            <div class="col">--}}
{{--                                                <input class="form-control" name="cubierta" type="number" placeholder="Superficie cubierta" value="{{old('cubierta', $publicacion->superficie_cubierta_casa)}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Superficie total (<b>m<sup>2</sup></b>)</label>
                                                <input class="form-control" name="total_terreno" type="number"  value="{{old('total_terreno', $publicacion->superficie_total_terreno)}}" id="inputSuperficieTotal">
                                            </div>
                                            <div class="text-danger"  id="divSuperficieTotal" ></div>
                                        </div>

{{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
{{--                                            <div class="col">--}}
{{--                                                <input class="form-control" name="total_terreno" type="number" placeholder="Superficie total del terreno" value="{{old('total_terreno', $publicacion->superficie_total_terreno)}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Precio (*)</label>
                                                <input class="form-control" name="precio" type="number" value="{{old('precio', $publicacion->precio_publicacion)}}" id="inputPrecio">
                                            </div>
                                            <div class="text-danger"  id="divPrecio" ></div>
                                        </div>

{{--                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">--}}
{{--                                            <div class="col">--}}
{{--                                                <input class="form-control" name="precio" type="number" placeholder="Precio" value="{{old('precio', $publicacion->precio_publicacion)}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                    </div>

                                    <div class="button-row d-flex mt-4 " >
                                        <div class="col">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                                        </div>
                                        <div class="col text-md-end">
                                            <button class="btn btn-primary js-btn-next " type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>

                                </div>



                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Título y descripción de la propiedad</h3>
                                    <div class="multisteps-form__content">

{{--                                        <div class="mt-5">--}}
{{--                                            <div class="input-group input-group-outline my-3">--}}
{{--                                                <label class="form-label">Título (*)</label>--}}
{{--                                                value="{{old('precio', $publicacion->precio_publicacion)}}"--}}
{{--                                                <input class="form-control" name="titulo" type="text"  value="{{old('titulo', $publicacion->titulo_publicacion)}}" id="inputTitulo">--}}
{{--                                            </div>--}}
{{--                                            <div class="text-danger"  id="divTitulo" ></div>--}}
{{--                                        </div>--}}

                                        <div class="mt-5">
                                            <div class="input-group input-group-outline o my-3 is-focused">
                                                <label class="form-label">Título (*)</label>
                                                <input class="form-control" name="titulo" type="text"  value="{{old('titulo', $publicacion->titulo_publicacion)}}" id="inputTitulo">
                                            </div>
                                            <div class="text-danger"  id="divTitulo" ></div>
                                        </div>



                                        <div class="mt-5">
                                            <div class="input-group input-group-outline my-3 is-focused">
                                                <label class="form-label">Descripción de la publicación (*)</label>
                                                <textarea class="form-control" name="descripcion" id="inputDescripcion">{{old('descripcion', $publicacion->descripcion_publicacion)}}</textarea>
                                            </div>
                                            <div class="text-danger"  id="divDescripcion" ></div>
                                        </div>


                                        <h3 class="mt-4">Imagenes</h3>
                                        <div class="flex-container">
                                            <div class="drop-zone">

                                                <span class="drop-zone__prompt">
                                                    <h7 class="drop-zone__principal">Foto principal</h7><i class="fa-solid fa-upload fa-2x"></i> <br>
                                                    Arrastra la foto de la propiedad
                                                </span>
                                                <input type="file" name="file" class="drop-zone__input" id="input-file">
                                            </div>

                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt"><i class="fa-solid fa-upload fa-2x"></i> <br>
                                                    Arrastra la foto de la propiedad
                                                </span>
                                                <input type="file" name="file1" class="drop-zone__input" id="input-file-1" >
                                            </div>

                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt"><i class="fa-solid fa-upload fa-2x"></i> <br>
                                                    Arrastra la foto de la propiedad
                                                </span>
                                                <input type="file" name="file2" class="drop-zone__input" id="input-file-2">
                                            </div>

                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt"><i class="fa-solid fa-upload fa-2x"></i> <br>
                                                    Arrastra la foto de la propiedad
                                                </span>
                                                <input type="file" name="file3" class="drop-zone__input" id="input-file-3">
                                            </div>

                                            <div class="drop-zone">
                                                <span class="drop-zone__prompt"><i class="fa-solid fa-upload fa-2x"></i> <br>
                                                    Arrastra la foto de la propiedad
                                                </span>
                                                <input type="file" name="file4" class="drop-zone__input" id="input-file-4">
                                            </div>

                                        </div>


                                        <div class="text-danger" id="divImagenes"></div>
                                    </div>


                                            @foreach($imagenes as $imagen)
                                                @if($imagen->id_publicacion == $publicacion->id)
{{--                                                    <img src="{{asset($imagen->url_imagen)}}" alt="imagen" class="imagenesActuales">--}}
                                                    <img src="{{$imagen->url_imagen}}" alt="imagen" class="imagenesActuales">
                                                @endif
                                            @endforeach





                                    <div class="button-row d-flex mt-4 " >
                                        <div class="col">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                                        </div>
                                        <div class="col text-md-end">
                                            <button class="btn btn-primary js-btn-next " type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>

                                </div>



                                <!--PANEL IMAGENES-->
                               {{-- <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Fotos de la propiedad. Puede cargar hasta 5 imagenes</h3>
                                    <div class="multisteps-form__content">

                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                            <div class="col">
                                                <input class="form-control" name="titulo" type="text" placeholder="Titulo de la publicacion" value="{{old('titulo', $publicacion->titulo_publicacion)}}">
                                                @error('titulo')
                                                <small style="color:red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                            <div class="col">
                                                <textarea class="form-control" name="descripcion" placeholder="Descripcion de la publicacion">{{old('descripcion', $publicacion->descripcion_publicacion)}}</textarea>
                                                @error('descripcion')
                                                <small style="color:red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                            <div class="col">
                                                <input type="file" placeholder="Imagen"/>
                                            </div>
                                        </div>

                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                            <div class="col">
                                                <input type="file" placeholder="Imagen"/>
                                            </div>
                                        </div>

                                        <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                            <div class="col">
                                                <input type="file" placeholder="Imagen"/>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="button-row d-flex mt-4 " >
                                        <div class="col">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                                        </div>
                                        <div class="col text-md-end">
                                            <button class="btn btn-primary js-btn-next " type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>

                                </div>--}}


                                <!--single form panel-->

                                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                    <h3 class="multisteps-form__title">Comodidades</h3>
                                    <div class="multisteps-form__content">

                                        @foreach($comodidades as $comodidad)
                                            <div class="form-row mt-4  shadow-none p-3 mb-5 bg-light rounded">
                                                <h6 class="p-2" >{{$comodidad->nombre_comodidad}}</h6>
                                                @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                                                    <div class="col form-check-inline">
                                                        <input type="checkbox" name="caracteristicas[]" value="{{$caracteristica->id}}" id="{{$caracteristica->id}}" class="form-check-input"
                                                               @if($publicacion->caracteristica_comodidades->contains($caracteristica->id))
                                                                   checked
                                                            @endif
                                                        />
                                                        <label for="{{$caracteristica->id}}">{{$caracteristica->nombre_caracteristica_comodidad}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="button-row d-flex mt-4 " >
                                        <div class="col">
                                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Anterior</button>
                                        </div>
                                        <div class="col text-md-end">
                                            <button class="btn btn-success ml-auto" type="submit" title="Send">Enviar</button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>

{{--                <a href="{{route('publicaciones.index')}}">Regresar</a>--}}


            </div>

        </div>
    </div>


    </body>

    <script>
        $(document).ready(function () {
            $('#inputProvincia').select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#inputCiudad').select2();
        });
    </script>
</x-app-layout>
