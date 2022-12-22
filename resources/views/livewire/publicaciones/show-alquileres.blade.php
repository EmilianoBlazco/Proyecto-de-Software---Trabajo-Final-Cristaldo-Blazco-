<div class="container-fluid pt-5 mt-5">
    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/css/nucleo-svg.css','resources/js/material-kit.js'])
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>



    <div class="row px-xl-5" >

{{--         Sidebar de filtros de busqueda --}}
        <div class="col-lg-3 col-md-12 p-3">
            <div class="card p-3">


                <div class="card-header">
                    <h4 class="card-title">Esta filtrando por:</h4>
                    <div class="text-center">
                        <button wire:click="limpiarFiltros" class="btn btn-outline-primary btn-sm fas fa-eraser"> Limpiar filtros</button>
                    </div>
                </div>
{{--                 Precio start --}}
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4"><i class="fas fa-dollar-sign text-primary me-3"></i>Precio</h5>
                    <form>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group input-group-outline bg-light rounded">
                                    <label class="form-label">Desde</label>
                                    <input wire:model="precioDesde" type="number" class="form-control" id="precioDesde" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline bg-light rounded">
                                    <label class="form-label">Hasta</label>
                                    <input wire:model="precioHasta" type="number" class="form-control" id="precioHasta" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
{{--                 Precio end --}}

{{--                Dimensiones start--}}
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4" title="Multiplicacion del largo por el ancho del lugar"><i class="fas fa-ruler-combined text-primary me-3" ></i>Dimensiones en m<sup>2</sup></h5>
                    <form>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group input-group-outline bg-light rounded">
                                    <label class="form-label">Desde</label>
                                    <input wire:model="superficieDesde" type="number" class="form-control" id="superficieDesde" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline bg-light rounded">
                                    <label class="form-label">Hasta</label>
                                    <input wire:model="superficieHasta" type="number" class="form-control" id="superficieHasta" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
{{--                 Dimensiones end--}}

{{--                Tipo de propiedad start --}}
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4"><i class="fas fa-home text-primary me-3"></i>Tipo de propiedad</h5>
                    <form>
                        @foreach($tipos as $tipo)
                            <div class="form-check">
                                <input wire:model="tipoPropiedad" class="form-check-input focus" type="checkbox"   value="{{$tipo->id}}" >
                                <label class="form-check-label" >
                                    {{$tipo->nombre_tipo_propiedad}} - ({{count($publicaciones->where('id_tipo_propiedad', $tipo->id))}})
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>

{{--                Tipo de propiedad end --}}

{{--                Ubicacion start --}}
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4"><i class="fas fa-map-marker-alt text-primary me-3"></i>Ubicación</h5>
                    <form>
                        <div class="form-group">
                            <label class="form-label">Provincia</label>

                            <select wire:model="filtroProvincia" class="form-select" aria-label="Default select example" >
                                <option selected="selected" name="provincia" value="0">Seleccione la provincia</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{$provincia->id}}"
                                            @if(old('provincia') == $provincia->id)
                                                selected
                                        @endif
                                    >{{$provincia->nombre_provincia}} - ({{count($publicaciones->where('id_provincia', $provincia->id))}}) </option>
                                @endforeach
                            </select>

                        </div>
                    </form>
                </div>


                @foreach($comodidades as $comodidad)
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4"><i class=" text-primary me-3
{{--                    cambiar el icono dependiendo de cada nombre_comodidad--}}
                    @if($comodidad->nombre_comodidad == 'Accesibilidad')
                        fas fa-wheelchair
                    @elseif($comodidad->nombre_comodidad == 'Servicios')
                        fas fa-concierge-bell
                    @elseif($comodidad->nombre_comodidad == 'Caracteristicas')
                        fas fa-tools
                    @elseif($comodidad->nombre_comodidad == 'Ambientes')
                        fas fa-door-open
                    @endif
                    "></i>{{$comodidad->nombre_comodidad}}</h5>
                    @foreach($caracteristicasComodidades->where('id_comodidad',$comodidad->id) as $caracteristica)
                    <form>
                        <div class="form-check">
                            <input wire:model="filtroComodidades" class="form-check-input" type="checkbox" value="{{$caracteristica->id}}" id="{{$caracteristica->id}}" id="flexCheckDefault3112">
                            <label class="form-check-label" for="flexCheckDefault3112">
                                {{$caracteristica->nombre_caracteristica_comodidad}} {{--- ({{count($publicaciones->where('id_caracteristica_comodidad', $caracteristica->id))}})--}}
                            </label>
                        </div>
                    </form>
                    @endforeach
                </div>
                @endforeach

{{--                boton centrado de mostrar mas--}}

                <div class="border-bottom mb-4 pb-4 text-center">
                    <button onclick="myFunction()" id="myBtn" class="btn btn-link text-decoration-none text-primary p-0 align-items-center justify-content-center ">Mostrar más filtros<i class="fas fa-chevron-down ms-2"></i></button>
                </div>
{{--                botón centrado de limpiar filtros--}}
                <div class="text-center">
                    <button wire:click="limpiarFiltros" class="btn btn-outline-primary btn-sm fas fa-eraser"> Limpiar filtros</button>
                </div>
            </div>
        </div>
{{--         Shop Sidebar End --}}

{{--        @foreach($tipooos as $tipoo)--}}
{{--            <h3>{{$tipoo}}</h3>--}}
{{--        @endforeach--}}
{{--         Shop Product Start --}}
        <div class="col-lg-9 col-md-12 p-3">
            <div class="card p-3">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div class="input-group input-group-dynamic mb-4">
                                <span class="input-group-text"><i class="fas fa-search text-primary mt-1" aria-hidden="true"></i></span>
                                <input wire:model="search" class="form-control" placeholder="Buscar por título o descripción" type="text" id="buscador" >
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 me-2">Ordenar por:</label>
                                    <select wire:model="ordenar" class="form-select form-select-sm">
                                        <option selected value="desc">Recomendación</option>
                                        <option value="desc">Mayor precio</option>
                                        <option value="asc">Menor precio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                      Publicaciones start --}}
                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        @foreach($publicaciones as $publicacion)
                            <div class="col">
                                <div class="card" style="--bs-btn-hover-bg:100">
                                    <a href="{{route('publicaciones.show',$publicacion->id)}}" target="_blank" class="position-relative overflow-hidden">
                                        <div class="ratio ratio-1x1">
{{--                                            <div id="carousel-12" class="carousel slide" data-bs-ride="false">--}}
{{--                                                <div class="carousel-inner">--}}
{{--                                                    <div class="carousel-item active ratio ratio-1x1"><img class="w-100 d-block card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="--}}
{{--                                                    @foreach($imagenes as $imagen)--}}
{{--                                                        @if($imagen->id_publicacion == $publicacion->id)--}}
{{--                                                            {{asset($imagen->url_imagen)}}--}}
{{--                                                            @break--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach" alt="Slide Image" /></div>--}}
{{--                                                    <div class="carousel-item ratio ratio-1x1"><img class="w-100 d-block card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="../../assets/img/rents/2.webp" alt="Slide Image" /></div>--}}
{{--                                                    <div class="carousel-item ratio ratio-1x1"><img class="w-100 d-block card-img-top" style="object-fit:cover; height:100%; width: 100%;" src="../../assets/img/rents/3.webp" alt="Slide Image" /></div>--}}
{{--                                                </div>--}}
{{--                                                <div><a class="carousel-control-prev" href="#carousel-12" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-12" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>--}}
{{--                                                <ol class="carousel-indicators">--}}
{{--                                                    <li class="active" data-bs-target="#carousel-1" data-bs-slide-to="0"></li>--}}
{{--                                                    <li data-bs-target="#carousel-12" data-bs-slide-to="1"></li>--}}
{{--                                                    <li data-bs-target="#carousel-12" data-bs-slide-to="2"></li>--}}
{{--                                                </ol>--}}
{{--                                            </div>--}}
                                            <div id="carousel-1" class="carousel slide shadow-lg" data-bs-ride="true">
                                                <div class="carousel-inner" {{$cantidad = 1}}>

                                                    @foreach($imagenes as $imagen)
                                                        @if($imagen->id_publicacion == $publicacion->id)
                                                            <div class="carousel-item @if($cantidad == 1) active @endif ratio ratio-1x1 "><img class="rounded" style="object-fit:cover; height:100%; width: 100%;" src="{{asset($imagen->url_imagen)}}" alt="Slide Image" /></div {{++$cantidad}}>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="fa fa-arrow-left fa-2x" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="fa fa-arrow-right fa-2x" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
                                                <ol class="carousel-indicators">
                                                    <li class="active" data-bs-target="#carousel-1" data-bs-slide-to="0"></li>
                                                    <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                                                    <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                                                    <li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
                                                    <li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{route('publicaciones.show',$publicacion->id)}}">{{$publicacion->titulo_publicacion}}</a> </h5>
                                        <h2 class="card-text">$ {{ number_format($publicacion->precio_publicacion, 0, ',', '.')  }} ARS</h2>
                                        <p class="card-text"><a target="_blank" title="{{$publicacion->descripcion_publicacion}}">{{substr($publicacion->descripcion_publicacion,0,30)}}@if(strlen($publicacion->descripcion_publicacion)>30)...@endif

                                            </a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                    Publicaciones end      --}}

{{--                    Paginación --}}
{{--                    <div class="container">--}}
{{--                        <div class="row justify-space-between py-2">--}}
{{--                            <div class="col-lg-4 mx-auto">--}}
{{--                                @if($publicaciones->hasPages())--}}
{{--                                    <ul class="pagination pagination-primary m-4">--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="javascript:;" aria-label="Previous">--}}
{{--                                                <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        @if($publicaciones->onFirstPage())--}}
{{--                                            <li class="page-item disabled">--}}
{{--                                                <a class="page-link" href="javascript:;">1</a>--}}
{{--                                            </li>--}}
{{--                                        @else--}}
{{--                                            <li class="page-item">--}}
{{--                                                <a class="page-link" href="javascript:;">1</a>--}}
{{--                                            </li>--}}
{{--                                        @endif--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="{{$publicaciones->previousPageUrl()}}" aria-label="Next">--}}
{{--                                                <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    paginacion bootstrap--}}
{{--                    <div class="container">--}}
{{--                        <div class="row justify-space-between py-2">--}}
{{--                            <div class="col-lg-4 mx-auto">--}}
{{--                                {{ $publicaciones->links() }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
{{--     Shop Product End --}}
</div>

</div>
