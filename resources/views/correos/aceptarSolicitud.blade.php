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

        <h1>Respuesta a solicitud de alquiler</h1>

        <p>Estimado(a) {{$info['solicitante']}},</p>
        <p>
            La solicitud de alquiler de la propiedad <b>{{$info['titulo_pub']}}</b> ha sido <b>Aceptada!!!</b>.
        </p>
        <p>
            En breves momentos se le habilitara la disponibilidad de la propiedad para que pueda realizar el pago desde la plataforma.
            Para hacerlo debe dirigirse a la seccion de <b>alquileres</b> y seleccionar la publicacion para la cual realizo la solicitud.
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
