<div>
    <x-app-layout>

        @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/nucleo-svg.css'])
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-slot name="title">Registrar Contrato</x-slot>


        <body>


        <div class="page-header align-items-start min-vh-100 " style="background-image: url('https://www.byverdleds.com/blog/wp-content/uploads/2019/08/LedSalon.jpg')">
            <span class="mask bg-gradient-dark opacity-5"></span>

            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="text-white">Consulte los contratos creados</h1>
                    </div>
                </div>
                <div class="container mt-sm-5 mt-3">
                    <div class="card h-100 align-content-xxl-center">
                        <div class="card">
                            <div class="row text-center py-2 mt-3">
                                <div class="col-4 mx-auto">
                                    <div class="input-group input-group-dynamic mb-4">
                                        <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input class="form-control" placeholder="Buscar" type="text" wire:model="buscar" >
                                    </div>
                                    <div>
                                        <a href="{{route('publicaciones.index')}}" class="btn btn-primary">Regresar a la lista de publicaciones</a>
                                        <a href="{{route('contratos.create')}}" class="btn btn-primary">Definir un nuevo contrato</a>
                                    </div>
                                </div>
                            </div>

                            @if($contratos->count())
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Contrato</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15 ps-2">Tipo</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Estado</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Fecha de celebracion</th>
                                            {{--                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Tipo de contrato</th>--}}
                                            {{--                                        <th></th>--}}
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($contratos as $contrato)
{{--                                            @livewire('contrato.show-contrato', ['contrato' => $contrato], key($contrato->id));--}}
                                            <tr style="height:100px">
                                                <td class="align-middle text-center">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            {{--                                                       aca va lo de show--}}
{{--                                                            <p class="text-sm font-weight-bold mb-0">{{$contrato->titulo_contrato}}</p>--}}
{{--                                                            <span class="text-dark text-lg font-weight-bold">{{$contrato->titulo_contrato}}</span>--}}
                                                            <h3 class="mb-0">
                                                                <a wire:click="showModal({{$contrato->id}})" target="_blank" title="{{$contrato->titulo_contrato}}" class="hover">
                                                                    {{substr($contrato->titulo_contrato,0,17)}}
                                                                    @if(strlen($contrato->titulo_contrato)>17)...@endif
                                                                </a>
                                                            </h3>
{{--                                                            <button type="button" class="btn btn-primary" wire:click="emitTo('contrato.show-contrato,'mostrar')">Mostrar contrato</button>--}}
{{--                                                            @livewire('contrato.show-contrato', ['contrato' => $contrato], key($contrato->id))--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($contrato->tipo_contrato == 1)
{{--                                                        <p class="text-xs font-weight-bold mb-0">Generado por el propietario</p>--}}
                                                        <span class="badge bg-gradient-success">Generado por el propietario</span>
                                                    @else
{{--                                                        <p class="text-xs font-weight-bold mb-0">Autogenerado</p>--}}
                                                        <span class="badge bg-gradient-warning">Autogenerado</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($contrato->baja_contrato == null)
                                                        <span class="badge bg-gradient-success">Vigente</span>
                                                    @elseif($contrato->baja_contrato != null)
                                                        <span class="badge bg-gradient-danger">Dado de baja</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($contrato->fecha_inicio_contrato == null)
                                                        <span class="text-secondary text-xs font-weight-normal">Todavia no se asocio a un usuario</span>
                                                    @elseif($contrato->fecha_inicio_contrato != null)
                                                        {{$fecha = $contrato->fecha_inicio_contrato}}
                                                        {{$timestamp = DateTime::createFromFormat($fecha, 'Y-m-d')}}
                                                        <span class="text-secondary text-xs font-weight-normal">{{$timestamp}}</span>
                                                    @endif
                                                </td>
{{--                                                <td class="align-middle text-center">--}}
{{--                                                    <span class="badge bg-gradient-success">XXXXX</span>--}}
{{--                                                </td>--}}
                                                <td class="align-middle">
                                                    <a href="javascript:void(0)" class="fas fa-edit" data-toggle="tooltip" data-original-title="Editar"></a>
                                                    {{--                                                {{route('publicaciones.edit',$publicacion)}}--}}
                                                    {{--                                                <a href="{{route('contratos.edit',$contrato)}}" class="fas fa-edit" data-toggle="tooltip" title="Editar contrato"></a>--}}

                                                </td>
                                                <td class="align-middle">
                                                    <form action="#" method="POST">
                                                        {{--                                                    {{route('contratos.destroy',$contrato)}}--}}
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="fa fa-house-damage" data-toggle="tooltip" title="Deshabilitar contrato"></button>

                                                    </form>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            @else
                                <div class="card-body">
                                    <strong>No hay resultados para la busqueda "{{$buscar}}"</strong>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

        @if(session('contrato') == 'ok')
            <script>
                Swal.fire(
                    'Creado!',
                    'Se creo de manera exitosa su contrato.',
                    'success'
                )
            </script>
        @endif
    </x-app-layout>
</div>
