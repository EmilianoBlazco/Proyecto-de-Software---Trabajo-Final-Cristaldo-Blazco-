<x-app-layout>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/nucleo-svg.css'])
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <x-slot name="title">Comentarios</x-slot>

    <body>

    <h1>Comentarios</h1>

    @foreach($comentarios as $comentario)
        {{$comentario->comentario}}
    @endforeach

    </body>

</x-app-layout>
