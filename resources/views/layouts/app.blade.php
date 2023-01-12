<!--Esta vista es para usuarios logueados -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$title ?? 'Easy-Rent'}}</title>

        <!-- Fonts -->
        <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/intro.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
              integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://kit.fontawesome.com/58ef7b5c70.js" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>

    <script>

        @if(session('registro') == 'ok')
            Swal.fire(
            'Registro completo!',
            'Ya puedes acceder a todas las funcionalidades de la plataforma.',
            'success'
            )
         @endif
        @if(session('registro') == 'no')
            Swal.fire(
            'Encuesta sin responder!',
            'Vemos que todavía no completaste todos tus datos.',
            'info'
            )
         @endif

        @if(session('deshabilitar') == 'ok')

                Swal.fire(
                'Deshabilitado!',
                'La publicación ha sido deshabilitada de manera exitosa.',
                'success',
                )

        @endif
    {{--    @else--}}
    {{--        <script>--}}
    {{--            Swal.fire(--}}
    {{--                'Error!',--}}
    {{--                'La publicación no pudo ser deshabilitada.',--}}
    {{--                'error',--}}
    {{--            )--}}
    {{--        </script>--}}
    {{--    @endif--}}

    @if(session('alquilado') == 'ok')

            Swal.fire(
                'Alquilado!',
                'Ya puede acceder a la comodidad de su nuevo hogar.',
                'success'
            )

    @elseif(session('pendiente') == 'pend')
            Swal.fire(
                'Pendiente!',
                'Su pago esta pendiente a ser aprobado.',
                'warning'
            )
    @elseif(session('rechazado') == 'rej')
            Swal.fire(
                'Rechazado!',
                'Su pago fue rechazo. Por favor intente por otro medio de pago.',
                'Error'
            )
    @endif

    @if(session('restaurar') == 'ok')
            Swal.fire(
                'Restaurado!',
                'La publicación ha sido restaurada de manera exitosa.',
                'success'
            )
    @endif
    {{--    @else--}}
    {{--        <script>--}}
    {{--            Swal.fire(--}}
    {{--                'Error!',--}}
    {{--                'La publicación no pudo ser restaurada.',--}}
    {{--                'error'--}}
    {{--            )--}}
    {{--        </script>--}}
    {{--    @endif--}}

    @if(session('modificar') == 'ok')
            Swal.fire(
                'Modificado!',
                'Los cambios fueron aplicados de manera exitosa.',
                'success'
            )
    @endif
    {{--    @else--}}
    {{--        <script>--}}
    {{--            Swal.fire(--}}
    {{--                'Error!',--}}
    {{--                'Los cambios no pudieron ser aplicados.',--}}
    {{--                'error'--}}
    {{--            )--}}
    {{--        </script>--}}
    {{--    @endif--}}

    @if(session('creacion') == 'ok')
            Swal.fire(
                'Publicado!',
                'Se publico de manera exitosa su alquiler.',
                'success'
            )
    @endif
    {{--    @else--}}
    {{--        <script>--}}
    {{--            Swal.fire(--}}
    {{--                'Error!',--}}
    {{--                'No se pudo publicar su alquiler.',--}}
    {{--                'error'--}}
    {{--            )--}}
    {{--        </script>--}}
    {{--    @endif--}}

        $('.formulariodeshabilitar').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro que deseas deshabilitar la publicacion?',
                text: "Puedes volver a habilitarla en cualquier momento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, deshabilitar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

</html>
