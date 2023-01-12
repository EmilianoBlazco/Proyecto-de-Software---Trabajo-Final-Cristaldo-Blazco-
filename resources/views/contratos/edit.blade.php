<x-app-layout>

    <x-slot name="title">Crear Contrato</x-slot>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/material-kit.js'])

    <body>

    <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('img/close-up-of-businessman-holding-pen.jpg') }}'); width: auto;">
        <span class="mask bg-gradient-dark opacity-5"></span>

        <div class="container my-auto mt-9">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="text-white">Modifique su contrato</h1>
                </div>
            </div>
            <div class="card h-100 align-content-xxl-center mt-3">

                {{--                    formulario multistep--}}
                <div class="multisteps-form">
                    <!--progress bar-->
                    <div class="row mt-5">
                        <div class=" ml-auto mr-auto mb-4">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info"
                                        id="progresTipo">Datos Iniciales
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Address"
                                        id="progresUbicacion">Pago del alquiler
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                        id="progresImagen">Limites de pagos
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Comments"
                                        id="progresComodidad">Otras condiciones
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form" action="{{route('contratos.update',$contrato)}}" method="POST"
                              enctype="multipart/form-data" id="form">
                            @csrf
                            @method('Patch')

                            {{--1/4--}}
                            <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active"
                                 data-animation="scaleIn">
                                <h4 class="multisteps-form__title">Seleccione la publicacion y el usuario para el cual quiera crear el contrato</h4>
                                <div class="multisteps-form__content">

                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused mt-3">
                                            <label class="form-label">Nombre de la publicacion seleccionada</label>
                                            <input class="form-control" type="text" disabled  value="{{$publicaciones->titulo_publicacion}}"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused mt-3">
                                            <label class="form-label">Nombre del usuario seleccionado</label>
                                            <input class="form-control" type="text" disabled  value="{{$inquilino->name}}"/>
                                        </div>
                                    </div>

                                    <h4 class="multisteps-form__title">¿En que fecha se dara inicio al contrato?, y ¿Hasta qué fecha? </h4>

                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Fecha de celebración</label>
                                            <input class="form-control" name="celebracion" type="date"
                                                   value="{{date('Y-m-d', strtotime($contrato->fecha_inicio_contrato))}}" id="inputCelebracion">

{{--                                            old('celebracion',--}}
                                        </div>
                                        <div class="text-danger" id="divCelebracion"></div>
                                    </div>

                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Fecha de finalización</label>
                                            <input class="form-control" name="vencimiento" type="date"
                                                   value="{{date('Y-m-d', strtotime($contrato->fecha_vencimiento_contrato))}}" id="inputVencimiento">
                                        </div>
                                        <div class="text-danger" id="divVencimiento"></div>
                                    </div>

                                    <div class="button-row d-flex mt-4">
                                        <button class="btn btn-primary ml-auto js-btn-next" type="button"
                                                title="Next">Siguiente
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{--2/4--}}
                            <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                 data-animation="scaleIn">
                                <h4 class="multisteps-form__title">¿En que intervalo de dias del mes el alquiler podra ser abonado sin recargos?</h4>
                                <p class="text-center my-1 bg-yellow-100 text-grey">Se tendra en cuenta el precio establecido en la publicacion seleccionada en paso 1 del formulario</p>
                                <div class="multisteps-form__content">

                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Fecha incial de pago (dias)</label>
                                            <input class="form-control" name="fechaInicio" type="number" min="1" max="31"
                                                   value="{{old('fechaInicio',$contrato->fecha_inicial_pago_contrato)}}" id="inputFechaInicio">
                                        </div>
                                        <div class="text-danger" id="divFechaInicio"></div>
                                    </div>
                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Fecha limite de pago (dias)</label>
                                            <input class="form-control" name="fechaFin" type="number" min="1" max="31"
                                                   value="{{old('fechaFin',$contrato->fecha_final_pago_contrato)}}" id="inputFechaFin">
                                        </div>
                                        <div class="text-danger" id="divFechaFin"></div>
                                    </div>

                                    <h4 class="multisteps-form__title">¿Cual sera el procentaje de recargo por incumplimiento de plazo?</h4>

                                    <div>
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Porcentaje de recargo</label>
                                            <input class="form-control" name="recargoDias" type="number" min="0" max="100"
                                                   value="{{old('recargoDias',$contrato->porcentaje_aumento_contrato_restraso)}}" id="inputRecargoDias">
                                        </div>
                                        <div class="text-danger" id="divRecargoDias"></div>
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

                            {{--       3/4--}}
                            <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                 data-animation="scaleIn">
                                <h4 class="multisteps-form__title">¿Cada cuantos meses se realiza el aumento al precio del alquiler?</h4>
                                <div class="multisteps-form__content">

                                    <div> {{-- class="mt-5" --}}
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Meses</label>
                                            <input class="form-control" name="meses" type="number" min="1" max="12"
                                                   value="{{old('meses',$contrato->periodo_aumento_contrato)}}" id="inputMeses">
                                        </div>
                                        <div class="text-danger" id="divMeses"></div>
                                    </div>

                                    <h4 class="multisteps-form__title">¿Cual es el porcentaje en que aumentara al precio del alquiler?</h4>

                                    <div> {{-- class="mt-5" --}}
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Porcentaje de recargo</label>
                                            <input class="form-control" name="recargoMeses" type="number" min="0" max="100"
                                                   value="{{old('recargoMeses',$contrato->porcentaje_aumento_contrato)}}" id="inputRecargoMeses">
                                        </div>
                                        <div class="text-danger" id="divRecargoMeses"></div>
                                    </div>

                                    <h4 class="multisteps-form__title">¿Cuantas cuatos se puede retrasar el inquilino antes de avisar del desalojo?</h4>

                                    <div> {{-- class="mt-5" --}}
                                        <div class="input-group input-group-outline my-3 o is-focused">
                                            <label class="form-label">Cantidad de cuotas</label>
                                            <input class="form-control" name="cuotas" type="number" min="1" max="12"
                                                   value="{{old('cuotas',$contrato->retraso_maximo_pago_contrato)}}" id="inputCuotas">
                                        </div>
                                        <div class="text-danger" id="divCuotas"></div>
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

                            {{--      4/4 --}}

                            <div class="multisteps-form__panel shadow p-4 rounded bg-white"
                                 data-animation="scaleIn">
                                <h4 class="multisteps-form__title">Aqui puede escribir otros terminos y condiciones que tendra el contrato</h4>
                                <div class="multisteps-form__content">

                                    <div class="mt-3">
                                        <div class="input-group input-group-outline my-3 is-focused">
            {{--                                <label class="form-label">Descripción de la publicación (*)</label>--}}
                                            <textarea class="form-control" name="condiciones" id="inputCondiciones">
                                                {{old('condiciones',$contrato->descripcion_contrato)}}</textarea>
                                        </div>
                                        <div class="text-danger" id="divCondiciones"></div>
                                    </div>

                                    <div class="row my-2">
                                        <h6 class="text-center mx-2" >Ejemplo de carga de terminos y condiciones extras</h6>
                                        <p class="text-info text-sm my-1 bg-yellow-100 text-grey">
                                            (1) <b>Debe</b> utilizar <b>numeros</b> para iniciar cada condicion, <b>seguida de un punto(3.)</b>, luego escribir la condicion.
                                            <br>
                                            (2) <b>Debe</b> colocar un <b>punto(.) final</b> para cada terminar cada condicion.
                                        </p>
                                        <div class="form-group">
                                            <div class="form-control">
                                                <textarea class="w-full" disabled placeholder="1.Este contrato se firmara por un plazo de 12 meses, a partir de la fecha de firma del mismo." ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="button-row d-flex mt-4 ">
                                    <div class="col">
                                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">
                                            Anterior
                                        </button>
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

        </div>
    </div>

    </body>

    <script>
        $(document).ready(function () {
            $('#inputPub').select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#inputInq').select2();
        });
    </script>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#inputMeses').on('input', function () {--}}
{{--                if ($(this).val() > 12) {--}}
{{--                    $(this).val(12);--}}
{{--                }--}}
{{--            });--}}
{{--            $('#inputRecargoMeses').on('input', function () {--}}
{{--                if ($(this).val() > 100) {--}}
{{--                    $(this).val(100);--}}
{{--                }--}}
{{--            });--}}
{{--            $('#inputCuotas').on('input', function () {--}}
{{--                if ($(this).val() > 12) {--}}
{{--                    $(this).val(12);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

</x-app-layout>
