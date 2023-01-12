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

         <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('img/close-up-of-businessman-holding-pen.jpg') }}'); width: auto;">
{{--    <div class="container-fluid ">--}}
{{--        <div class="row px-xl-5">--}}

            <div class="col-lg-13 m-8 mt-7" style="align-items: center;">

                <div class="row px-xl-5">
                    <div class="col mt-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="font-weight-semi-bold text-center mb-3">Contrato de locación para la publicación "{{$publicacion->titulo_publicacion}}"</h5>
                                <p class="text-muted">
                                    En la localidad de <b>{{$ciudad->nombre_ciudad}}</b>, <b>{{$provincia->nombre_provincia}}</b>, <b>República Argentina</b>, a los <b>{{trans(date('j', strtotime($contrato->fecha_inicio_contrato)))}}</b> dias del mes de <b>__{{$fecha = date('F', strtotime($contrato->fecha_inicio_contrato))}}</b> del año <b>{{$fecha = date('Y', strtotime($contrato->fecha_inicio_contrato))}}</b>.
                                    Entre los que se suscriben, por una parte, <b>{{$propietario->name}}</b>, con domicilio en la calle <b>{{$datospropietario->domicilio_calle}} {{$datospropietario->domicilio_altura}}</b>, de la ciudad de <b>{{$ciudadpropietario->nombre_ciudad}}, {{$provinciapropietario->nombre_provincia}}</b>,
                                    República Argentina, identificado con DNI: <b>{{$datospropietario->dni}}</b>, CUIL:<b>{{$datospropietario->cuit}}</b> con carácter de LOCADOR.
                                    Por otra parte,<b>{{$inquilino->name}}</b> ,con domicilio en la calle <b>{{$datosinquilino->domicilio_calle}} {{$datosinquilino->domicilio_altura}}</b>, de la ciudad de <b>{{$ciudadinquilino->nombre_ciudad}}, {{$provinciainquilino->nombre_provincia}}</b>,
                                    República Argentina, identificado con DNI: <b>{{$datosinquilino->dni}}</b>, CUIL: <b>{{$datosinquilino->cuit}}</b>; en carácter de LOCATARIO, que se regirán bajo las cláusulas y condiciones siguientes:
                                </p>
                                <p class="bg-yellow-100">
                                    <b>Aclaración</b>: Las condiciones posteriormente nombras desde la Clausula Primera hasta Clausula Cuarta son condiciones establecidas por la plataforma.
                                    En caso de existencia de otra condición definida por el LOCADOR, quedará invalidada la condición definida por la plataforma a la cual se le dara prioridad.
                                </p>
                                <h5 class="font-weight-semi-bold">CLAUSULA PRIMERA:</h5>
                                <p class="text-muted">
                                    El LOCADOR, en calidad de propietario alquilará al LOCATARIO, en calidad de inquilino, el inmueble ubicado en calle <b>{{$publicacion->calle_publicacion}}</b>, altura <b>{{$publicacion->altura_publicacion}}</b>.
                                    El cual toma la denominación <b>{{strtoupper($tipoPropiedad->nombre_tipo_propiedad)}}</b>, y la cual guarda relación a la publicación <b>"{{$publicacion->titulo_publicacion}}"</b> realizada en la plataforma Easy-Rent donde se realizó la misma.
                                    Dicha/o <b>{{strtoupper($tipoPropiedad->nombre_tipo_propiedad)}}</b> consta de las siguientes características:
                                    <ul class="list-unstyled">
                                        {{--                                    Recorre el array de comodidades y muestra las que coincidan con la publicación--}}
                                        @foreach($publicacion->caracteristica_comodidades()->get() as $comodidad)
                                            <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>{{$comodidad->nombre_caracteristica_comodidad}}</li>
                                        @endforeach
                                    </ul>
                                </p>

                                <h5 class="font-weight-semi-bold">CLAUSULA SEGUNDA:</h5>
                                <p class="text-muted">
{{--                                    --}}
                                    Este contrato se celebra por una duración de <b>{{$diferencia_num}}({{trim($diferencia_letra)}})</b> meses,
                                    comenzando desde el dia <b>{{$fecha = date('r', strtotime($contrato->fecha_inicio_contrato))}}</b> hasta el dia (Dia de vencimiento del contrato)($contrato->fecha_vencimiento_contrato);
                                    ambas partes quedan perfectamente entendidas, que el LOCATARIO debera entregar el inmueble al vencimiento del plazo establecido; libre de ocupantes y en perfecto estado.
                                </p>

                                <h5 class="font-weight-semi-bold">CLAUSULA TERCERA:</h5>
                                <p class="text-muted">
                                   El precio de la locación se establece y detalla de la siguiente manera:
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>El precio total de la locación es de <b>${{12 * $contrato->monto_contrato}}({{trim($valor_total)}})</b> Pesos Argentinos.</li>
                                    </ul>
                                    El cual sera abonado siguiendo las próximas pautas:
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>Del mes <b>1(uno)</b> al mes <b>{{$contrato->periodo_aumento_contrato}}({{trim($periodo_aumento)}})</b> se abonaran <b>${{$contrato->monto_contrato}}({{trim($monto_original)}})</b> Pesos Argentinos.</li>
                                        <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>Pasado el periodo especificado se realizará un aumento del precio del <b><b>{{$contrato->porcentaje_aumento_contrato}}</b>%</b>, el cual será aplicado cada <b>{{$contrato->periodo_aumento_contrato}}({{trim($monto_aumento)}})</b> meses, hasta la finalización del contrato.</li>
                                        <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>El abono del pago se debera realizar cada mes en lapso del dia <b>{{$contrato->fecha_inicial_pago_contrato}}({{trim($fecha_inicio)}})</b> al dia <b>{{$contrato->fecha_final_pago_contrato}}({{trim($fecha_final)}})</b>.</li>
                                        <li class="mb-2"><i class="fas fa-check text-primary mr-2"></i>En caso de no cumplir el periodo de tiempo especificado, se realizará un recargo adicional del <b>{{$contrato->porcentaje_aumento_contrato_restraso}}%</b> por demora al precio actual que se esté abonando en ese mes.</li>
                                    </ul>
                                </p>

                                <h5 class="font-weight-semi-bold">CLAUSULA CUARTA:</h5>
                                <p class="text-muted">
                                    Se establece que el LOCATARIO debera mantener una conducta correcta y respetuosa con el inmueble, y con los vecinos del mismo.
                                    Quedando prohibido realizar ruidos que puedan llegar a considerarse como molestos en horarios de descanso.
                                    Debera mantener el orden y la limpieza del inmueble.
                                    Quedando prohibido realizar fiestas o reuniones en el inmueble, sin previa autorización del LOCADOR.
                                    No deberá poseer/almacenar en su propiedad por ningún motivo armas de fuego, explosivos, sustancias tóxicas, inflamables o cualquier otro elemento que pueda poner en peligro la integridad física de las personas o el inmueble.
                                </p>

                                <img src=" @foreach($imagenes as $imagen) @if($imagen->id_publicacion == $publicacion->id) {{asset($imagen->url_imagen)}} @break @endif @endforeach" class="card-img-bottom" alt="...">

                                <div class="d-flex justify-content-center mt-5">
                                    @if(Auth::user()->hasRole('inquilino'))
                                        @if($contrato->confirmacion_inquilino == 0)
                                            <form action="{{route('contratos.update',$contrato)}}" method="POST">
                                                @csrf
                                                @method('Patch')
                                                <input type="hidden" name="bandera" value="flag">
                                                <button type="submit" class="btn btn-danger mx-auto">Aceptar Contrato</button>
                                            </form>
                                        @elseif($contrato->confirmacion_inquilino == 1)
                                            <div class="alert alert-default-success bg-gray-200" role="alert">
                                                <h4 class="alert-heading text-success text-center">Contrato Aceptado</h4>
                                                <p class="text-center">Ya has aceptado los términos y condiciones del contrato</p>
                                                <p class="text-center">Disfrute de su nueva hogar gracias al equipo de Easy-Rent <b>:D</b></p>
                                                <p>Ahora debe dirigirse a la publicación(<a class="text-info" href="{{route('publicaciones.show',$publicacion)}}">{{$publicacion->titulo_publicacion}}</a>)
                                                    para realizar el primer pago de su nuevo alquiler<b>:D</b></p>
                                            </div>
                                        @endif
                                    @elseif(Auth::user()->hasRole('propietario'))
                                           @if($contrato->confirmacion_inquilino == 0)
                                                <div class="alert alert-default-info bg-gray-200" role="alert">
                                                    <h4 class="alert-heading text-warning text-center">Esperando confirmación</h4>
                                                    <p>Debe aguardar hasta que el futuro inquilino revise los términos y condiciones del contrato y acepte las mismas</p>
                                                    <p>El periodo de espera esta activo <b>Desde: </b>{{$contrato->first()->created_at->format('d-m-Y')}} <b>Hasta: </b>{{$contrato->first()->created_at->addDays(5)->format('d-m-Y')}}</p>
                                                    <p>En caso de no recibir confirmación se dara de baja el contrato de manera automática</p>
                                                </div>
                                           @elseif($contrato->confirmacion_inquilino == 1)
                                                <div class="alert alert-default-success bg-gray-200" role="alert">
                                                    <h4 class="alert-heading text-success text-center">Contrato Aceptado</h4>
                                                    <p>El inquilino ha aceptado los términos y condiciones del contrato</p>
                                                    <p>Disfrute de su nueva relación Propietario-Inquilino <b>:D</b></p>
                                                    <p>Presione <a class="text-info" href="{{route('publicaciones.index')}}">aquí</a> si desea volver a sus publicaciones realizadas</p>
                                                </div>
                                           @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

{{--        </div>--}}
{{--    </div>--}}

    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

    </body>
</x-app-layout>


















