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
                                <div class="btn-group btn-group-horizontal">
                                    <a href="{{route('publicaciones.create')}}" class="btn bt n-primary">Publicar una nueva propiedad</a>
                                    <span>ㅤㅤ</span>
                                    <a href="{{route('contratos.index')}}" class="btn btn-primary">Consultar contratos definidos</a>
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Vencimiento de contrato</th>
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
                                            @if($contrato->where('id_publicacion',$publicacion->id)->first() == null)
                                                <span class="text-secondary text-xs font-weight-normal">No se encuentra ningún contrato activo</span>
                                            @else
                                                <span class="text-secondary text-xs font-weight-normal">{{date('d-m-Y', strtotime($contrato->where('id_publicacion',$publicacion->id)->first()->fecha_vencimiento_contrato))}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($publicacion->estado_publicacion == "Activo")
                                                @if($solicitud_prop->count() > 0)
                                                    <a href="{{route('contratos.create')}}" class="fa fa-file-text-o" style="color: #4fa952" data-toggle="tooltip" title="Definir contrato"></a>
                                                @else
                                                    <a class="fa fa-file-text-o" style="color: red" data-toggle="tooltip" title="Deben existir solicitudes para crear un contrato"></a>
                                                @endif
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                @if(Auth::user()->hasRole('inquilino'))
                                                    <a href="{{route('contratos.show',$contrato->where('id_publicacion', $publicacion->id)->first()->id)}}" class="fa fa-file-text-o" style="color: #4fa952" data-toggle="tooltip" title="Consultar contrato"></a>
                                                @elseif(Auth::user()->hasRole('propietario'))
                                                    <a class="fa fa-file-text-o" style="color: red" data-toggle="tooltip" title="Definir contrato"></a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="align-middle">
{{--                                            <a href="{{route('publicaciones.edit',$publicacion)}}:" class="fas fa-edit" data-toggle="tooltip" data-original-title="Editar"></a>--}}
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <a href="{{route('publicaciones.edit',$publicacion)}}" class="fas fa-edit" style="color: #4fa952" data-toggle="tooltip" title="Editar publicación"></a>
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                @if(Auth::user()->hasRole('inquilino'))

                                                @elseif(Auth::user()->hasRole('propietario'))
                                                    <a class="fas fa-edit" style="color: red" disabled data-toggle="tooltip" title="Editar publicación"></a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if($publicacion->estado_publicacion == "Activo")
                                                <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="fa fa-house-damage" style="color: #4fa952" data-toggle="tooltip" title="Desactivar publicación"></button>
                                                </form>
                                            @elseif($publicacion->estado_publicacion == "Alquilado")
                                                @if(Auth::user()->hasRole('inquilino'))

                                                @elseif(Auth::user()->hasRole('propietario'))
                                                    <form action="{{route('publicaciones.destroy',$publicacion)}}" class="formulariodeshabilitar" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="fa fa-house-damage" style="color: red" disabled data-toggle="tooltip" title="Desactivar publicación"></button>
                                                    </form>
                                                @endif
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

</x-app-layout>
