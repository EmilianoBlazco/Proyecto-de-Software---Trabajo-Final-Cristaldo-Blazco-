<x-app-layout>

    <x-slot name="title">Registrar contrato</x-slot>

    @vite(['resources/css/material-kit.css', 'resources/css/nucleo-icons.css','resources/css/multistep.css', 'resources/js/multistep.js', 'resources/css/nucleo-svg.css','resources/js/material-kit.js'])

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
            <div class="card h-100 align-content-xxl-center mt-3">
                <div class="card">
                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <p>En la localidad de Apostoles etc.... en la fecha<input type="date"> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div id="container">
                <div id="editor"></div>

            </div>
            <div class="col text-md-end">
                <button class="btn btn-success ml-auto" type="submit" title="Send">Guardar Contrato</button>
            </div>
        </div>
    </div>

    </body>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/decoupled-document/ckeditor.js"></script>--}}

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

{{--    <script>--}}
{{--        const container = document.querySelector( '#container' );--}}
{{--        const editor = document.querySelector( '#editor' );--}}

{{--        let toolbarContainer = document.createElement( 'div' );--}}

{{--        container.insertBefore( toolbarContainer, editor );--}}

{{--        ClassicEditor--}}
{{--            .create( editor, {--}}
{{--                toolbar: {--}}
{{--                    container: toolbarContainer--}}
{{--                },--}}
{{--                language: 'es'--}}
{{--            } )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
</x-app-layout>
