@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <!-- post -->
                        <div class="col-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <input type="text" class="form-control" style="text-align: center;"
                                            id="floatingName" placeholder="¿ Qué estás pensando, Pablo Garcia ?">
                                    </div>
                                    <hr>
                                    <div class="row justify-content-md-right">
                                        <div class="col col-lg-2">
                                            <img src="assets/img/imagesSocial.png" alt=""> Imagen
                                        </div>
                                        <div class="col col-lg-2">
                                            <img src="assets/img/videoSocial.png" alt="">Video
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //post -->
                        <!-- comentarios -->
                        <div class="col-12">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Opciones</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Editar</a></li>
                                        <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <br>
                                    <div class="d-flex align-items-center">
                                        <div class="news">
                                            <div class="post-item clearfix">
                                                <img src="assets/img/news-1.jpg" alt="">
                                                <h4><a href="#">Pablo Garcia</a></h4>
                                                <p>28 - 01 - 2022</p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <p>Pablo Garcia dd</p>
                                    <hr>
                                    <div class="row justify-content-md-right">
                                        <div class="col col-lg-2">
                                            Me Gusta
                                        </div>
                                        <div class="col col-lg-2">
                                            <button type="submit" onclick="mostrarOcultar()"
                                                class="btn btn-primary">Comentarios</button>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Formulario Comentarios -->
                                    <div style="display: none" id="formularioComentario">
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Escribe tu Comentario">
                                            </div><br>
                                            <button type="submit" class="btn btn-primary">Aceptar</button><br>
                                        </form>

                                        <div class="news"><br>
                                            <img src="assets/img/news-1.jpg" alt="">
                                            <h4><a href="#">Pablo Garcia</a></h4>
                                            <p>Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en
                                                demostraciones de
                                                tipografías o de borradores de diseño para probar el diseño visual antes de
                                                insertar el
                                                texto
                                                final</p>
                                        </div>
                                    </div>
                                    <!-- //Formulario Comentarios -->
                                </div>
                            </div>
                        </div>
                        <!-- //comentarios -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- contactos -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="{{ route('home') }}" id="contactos"
                                style="color: green; font-size: 25px"><strong><i
                                        class="bi bi-arrow-counterclockwise"></strong></i></a>
                        </div>
                        <div class="card-body pb-0">
                            <h5 class="card-title">Contactos</h5>
                            <div class="news" id="divContactos">
                                {{-- Aqui van los Usuarios desde la Api --}}
                            </div>
                        </div>
                    </div>
                    <!-- contactos -->
                </div>

                @push('scripts')
                    <script>
                        window.axios.get('/api/users')
                            .then((response) => {
                                const divContactos = document.getElementById("divContactos");
                                let users = response.data;

                                users.forEach((user, index) => {
                                    let divUsuarios = document.createElement("div");
                                    divUsuarios.className = "post-item clearfix";
                                    divContactos.appendChild(divUsuarios);

                                    let mostrarImagen = document.createElement('img');
                                    mostrarImagen.src = 'assets/img/news-1.jpg'
                                    divUsuarios.appendChild(mostrarImagen);

                                    let a = document.createElement('a');
                                    a.innerHTML = "<h4>" + user.nombre + "</h4>"
                                    a.href = "https://www.google.com/";
                                    divUsuarios.appendChild(a);

                                    let parrafo = document.createElement("p");
                                    parrafo.innerHTML = "<h4>" + user.conectado + "</h4>"

                                    parrafo.setAttribute('id', 'usuarioStatus' + user.id);

                                    if (user.conectado == 1) {
                                        parrafo.innerText = 'Conectado';
                                        parrafo.style.color = 'green';
                                    } else {
                                        parrafo.innerText = 'Desconectado';
                                        parrafo.style.color = 'red';
                                    }
                                    divUsuarios.appendChild(parrafo);
                                });
                            });
                    </script>

                    <script>
                        /* Implementar solo en la entidad Amigos */
                        // const divPadreContactos = document.getElementById("divContactos");

                        // let divUsuariosCreated = document.createElement("div");
                        // divUsuariosCreated.innerText = 'Conectado';

                        // divPadreContactos.appendChild(divUsuariosCreated)
                    </script>
                @endpush

            </div>
        </section>

    </main>
@endsection
