<x-app-layout>
    <x-slot name="title">Preguntas frecuentes</x-slot>
    @vite(['resources/css/material-kit.css','resources/js/material-kit.js'])
    <script src="https://kit.fontawesome.com/4e5e1117af.js" crossorigin="anonymous"></script>

    <div class="page-header align-items-start min-vh-100  " style="background-image: url('{{ asset('img/bgdep2.jpg') }}');">
        <div class="col-md-12 p-8">
            <div class="card">
                <section>
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-lg-10 mx-auto d-flex justify-content-center flex-column">
                                <h1 class="text-center">Preguntas frecuentes</h1>
                                <form role="form" action="{{route('preguntas.store',$publicacion)}}" id="contact-form" method="post" autocomplete="off">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row py-2 mt-5">
                                            <label class="form-label h6"><i class="fas fa-money-bill-alt fa-lg mr-3" aria-hidden="true"></i>¿Cómo se realiza el pago del alquiler?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row py-2 ">
                                            <label class="form-label h6"><i class="fas fa-lightbulb fa-lg mr-3" aria-hidden="true"></i>¿Quién se encarga de pagar los servicios públicos (agua, luz, gas, internet)?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row py-2 ">
                                            <label class="form-label h6"><i class="fas fa-wrench fa-lg mr-3" aria-hidden="true"></i>¿Cuál es el procedimiento para realizar reparaciones y mantenimiento en la vivienda?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row py-2 ">
                                            <label class="form-label h6"><i class="fas fa-file-contract fa-lg mr-3" aria-hidden="true"></i>¿Cuál es el procedimiento para renovar el contrato de alquiler al finalizar su vigencia?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row py-2 ">
                                            <label class="form-label h6"><i class="fas fa-home fa-lg mr-3" aria-hidden="true"></i>¿Cuál es el procedimiento para desocupar la vivienda al finalizar el contrato de alquiler?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row py-2 ">
                                            <label class="form-label h6"><i class="fas fa-clipboard-list fa-lg mr-3" aria-hidden="true"></i>¿Cuáles son las normas y regulaciones a seguir en la vivienda (horario de silencio, uso compartido de espacios, Invitados)?</label>
                                            <div class="input-group input-group-dynamic mb-4">
                                                <textarea class="form-control" type="text" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn bg-gradient-primary w-100">Enviar respuestas</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>

</x-app-layout>
