@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Pre-Publicacion -->
                        <div class="col-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <br>
                                    <input id="userLogin" type="hidden" value="{{ Auth::user()->id }}"></input>
                                    <div class="d-flex align-items-center">
                                        <input type="text" class="form-control" data-bs-toggle="modal"
                                            style="cursor:pointer; text-align: center;" data-bs-target="#exampleModal"
                                            placeholder="¿Qué estás Pensando, {{ Auth::user()->alias }}.?" disabled>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- //Pre-Publicacion -->

                        <!-- Publicacion -->
                        @foreach ($publications as $mostrarPublication)
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
                                    {{-- Filtro --}}
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Opciones</h6>
                                            </li>
                                            {{-- <li><a class="dropdown-item" href="#">Editar</a></li> --}}
                                            <li><a class="dropdown-item" id="eliminarPublication"
                                                    onclick="deletePublication({{ $mostrarPublication->id }})"
                                                    href="javascript:void(0);">Eliminar</a></li>
                                        </ul>
                                    </div>

                                    {{-- Cuerpo --}}

                                    <div class="card-body">
                                        <div class="d-flex align-items-center" style="padding-top: 20px;">
                                            <div class="news">
                                                <div class="post-item clearfix">
                                                    <img src="{{ url('fotoPerfil/' . Auth::user()->fotoPerfil) }}"
                                                        alt="">
                                                    <h4><a href="#">{{ $mostrarPublication->user->alias }}</a></h4>
                                                    <p>{{ $mostrarPublication->created_at }}</p>

                                                </div>
                                            </div>
                                        </div>

                                        @if ($mostrarPublication->imagen == '')
                                            <p style="padding-top: 10px;">{{ $mostrarPublication->contenido }}</p>
                                        @else
                                            <img src="{{ route('publicationImagen', ['filename' => $mostrarPublication->imagen]) }}"
                                                alt="" width="700" height="700" class="img-fluid"
                                                style="margin:auto; display:block; padding-top: 20px; border-radius: 10px 10px 10px 10px;">
                                            <p style="padding-top: 10px;">{{ $mostrarPublication->contenido }}</p>
                                        @endif
                                        <hr>

                                        <div class="row justify-content-md-right">

                                            <?php $userLike = false; ?>

                                            @foreach ($mostrarPublication->like as $likes)
                                                @if ($likes->user_id == Auth::user()->id)
                                                    <?php $userLike = true; ?>
                                                @endif
                                            @endforeach

                                            @if ($userLike)
                                                <div class="col col-lg-2 dislike" id="btn-dislike{{ $mostrarPublication->id }}"
                                                    onclick="dislike({{ $mostrarPublication->id }})">
                                                    Dislike
                                                </div>
                                            @else
                                                <div class="col col-lg-2 like" id="btn-like{{ $mostrarPublication->id }}"
                                                    onclick="like({{ $mostrarPublication->id }})">
                                                    Like
                                                </div>
                                            @endif

                                            <div class="col col-lg-2">
                                                <button type="button"
                                                    onclick="mostrarOcultar({{ $mostrarPublication->id }})"
                                                    class="btn btn-success">Comentarios</button>
                                            </div>

                                        </div>
                                        <br>

                                        <!-- Comentarios -->
                                        <div style="display: none" id="{{ $mostrarPublication->id }}"
                                            class="classCajaCometarios">

                                            <form action="{{ route('comentarioSave') }}" method="POST"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <div class="input-group">
                                                        <button class="btn btn-primary" type="submit"
                                                            id="inputGroupFileAddon04">Enviar</button>

                                                        <input type="text"
                                                            class="form-control"placeholder="Escribe tu Comentario"
                                                            name="comentario">

                                                        <div class="file-select" id="src-file1">
                                                            <input type="file" name="src-file1" aria-label="Archivo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </form>

                                            <div class="news">
                                                <br>
                                                <img src="assets/img/news-1.jpg" alt="">
                                                <h4><a href="#">Pablo Garcia</a></h4>
                                                <p>Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en
                                                    demostraciones de
                                                    tipografías o de borradores de diseño para probar el diseño visual
                                                    antes
                                                    de
                                                    insertar el
                                                    texto
                                                    final</p>
                                            </div>

                                            <div class="text-letf" style="margin-left: 94px;">
                                                <img src="assets/img/news-1.jpg" class="rounded" alt="..."
                                                    width="100" height="100">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- //Publicacion -->
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
                        let userLogin = document.getElementById('userLogin').value;
                        /* Obtener Usuarios Seguidos - Conectados */
                        // window.axios.get('/api/followers/' + userLogin)
                        window.axios.get(`/api/followers/${userLogin}`)
                            .then((response) => {

                                const divContactos = document.getElementById("divContactos");
                                let users = response.data;

                                users.forEach((user, index) => {

                                    let divUsuarios = document.createElement("div");
                                    divUsuarios.className = "post-item clearfix";
                                    divContactos.appendChild(divUsuarios);

                                    let mostrarImagen = document.createElement('img');

                                    if (user.fotoPerfil != null) {
                                        mostrarImagen.src = 'fotoPerfil/' + user.fotoPerfil
                                    } else {
                                        mostrarImagen.src = 'assets/img/profile-img.jpg'
                                    }

                                    divUsuarios.appendChild(mostrarImagen);

                                    let a = document.createElement('a');
                                    a.innerHTML = "<h4>" + user.alias + "</h4>"

                                    var url = baseUrl + "usuario/" + 'temp/' + 1 + '/0' + '/0';
                                    url = url.replace('temp', user.alias);
                                    a.href = url;

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

                                }); /* Fin forearch */

                            });
                    </script>
                @endpush

            </div>
        </section>
    </main>

    <!-- Modal Comentarios -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">Crear Publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ action('PublicationController@save') }}" method="POST"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Escribe tu Comentario</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="comentarioPublicacion"></textarea>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Subir Imagen</label><br>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                name="imagenPublicacion">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>

                    </form>

                    {{-- <div class="row justify-content-md-right">
                         <div class="col col-lg-2">
                             <img src="assets/img/imagesSocial.png" alt=""> Imagen
                         </div>
                         <div class="col col-lg-2">
                             <img src="assets/img/videoSocial.png" alt="">Video
                         </div>
                     </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
