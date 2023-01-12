<x-app-layout>

    <x-slot name="title">Datos Usuarios</x-slot>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/material-kit.js','resources/js/validacionCrear.js','resources/js/crearUbicacion.js', 'resources/css/dragAndDropImg.css', 'resources/js/CreateDragAndDropImg.js'])


    <body>

    <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('img/bgdep2.jpg') }}');">
        <span class="mask bg-gradient-dark opacity-5"></span>

        <div class="container my-auto mt-9">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="text-white">Para conocernos mejor</h1>
                </div>
            </div>
            <div class="card h-100 align-content-xxl-center mt-3">

                <section>
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                                <h3 class="text-center">Bienvenido de nuevo {{$usuario->name}}</h3>
{{--                                <div class="bg-green-">--}}
                                    <p class="lead mb-0 text-center m-4">
                                        Una vez que hayas completado este apartado por primera vez,
                                        podrás consultarlo las veces que quieras y también cambiar algún dato si es necesario.
                                        <br>
                                        Esperamos que tu estadía en la plataforma sea agradable.
                                    </p>
{{--                                </div>--}}
                                <form role="form" id="data-form" action="{{route('datosExtraUsuarios.update',$datosExtraUsuarios)}}" method="POST" autocomplete="off" >
                                    @csrf
                                    @method('Patch')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-dynamic mb-4 o is-focused">
                                                    <label class="form-label">D.N.I <b>(sin puntos)</b></label>
                                                    <input class="form-control" type="number" min="9999999" max="99999999" name="dni" id="inputDNI" value="{{old('dni', $datosExtraUsuarios->dni)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-2">
                                                <div class="input-group input-group-dynamic o is-focused">
                                                    <label class="form-label">CUIT <b>(sin guiones, ni puntos)</b></label>
                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT" value="{{old('cuit', $datosExtraUsuarios->cuit)}}">
{{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
{{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
{{--                                            <div class="input-group input-group-dynamic">--}}
{{--                                            <div class="form-row shadow-none p-2 mb-5 bg-light rounded mt-5">--}}
                                                <select class="multisteps-form__select form-control" name="provincia_dom" id="inputProvincia">
                                                    <option value="">Seleccione la provincia donde se encuentra el domicilio donde vive actualmente</option>
                                                    @foreach($provincias as $provincia)
                                                        <option value="{{$provincia->id}}"
                                                                @if($provincia->id == $datosExtraUsuarios->ciudad()->first()->provincia()->first()->id)
                                                                    selected
                                                            @endif
                                                        >{{$provincia->nombre_provincia}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="divProvincia"></div>
{{--                                            </div>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="mb-4">
{{--                                            <div class="input-group input-group-dynamic">--}}
{{--                                            <div class="form-row shadow-none p-2 mb-5 bg-light rounded mt-5">--}}
                                                <select class="multisteps-form__select form-control" name="ciudad_dom" id="inputCiudad">
                                                    <option value="" name="ciudad">Seleccione la localidad donde se encuentra el domicilio donde vive actualmente</option>
                                                    @foreach($ciudades as $ciudade)
                                                        <option value="{{$ciudade->id}}"
                                                                @if($ciudade->id == $datosExtraUsuarios->id_ciudad)
                                                                    selected
                                                            @endif
                                                        >{{$ciudade->nombre_ciudad}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="divCiudad"></div>
{{--                                            </div>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 ps-2">
                                                <div class="input-group input-group-dynamic o is-focused">
                                                    <label class="form-label">Calle</label>
                                                    <input type="text" class="form-control" name="calle_dom" id="inputCUIT" value="{{old('calle_dom', $datosExtraUsuarios->domicilio_calle)}}">
                                                    {{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
                                                    {{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-2">
                                                <div class="input-group input-group-dynamic o is-focused">
                                                    <label class="form-label">Altura/Numero de calle</label>
                                                    <input type="number" class="form-control" name="altura_dom" id="inputCUIT" value="{{old('altura_dom', $datosExtraUsuarios->domicilio_altura)}}">
                                                    {{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
                                                    {{--                                                    <input type="number" class="form-control" name="cuit" id="inputCUIT">--}}
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="input-group mb-4 input-group-static">--}}
{{--                                            <label>Your message</label>--}}
{{--                                            <textarea name="message" class="form-control" id="message" rows="4"></textarea>--}}
{{--                                        </div>--}}
                                        <div class="row mt-5">
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="form-check form-switch mb-4 d-flex align-items-center">--}}
{{--                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">--}}
{{--                                                    <label class="form-check-label ms-3 mb-0" for="flexSwitchCheckDefault">I agree to the <a href="javascript:;" class="text-dark"><u>Terms and Conditions</u></a>.</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-12">
                                                <button type="submit" class="btn bg-gradient-dark w-100">Actualizar datos</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

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
