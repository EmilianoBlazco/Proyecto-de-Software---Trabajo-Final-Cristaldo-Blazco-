<x-app-layout>
    <x-slot name="title">Preguntas frecuentes</x-slot>
    @vite(['resources/css/material-kit.css','resources/js/material-kit.js'])
    <script src="https://kit.fontawesome.com/4e5e1117af.js" crossorigin="anonymous"></script>

    <!-- agregar texto area con un botón para agregar otro text area -->
    <div class="page-header align-items-start min-vh-100  " style="background-image: url('{{ asset('img/bgdep2.jpg') }}');">
        <div class="col-md-12 p-8">
            <div class="card">
                <section>
                    <div class="container py-4">
                        <div class="row">
                            <div id="padre" class="col-lg-10 mx-auto d-flex justify-content-center flex-column">
                                <h1 class="text-center">CLAUSULAS</h1>

                                <div class="row py-2 mt-5">
                                    <h7 class="text-dark">Clausula 1</h7>
                                    <div class="input-group input-group-dynamic mb-4">
                                        <textarea class="form-control" id="clausula1" rows="3" name="clausula1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 mx-auto d-flex justify-content-center flex-column">
                                <button id="agregar" class="btn btn-primary btn-round">Agregar</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <script>
        let agregar = document.getElementById('agregar');
        let div =document.getElementById('padre');

        let clausula = 1;
        agregar.addEventListener("click", function () {
            clausula++;
            let divrow = document.createElement("div");
            divrow.setAttribute("class", "row py-2 mt-5");
            let h7 = document.createElement("h7");
            h7.setAttribute("class", "text-dark");
            h7.innerHTML = "Clausula "+clausula;
            let divinput = document.createElement("div");
            divinput.setAttribute("class", "input-group input-group-dynamic mb-4");
            let textarea = document.createElement("textarea");
            textarea.setAttribute("class", "form-control");
            textarea.setAttribute("id", "clausula"+clausula);
            textarea.setAttribute("name", "clausula"+clausula);
            textarea.setAttribute("rows", "3");
            divinput.appendChild(textarea);
            divrow.appendChild(h7);
            divrow.appendChild(divinput);
            div.appendChild(divrow);
            // agregar boton eliminar
            let button = document.createElement("button");
            button.setAttribute("class", "btn btn-danger btn-round");
            button.setAttribute("id", "eliminar-"+clausula);
            button.innerHTML = "Eliminar";
            divinput.appendChild(button);


            button.addEventListener("click", function(){
                let id = this.getAttribute("id").replace("eliminar-","");
                let textarea = document.getElementById("clausula"+ id);
                //Eliminar todo el div row
                textarea.parentNode.parentNode.remove();
                this.remove();
                // cambiar el nombre de la clausula y de los id de los textarea
                for (let i = id; i < clausula; i++) {
                    let textarea = document.getElementById("clausula"+(parseInt(i)+1));
                    textarea.setAttribute("id", "clausula"+i);
                    textarea.setAttribute("name", "clausula"+i);
                    let h7 = textarea.parentNode.parentNode.firstChild;
                    h7.innerHTML = "Clausula "+i;
                    let button = textarea.nextSibling;
                    button.setAttribute("id", "eliminar-"+i);
                }
                clausula--;
            });
        });
    </script>



</x-app-layout>
