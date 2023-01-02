<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
        <h1>Solicitud de Alquiler</h1>
        {{--        @dd($info)--}}
        {{--        @dd($info);--}}
        <p>Estimado(a) {{$info['propietario']}},</p>
        <p>Se ha realizado una solicitud de alquiler de la propiedad {{$info['titulo_pub']}}.</p>
        <p>
            Los datos del interesado son:
            <li>Nombre del usuario: {{$info['solicitante']}}</li>
            <li>Correo del usuario: {{$info['correo_soli']}}</li>
            Se lo facilitamos con el fin de que pueda:
            <li>Comunicarse con el/la solicitante en caso de ser necesario</li>
            <li>Busque de manera mas eficiente la solicitud dentro de su lista solicitudes pendientes.</li>
        </p>
        <p>
            En caso de no necesitar comunicarse con el mismo puede ver la solicitud en la plataforma usando el siguiente enlace:
{{--            <b>Aceptar la solicitud<b>--}}
                    <a href="{{route('correos.index')}}">Consultar solicitud</a>
{{--        <form action="{{route('correos.index')}}" method="Get">--}}
{{--          Enviar el id de la publicacion  --}}
{{--            <input type="hidden" name="id_publicacion" value="{{$info['publicacion']}}">--}}
{{--            <input type="hidden" name="id_solicitante" value="{{$info['id_solicitante']}}">--}}
{{--            <input type="submit" value="Consultar solicitud">--}}
{{--        </form>--}}
{{--            <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--                @csrf--}}
{{--                --}}{{--           Enviar una variable con valor de aprobado --}}
{{--                <input type="hidden" name="estado" value="Aprobado">--}}
{{--                <input type="submit" class="" value="Activar boton de pago">--}}
{{--            </form>--}}
{{--            <br>O <b>Rechazar la solicitud</b>--}}
{{--            <form action="{{route('publicaciones.show',$info['publicacion'])}}" method="Get">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="negacion" value="denegado">--}}
{{--                <input type="submit" class="btn btn-primary btn-block col" value="Denegar solicitud">--}}
{{--            </form>--}}
        </p>
        <p>Saludos cordiales.</p>
        <p>Equipo de Easy-Rent para servirlo.</p>

</body>

</html>


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
