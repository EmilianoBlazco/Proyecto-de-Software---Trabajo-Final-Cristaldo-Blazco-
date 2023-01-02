<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/nucleo-svg.css'])
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="page-header align-items-start min-vh-100 " style="background-image: url('https://www.byverdleds.com/blog/wp-content/uploads/2019/08/LedSalon.jpg')">
        <span class="mask bg-gradient-dark opacity-5"></span>

        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-7 col-md-10 mt-8">
                    <h1 class="text-white">Solicitudes Pendientes</h1>
                </div>
            </div>
            <div class="container mt-sm-5 mt-3">
                <div class="card h-100 align-content-xxl-center">
                    <div class="card">
                        <div class="row text-center py-2 mt-3">
                            <div class="col-4 mx-auto">
                                <div class="input-group input-group-dynamic mb-4">
                                    <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    <input class="form-control" placeholder="Buscar" type="text">
                                </div>
                                <div>
                                    <a href="{{route('dashboard')}}" class="btn btn-primary">Volver a la pagina principal</a>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Publicacion solicitada</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15 ps-2">Estado de solicitud</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Solicitante</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Fecha de solicitud</th>
{{--                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Tipo de contrato</th>--}}
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($solicitudes as $solicitud)
                                    <tr style="height:100px">
                                        <td>
{{--                                            @foreach($solicitudes as $solicitud)--}}
                                                @foreach($publicaciones as $publicacion)
                                                    @if($publicacion->id == $solicitud->id_publicacion)
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0">{{$publicacion->titulo_publicacion}}</h6>
                                                        </div>
                                                    @endif
                                                @endforeach
{{--                                            @endforeach--}}
                                        </td>
                                        <td>
{{--                                            @foreach($solicitudes as $solicitud)--}}
                                                    <div class="d-flex flex-column justify-content-center">
{{--                                                            @if($solicitud->estado_solicitud == 0)--}}
{{--                                                            <span class="badge bg-gradient-success">Pendiente</span>--}}
{{--                                                            @endif--}}
                                                        <span class="badge bg-gradient-success">{{$solicitud->estado_solicitud}}</span>

                                                    </div>
{{--                                            @endforeach--}}
                                        </td>
                                        <td>
{{--                                            @foreach($solicitudes as $solicitud)--}}
                                                @foreach($usuarios as $user)
                                                    @if($user->id == $solicitud->id_usuario)
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0">{{$user->name}}</h6>
                                                        </div>
                                                    @endif
                                                @endforeach
{{--                                            @endforeach--}}
                                        </td>
                                        <td>
{{--                                            @foreach($solicitudes as $solicitud)--}}
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0">{{$solicitud->created_at->format('d-m-Y')}}</h6>
                                                </div>
{{--                                            @endforeach--}}
                                        </td>
                                        <td
                                            class="align-middle text-center text-sm">
{{--                                            <a href="{{route('correos.update',$solicitud->id)}}" class="btn btn-success">Aceptar</a>--}}
                                            <form action="{{route('correos.update',$solicitud->id)}}" method="POST">
                                                @csrf
                                                @method('Patch')
                                                <button type="submit" class="btn btn-success">Aceptar</button>
                                            </form>
                                        </td>
                                        <td
                                            class="align-middle text-center text-sm">
{{--                                            <a href="#" class="btn btn-danger">Rechazar</a>--}}
                                            <form action="{{route('correos.update',$solicitud->id)}}" method="POST">
                                                @csrf
                                                @method('Patch')
                                                <button type="submit" class="btn btn-danger">Rechazar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach





{{--                                @foreach($publicaciones as $publicacion)--}}
{{--                                    <tr style="height:100px">--}}
{{--                                        <td>--}}
{{--                                                <div class="d-flex flex-column justify-content-center">--}}
{{--                                                    <h3 class="mb-0"><a href="{{route('publicaciones.show',$publicacion->id)}}"  target="_blank" title="{{$publicacion->titulo_publicacion}}">{{substr($publicacion->titulo_publicacion,0,17)}}@if(strlen($publicacion->titulo_publicacion)>17)...@endif--}}

{{--                                                        </a></h3>--}}
{{--                                                    <p class="text-1xl text-secondary mb-0 "><b>$ {{$publicacion->precio_publicacion}}</b></p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            Estado de solicitud--}}
{{--                                            @foreach($solicitudes as $solicitud)--}}
{{--                                                <div class="d-flex px-2 py-1">--}}
{{--                                                    <div>--}}
{{--                                                        <span class="badge bg-gradient-success">{{$solicitud->estado_solicitud}}</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}

{{--                                        </td>--}}
{{--                                        <td class="align-middle text-center">--}}
{{--                                            @if($publicacion->estado_publicacion == "Activo")--}}
{{--                                                <span class="badge bg-gradient-success">{{$publicacion->estado_publicacion}}</span>--}}
{{--                                            @else--}}
{{--                                                <span class="badge bg-gradient-warning">{{$publicacion->estado_publicacion}}</span>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        --}}{{--                                        <td class="align-middle text-center">--}}
{{--                                        --}}{{--                                            <span class="text-secondary text-xs font-weight-normal">420(Ver si implementar)</span>--}}
{{--                                        --}}{{--                                        </td>--}}
{{--                                        <td class="align-middle text-center">--}}
{{--                                            <span class="text-secondary text-xs font-weight-normal">{{$publicacion->created_at->format('d-m-Y')}}</span>--}}
{{--                                        </td>--}}
{{--                                        <td class="align-middle text-center">--}}
{{--                                            <span class="badge bg-gradient-success">XXXXX</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            @if($publicacion->estado_publicacion == "Activo")--}}
{{--                                                <a href="{{route('contratos.index')}}" class="fa fa-file-text-o" style="color: #4fa952" data-toggle="tooltip" title="Definir contrato"></a>--}}
{{--                                            @elseif($publicacion->estado_publicacion == "Alquilado")--}}
{{--                                                <a class="fa fa-file-text-o" style="color: red" data-toggle="tooltip" title="Definir contrato"></a>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td class="align-middle">--}}
{{--                                            --}}{{--                                            <a href="{{route('publicaciones.edit',$publicacion)}}:" class="fas fa-edit" data-toggle="tooltip" data-original-title="Editar"></a>--}}
{{--                                            @if($publicacion->estado_publicacion == "Activo")--}}
{{--                                                <a href="{{route('publicaciones.edit',$publicacion)}}" class="fas fa-edit" style="color: #4fa952" data-toggle="tooltip" title="Editar publicación"></a>--}}
{{--                                            @elseif($publicacion->estado_publicacion == "Alquilado")--}}
{{--                                                <a class="fas fa-edit" style="color: red" disabled data-toggle="tooltip" title="Editar publicación"></a>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td class="align-middle">--}}
{{--                                            @if($publicacion->estado_publicacion == "Activo")--}}
{{--                                                <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">--}}
{{--                                                    @csrf @method('DELETE')--}}
{{--                                                    <button type="submit" class="fa fa-house-damage" style="color: #4fa952" data-toggle="tooltip" title="Desactivar publicación"></button>--}}
{{--                                                </form>--}}
{{--                                            @elseif($publicacion->estado_publicacion == "Alquilado")--}}
{{--                                                <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">--}}
{{--                                                    @csrf @method('DELETE')--}}
{{--                                                    <button type="submit" class="fa fa-house-damage" style="color: red" disabled data-toggle="tooltip" title="Desactivar publicación"></button>--}}
{{--                                                </form>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}

{{--                                @endforeach--}}
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
</html>

@if(session('aceptar') == 'ok')
    <script>
        Swal.fire(
            'Aceptado!',
            'Se ha aceptado la solicitud y enviado un correo al usuario para notificarle.',
            'success'
        )
    </script>
@endif

@if(session('rechazar') == 'ok')
    <script>
        Swal.fire(
            'Rechazado!',
            'Se ha rechazado la solicitud y enviado un correo al usuario para notificarle.',
            'success'
        )
    </script>
@endif

{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--</head>--}}

{{--<body>--}}
{{--        <h1>Solicitud de Alquiler</h1>--}}
{{--                @dd($info)--}}
{{--                @dd($info);--}}
{{--        <p>Estimado(a) {{$info['propietario']}},</p>--}}
{{--        <p>Se ha realizado una solicitud de alquiler de la propiedad {{$info['titulo_pub']}}.</p>--}}
{{--        <p>--}}
{{--            Los datos del interesado son:--}}
{{--            <li>Nombre del usuario: {{$info['solicitante']}}</li>--}}
{{--            <li>Correo del usuario: {{$info['correo_soli']}}</li>--}}
{{--            Se los facilitamos con el fin de que pueda comunicarse con el/la misma en caso de ser necesario.--}}
{{--        </p>--}}
{{--        <p>--}}
{{--            En caso de no necesitar comunicarse con el mismo puede <b>Aceptar la solicitud<b>--}}
{{--                    <a href="{{route('publicaciones.show',$info['publicacion'],$info['propietario'])}}">Aceptar</a>--}}
{{--            <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--                @csrf--}}
{{--                           Enviar una variable con valor de aprobado --}}
{{--                <input type="hidden" name="estado" value="Aprobado">--}}
{{--                <input type="submit" class="" value="Activar boton de pago">--}}
{{--            </form>--}}
{{--            <br>O <b>Rechazar la solicitud</b>--}}
{{--            <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="negacion" value="denegado">--}}
{{--                <input type="submit" class="btn btn-primary btn-block col" value="Denegar solicitud">--}}
{{--            </form>--}}
{{--        </p>--}}
{{--        <p>Saludos cordiales.</p>--}}
{{--        <p>Equipo de Easy-Rent para servirlo.</p>--}}

{{--</body>--}}

{{--</html>--}}


{{--<x-guest-layout>--}}

{{--    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/nucleo-svg.css'])--}}
{{--    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>--}}
{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}


{{--    <x-slot name="title">Solicitud de Alquiler</x-slot>--}}

{{--    <body>--}}
{{--        <h1>Solicitud de Alquiler</h1>--}}
{{--        @dd($info)--}}
{{--        @dd($info);--}}
{{--        <p>Estimado(a) {{$info['propietario']}},</p>--}}
{{--        <p>Se ha realizado una solicitud de alquiler de la propiedad {{$info['titulo_pub']}}.</p>--}}
{{--        <p>Los datos del interesado son:--}}
{{--        <li>Nombre del usuario: {{$info['solicitante']}}</li>--}}
{{--        <li>Correo del usuario: {{$info['correo_soli']}}</li>--}}
{{--        Se los facilitamos con el fin de que pueda comunicarse con el/la misma en caso de ser necesario.--}}
{{--        </p>--}}
{{--        <p>--}}
{{--            En caso de no necesitar comunicarse con el mismo puede <b>Aceptar la solicitud<b>--}}
{{--        <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--            @csrf--}}
{{--            --}}{{--           Enviar una variable con valor de aprobado --}}
{{--            <input type="hidden" name="estado" value="Aprobado">--}}
{{--            <input type="submit" class="" value="Activar boton de pago">--}}
{{--        </form>--}}
{{--        <br>O <b>Rechazar la solicitud</b>--}}
{{--        <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="negacion" value="denegado">--}}
{{--            <input type="submit" class="btn btn-primary btn-block col" value="Denegar solicitud">--}}
{{--        </form>--}}
{{--        </p>--}}
{{--        <p>Saludos cordiales.</p>--}}
{{--        <p>Equipo de Easy-Rent para servirlo.</p>--}}
{{--    </body>--}}

{{--    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>--}}

{{--</x-guest-layout>--}}
