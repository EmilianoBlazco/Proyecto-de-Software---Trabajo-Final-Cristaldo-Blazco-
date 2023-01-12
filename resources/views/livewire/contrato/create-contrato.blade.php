<div>
    <x-app-layout>

        <x-slot name="title">Registrar contrato</x-slot>

        @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/material-kit.js'])
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .container {
                width:80%;
                max-width: 960px;
                margin: 0 auto;
            }
        </style>

        <body>


        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://www.byverdleds.com/blog/wp-content/uploads/2019/08/LedSalon.jpg');">
            <span class="mask bg-gradient-dark opacity-5"></span>

            <div class="container my-auto mt-9">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="text-white">Defina su contrato</h1>
                    </div>
                </div>
                {{--            @livewire('contrato.create-contrato')--}}
                                    <form wire:submit.prevent="register">
{{--                                      Paso 1  --}}
                                        @if($currentStep == 1)
                                            <div class="step-one">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">Paso 1/4 - Datos Iniciales</div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <h6 class="text-center mx-2">Seleccione la publicacion para la cual quiera crear el contrato</h6>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nombre">Nombre de la publicacion</label>
                                                                    <select class="form-control" id="nombre" wire:model="nombre_pub">
                                                                        <option value="">Seleccione</option>
                                                                        @foreach($publicaciones as $publicacion)
                                                                            <option value="{{$publicacion->id}}">{{ $publicacion->titulo_publicacion}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger">@error('nombre_pub'){{$message}}@enderror</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        @endif
{{--                                        Paso 2--}}
                                        @if($currentStep == 2)
                                            <div class="step-two">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">Paso 2/4 - Pago del alquiler</div>
                                                <p class="text-center my-1 bg-yellow-100 text-grey">Se tendra en cuenta el precio establecido en la publicacion seleccionada en paso 1 del formulario</p>
                                                <div class="card-body">
                                                    <div class="row my-2">
                                                        <h6 class="text-center mx-2" >¿En que intervalo de dias del mes el alquiler podra ser abonado sin recargos?</h6>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Fecha incial de pago</label>
                                                                <input type="number" class="form-control" id="fecha_incio" min="1" max="30" wire:model="fechainicio">
                                                                <span class="text-danger">@error('fechainicio'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Fecha limite de pago</label>
                                                                <input type="number" class="form-control" id="fecha_final" min="1" max="30" wire:model="fechafin">
                                                                <span class="text-danger">@error('fechafin'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="text-center mx-2" >¿Cual sera el procentaje de recargo por incumplimiento de plazo?</h6>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Porcentaje de recargo</label>
                                                                <input type="number" class="form-control" id="recargo_dias" min="0" max="100" wire:model="recargodias">
                                                                <span class="text-danger">@error('recargodias'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
{{--                                        Paso 3--}}
                                        @if($currentStep == 3)
                                            <div class="step-three">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">Paso 3/4 - Limites de pagos</div>
                                                <div class="card-body">
                                                    <div class="row my-2">
{{--                                                        <h6 class="text-center mx-2" >¿Cada cuantos meses se realiza el aumento al precio del alquiler?</h6>--}}
                                                        <div class="col-md-6">
                                                            <h6 class="text-center mx-2" >¿Cada cuantos meses se realiza el aumento al precio del alquiler?</h6>
                                                            <div class="form-group">
                                                                <label for="nombre">Meses</label>
                                                                <input type="number" class="form-control" id="meses" min="1" max="12" wire:model="meses">
                                                                <span class="text-danger">@error('meses'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-center mx-2" >¿Cual es el porcentaje en que aumentara al precio del alquiler?</h6>                                                            <div class="form-group">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nombre">Porcentaje de recargo</label>
                                                                        <input type="number" class="form-control" id="recargo_dias" min="0" max="100" wire:model="recargomes">
                                                                        <span class="text-danger">@error('recargomes'){{$message}}@enderror</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <h6 class="text-center mx-2" >¿Cuantas cuatos se puede retrasar el inquilino antes de avisar del desalojo?</h6>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Cantidad de cuotas</label>
                                                                <input type="number" class="form-control" id="cuotas" min="1" max="12" wire:model="cuotas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
{{--                                        Paso 4--}}
                                        @if($currentStep == 4)
                                        <div class="step-four">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">Paso 4/4 - Otras condiciones</div>
                                                <div class="card-body">
                                                    <div class="row my-2">
                                                        <h6 class="text-center mx-2" >Aqui puede escribir otros terminos y condiciones que tendra el contrato</h6>
{{--                                                        <div id="container">--}}
{{--                                                            <div id="editor"></div>--}}
{{--                                                            <textarea id="editor" wire:model="terminos" class="w-full"></textarea>--}}
{{--                                                        </div>--}}
                                                        <div class="form-group">
                                                            <div class="form-control">
                                                                <textarea id="editor" wire:model="terminos" class="w-full"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <h6 class="text-center mx-2" >Ejemplo de carga de terminos y condiciones extras</h6>
                                                        <p class="text-info text-sm my-1 bg-yellow-100 text-grey">
                                                            (1) <b>Debe</b> utilizar <b>numeros</b> para iniciar cada condicion, <b>seguida de un punto(3.)</b>, luego escribir la condicion.
                                                            <br>
                                                            (2) <b>Debe</b> colocar un <b>punto(.) final</b> para cada terminar cada condicion.
                                                        </p>
                                                        <div class="form-group">
                                                            <div class="form-control">
                                                                <textarea class="w-full" disabled placeholder="1.Este contrato se firmara por un plazo de 12 meses, a partir de la fecha de firma del mismo." ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="action-buttons d-flex justify-content-between pt-2 pb-2">

                                            @if($currentStep == 1)
                                                <div></div>
                                            @endif
                                                @if($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
{{--                                          <button class="btn btn-primary" wire:click="back(1)">Atras</button>--}}
                                                    <button type="button" class="btn btn-primary prevBtn btn-lg pull-left" wire:click="decrementarPaso">Anterior</button>
                                                @endif
                                                @if($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                                                    <button type="button" class="btn btn-primary nextBtn btn-lg pull-right" wire:click="incrementarPaso">Siguiente</button>
                                                @endif
                                                @if($currentStep == 4)
                                                    <button type="submit" class="btn btn-success nextBtn btn-lg pull-right">Guardar Contrato</button>
                                                @endif
                                        </div>
                                    </form>
                <br>
{{--                <div class="col text-md-end">--}}
{{--                    <button class="btn btn-success ml-auto" type="submit" title="Send">Guardar Contrato</button>--}}
{{--                </div>--}}
            </div>
        </div>

        </body>

        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
        {{--    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/decoupled-document/ckeditor.js"></script>--}}
        <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>


        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

        <script>
            Livewire.on('alerta', function(){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Contrato creado con exito',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            // Swal.fire(
            //     'Creado!',
            //     'Se creo de manera exitosa su contrato.',
            //     'success'
            // )
        </script>
    </x-app-layout>
</div>
