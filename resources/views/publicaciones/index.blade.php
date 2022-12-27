<x-app-layout>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/nucleo-svg.css'])
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <x-slot name="title">Registrar Propiedad</x-slot>

    <body>

    <div class="page-header align-items-start min-vh-100 " style="background-image: url('https://www.byverdleds.com/blog/wp-content/uploads/2019/08/LedSalon.jpg')">
        <span class="mask bg-gradient-dark opacity-5"></span>

        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-7 col-md-10 mt-8">
                    <h1 class="text-white">Consulte sus propiedades</h1>
                </div>
            </div>
            <div class="container mt-sm-5 mt-3">
                <div class="card h-100 align-content-xxl-center">
                    <div class="card">
                        <div class="row text-center py-2 mt-3">
                            <div class="col-4 mx-auto">
                                <div class="input-group input-group-dynamic mb-4">
                                    <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    <input class="form-control" placeholder="Buscar" type="text" >
                                </div>
                                <div>
                                    <a href="{{route('publicaciones.create')}}" class="btn btn-primary">Publicar una nueva propiedad</a>
                                </div>
                            </div>
                        </div>


                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Publicacion</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15 ps-2">Tipo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Fecha de publicacion</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Tipo de contrato</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($publicaciones as $publicacion)
                                    <tr style="height:100px">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="">
                                                    <img src="
                                                    @foreach($imagenes as $imagen)
                                                    @if($imagen->id_publicacion == $publicacion->id)
                                                        {{asset($imagen->url_imagen)}}
                                                        @break
                                                    @endif
                                                    @endforeach"
                                                    class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h3 class="mb-0"><a href="{{route('publicaciones.show',$publicacion->id)}}"  target="_blank" title="{{$publicacion->titulo_publicacion}}">{{substr($publicacion->titulo_publicacion,0,17)}}@if(strlen($publicacion->titulo_publicacion)>17)...@endif

                                                        </a></h3>
                                                    <p class="text-1xl text-secondary mb-0 "><b>$ {{$publicacion->precio_publicacion}}</b></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @foreach($tiposPropiedades as $tipo)
                                                @if($tipo->id == $publicacion->id_tipo_propiedad)
                                                    <p class="text-xs font-weight-bold mb-0">{{$tipo->nombre_tipo_propiedad}}</p>
                                                @endif
                                            @endforeach

                                        </td>
                                        <td class="align-middle text-center">
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <span class="badge bg-gradient-success">{{$publicacion->estado_publicacion}}</span>
                                            @else
                                                <span class="badge bg-gradient-warning">{{$publicacion->estado_publicacion}}</span>
                                            @endif
                                        </td>
{{--                                        <td class="align-middle text-center">--}}
{{--                                            <span class="text-secondary text-xs font-weight-normal">420(Ver si implementar)</span>--}}
{{--                                        </td>--}}
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-normal">{{$publicacion->created_at->format('d-m-Y')}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge bg-gradient-success">XXXXX</span>
                                        </td>
                                        <td>
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <a href="{{route('contratos.index')}}" class="fa fa-file-text-o" style="color: #4fa952" data-toggle="tooltip" title="Definir contrato"></a>
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                <a class="fa fa-file-text-o" style="color: red" data-toggle="tooltip" title="Definir contrato"></a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
{{--                                            <a href="{{route('publicaciones.edit',$publicacion)}}:" class="fas fa-edit" data-toggle="tooltip" data-original-title="Editar"></a>--}}
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <a href="{{route('publicaciones.edit',$publicacion)}}" class="fas fa-edit" style="color: #4fa952" data-toggle="tooltip" title="Editar publicación"></a>
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                <a class="fas fa-edit" style="color: red" disabled data-toggle="tooltip" title="Editar publicación"></a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="fa fa-house-damage" style="color: #4fa952" data-toggle="tooltip" title="Desactivar publicación"></button>
                                                </form>
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="fa fa-house-damage" style="color: red" disabled data-toggle="tooltip" title="Desactivar publicación"></button>
                                                </form>
                                            @endif
                                    </tr>

                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

{{--    <script> src="{{asset('js/app.js')}}"></script>--}}
{{--    <script src="{{asset('js/jquery.min.js')}}"></script>--}}
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>




@if(session('deshabilitar') == 'ok')
        <script>
            Swal.fire(
                'Deshabilitado!',
                'La publicación ha sido deshabilitada de manera exitosa.',
                'success',
            )
        </script>
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
        <script>
            Swal.fire(
                'Alquilado!',
                'Ya puede acceder a la comodidad de su nuevo hogar.',
                'success'
            )
        </script>
    @elseif(session('pendiente') == 'pend')
        <script>
            Swal.fire(
                'Pendiente!',
                'Su pago esta pendiente a ser aprobado.',
                'warning'
            )
        </script>
    @elseif(session('rechazado') == 'rej')
        <script>
            Swal.fire(
                'Rechazado!',
                'Su pago fue rechazo. Por favor intente por otro medio de pago.',
                'Error'
            )
        </script>
    @endif

    @if(session('restaurar') == 'ok')
        <script>
            Swal.fire(
                'Restaurado!',
                'La publicación ha sido restaurada de manera exitosa.',
                'success'
            )
        </script>
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
        <script>
            Swal.fire(
                'Modificado!',
                'Los cambios fueron aplicados de manera exitosa.',
                'success'
            )
        </script>
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
        <script>
            Swal.fire(
                'Publicado!',
                'Se publico de manera exitosa su alquiler.',
                'success'
            )
        </script>
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

    <script>

        // document.getElementsByClassName('formulariodeshabilitar').addEventListener('submit', function(e){
        //     e.preventDefault();
        //     console.log(result.value);
        //     Swal.fire({
        //         title: '¿Está seguro?',
        //         text: "¡No podrá revertir esto!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: '¡Sí, deshabilitar!',
        //         cancelButtonText: 'Cancelar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             this.submit();
        //         }
        //     })
        //     console.log(result.value);
        // });

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
</x-app-layout>
