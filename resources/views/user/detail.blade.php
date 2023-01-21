@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @foreach ($usuario as $user)
                                @if ($user->fotoPerfil != '')
                                    <img src="{{ route('foto.perfil', ['filename' => $user->fotoPerfil]) }}" alt="Profile"
                                        class="rounded-circle">
                                @else
                                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                @endif
                                <h1>{{ $user->alias }}</h1>
                                <h3>{{ $user->cargo }}</h3>
                            @endforeach
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">

                                        @foreach ($usuario as $user)
                                            @if (Auth::user()->alias != $user->alias)
                                                <button type="button" id="btnAgregarContacto" class="btn btn-success">
                                                    Agregar Contacto
                                                </button>
                                                <button type="button" id="btnCancelarSolicitud" class="btn btn-primary">
                                                    Cancelar Solicitud
                                                </button>
                                            @endif
                                        @endforeach

                                        {{-- @foreach ($usuario as $user)
                                            @if (Auth::user()->alias != $user->alias)
                                                <button type="button" id="btnAgregarContacto" style="display:none">
                                                    Agregar Contacto
                                                </button>

                                                <button type="button" id="" style="display:none">
                                                    Aceptar Contacto
                                                </button>

                                                <button type="button" id="btnCancelarSolicitud" style="display:none">
                                                    Cancelar Solicitud
                                                </button>
                                            @endif
                                        @endforeach --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            {{-- Menu de Navegacion --}}
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link {{ session('message') || $errors->any() ? '' : 'active' }}"
                                        data-bs-toggle="tab" data-bs-target="#perfil">
                                        Perfil</button>
                                </li>

                                @foreach ($followerAprobado as $userAprobado)
                                    @if ($userAprobado->aprobada == 1)
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#chat">
                                                Chat</button>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>

                            <div class="tab-content pt-2">

                                {{-- Mensaje de Notificacion --}}
                                <div id="mensajeNotification" role="alert"></div>
                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>
                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    <input type="hidden" id="idRegistroFollower" value="{{ $idFollower }}">

                                    <input type="text" id="solicitudAmistad" value="{{ $solicitudAmistad }}">

                                    <input type="hidden" id="idNotificacion" value="{{ $idNotificacion }}">

                                    <input type="hidden" id="usuarioLogin" value="{{ Auth::user()->id }}">

                                    @foreach ($usuario as $user)
                                        <input type="hidden" id="usuarioSeguido" value="{{ $user->id }}">
                                    @endforeach
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->nombre }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Apellido</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->apellido }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Empresa</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->empresa }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Cargo</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->cargo }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pais</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->pais }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dirección</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->direccion }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Móvil</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->movil }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        @foreach ($usuario as $user)
                                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                        @endforeach
                                    </div>
                                </div>

                                <style>
                                    /* Component: Chat */
                                    .chat .chat-wrapper .message-list-wrapper {
                                        border: 1px solid #ddd;
                                        height: 452px;
                                        position: relative;
                                        overflow-y: auto;
                                    }

                                    .receive-text {

                                        background: #eff5f5c9;
                                        border-radius: 18px;
                                        padding: 10px
                                    }

                                    .send-text {
                                        background: #9ef6ffc9;
                                        border-radius: 18px;
                                        padding: 10px
                                    }

                                    .textCenter {
                                        text-align: center;
                                    }

                                    .imagenText {
                                        width: 50px;
                                        float: left;
                                        border-radius: 5px;
                                        margin-left: 20px;
                                    }
                                </style>

                                {{-- Chat --}}
                                <div class="tab-pane fade show profile-overview" id="chat">
                                    {{-- Diseño --}}
                                    <div class="card-body">
                                        <div class="row p-2">
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-12 border rounded-lg p-3">
                                                        <ul id="messages" class="list-unstyled overflow-auto"
                                                            style="height: 45vh">
                                                            {{-- <li>Test 1: Hola</li>
                                                            <li>Test 2: Hola</li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                                <form>
                                                    <div class="row py-3">

                                                        <div class="col-10">
                                                            <input type="text" id="message" class="form-control">
                                                        </div>

                                                        <div class="col-2">
                                                            <button id="send" type="submit"
                                                                class="btn btn-primary btn-block">Enviar</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-2">
                                                <p><strong>Online Now</strong></p>
                                                <ul id="users" class="list-unstyled overflow-auto text-info"
                                                    style="height: 45vh">
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- //Diseño  --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('scripts')
        <script>
            /* Chat */
            const usersElement = document.getElementById('users');
            const sendElement = document.getElementById('send');
            const messageElement = document.getElementById('message');
            const messagesElement = document.getElementById('messages');

            // Echo.join('chat')
            //     .here((users) => {

            //         users.forEach((user, index) => {

            //             let element = document.createElement('li');
            //             element.setAttribute('id', user.id);
            //             element.innerText = user.name;
            //             usersElement.appendChild(element);

            //         });

            //     })
            //     .joining((user) => {

            //         let element = document.createElement('li');
            //         element.setAttribute('id', user.id);
            //         element.innerText = user.name;
            //         usersElement.appendChild(element);

            //     })
            //     .leaving((user) => {

            //         let element = document.getElementById(user.id);
            //         element.parentNode.removeChild(element);

            //     })
            //     .listen('MessageSent', (e) => {

            //         let element = document.createElement('li');
            //             element.setAttribute('id', e.user.id);
            //             element.innerText = e.user.nombre + ': ' + e.message;
            //             messagesElement.appendChild(element);


            //     });


            // sendElement.addEventListener('click', (e) => {
            //     e.preventDefault();

            //     window.axios.post('/chat/message', {
            //         message: messageElement.value
            //     });

            //     messageElement.value = '';
            // })
        </script>

        <script>
            let btnAddContacto = document.getElementById('btnAddContacto');
            let btnAgregarContacto = document.getElementById('btnAgregarContacto');
            let btnCancelarSolicitud = document.getElementById('btnCancelarSolicitud');
            let usuarioLogin = document.getElementById('usuarioLogin');
            let usuarioSeguido = document.getElementById('usuarioSeguido');
            let idRegistroFollower = document.getElementById('idRegistroFollower')

            // Validar Amistad
            // $.ajax({
            //         type: "GET",
            //         url: "{{ route('btnValidarAmistad') }}",
            //         data: {
            //             usuarioLogin: usuarioLogin.value,
            //             usuarioSeguido: usuarioSeguido.value,
            //         },
            //     })

            //     .done(function(respuestaPeticion) {

            //         // Send
            //         if (respuestaPeticion == 'sendAgregarContacto') {
            //             hide(btnCancelarSolicitud);
            //             show(btnAgregarContacto);
            //             $('#btnAgregarContacto').addClass("btn btn-success");
            //         }

            //         if (respuestaPeticion == 'sendCancelarContacto') {
            //             hide(btnAgregarContacto);
            //             show(btnCancelarSolicitud);
            //             $('#btnCancelarSolicitud').addClass("btn btn-primary")
            //         }

            //         // if(respuestaPeticion == 'receivedCancelarContacto'){
            //         // hide(btnAgregarContacto);
            //         // show(btnCancelarSolicitud);
            //         // $('#btnCancelarSolicitud').addClass("btn btn-primary")
            //         // }

            //         // if(respuestaPeticion == 'receivedAgregarContacto'){
            //         // hide(btnCancelarSolicitud);
            //         // show(btnAgregarContacto);
            //         // $('#btnAgregarContacto').addClass("btn btn-success");
            //         // }

            //     })
            //     .fail(function() {
            //         console.log('error');
            //     })
            //     .always(function() {
            //         console.log('completo');
            //     });

            btnAgregarContacto?.addEventListener('click', (event) => {

                $.ajax({
                        type: "GET",
                        url: "{{ route('agregarContacto') }}",
                        data: {
                            usuarioLogin: usuarioLogin.value,
                            usuarioSeguido: usuarioSeguido.value,
                            idNotificacion: idNotificacion.value,
                        },
                    })
                    .done(function(respuestaPeticion) {

                        // hide(btnAgregarContacto);
                        // show(btnCancelarSolicitud);
                        // $('#btnCancelarSolicitud').addClass("btn btn-primary")

                        $('#mensajeNotification').html(respuestaPeticion);
                    
                        $('#mensajeNotification').addClass('alert alert-success text-center');

                        console.log(respuestaPeticion);

                        if (respuestaPeticion == 'send') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        } 

                        if (respuestaPeticion == 'existSend') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        } 

                        if (respuestaPeticion == 'sendAfterReceived') {
                            //Cambio el imput
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        } 

                        if (respuestaPeticion == 'saveAfterReceivedFriends') {
                            mensajeNotification.innerText = 'Ya Somos Amigos !!!';
                        }

                        if (respuestaPeticion == 'saveReceivedAfterReceived') {
                            mensajeNotification.innerText = 'Ya Somos Amigos !!!';
                        } 


                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('completo');
                    });
            });

            btnCancelarSolicitud?.addEventListener('click', (event) => {

                $.ajax({
                        type: "GET",
                        url: "{{ route('cancelarContacto') }}",
                        data: {
                            usuarioLogin: usuarioLogin.value,
                            usuarioSeguido: usuarioSeguido.value,
                            idNotificacion: idNotificacion.value,
                        },
                    })
                    .done(function(respuestaPeticion) {

                        // hide(btnCancelarSolicitud);
                        // show(btnAgregarContacto);
                        // $('#btnAgregarContacto').addClass("btn btn-success");

                        $('#mensajeNotification').html(respuestaPeticion);

                        console.log(respuestaPeticion);

                        $('#mensajeNotification').removeClass("alert alert-success text-center").addClass(
                            "alert alert-primary text-center");

                        if (respuestaPeticion == 'sendCancelar') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }

                        if (respuestaPeticion == 'cancelAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }

                        if (respuestaPeticion == 'existAfterReceived') {
                            mensajeNotification.innerText = 'Solo puedes cancelar una vez esta Solicitud de Amistad';
                        }

                        if (respuestaPeticion == 'deleteReceivedAfterReceived') {
                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
                        }


                    })
                    .fail(function() {
                        console.log('error');
                    })
                    .always(function() {
                        console.log('completo');
                    });
            });

            function hide(element) {
                element.style.display = "none";
            }

            function show(element) {
                element.style.display = "block";
            }
        </script>

        {{-- $.ajax({
        type: "GET",
        url: "{{ route('btnValidarAmistad') }}",
        data: {
        usuarioLogin: usuarioLogin.value,
        usuarioSeguido: usuarioSeguido.value,
        solicitudAmistad: solicitudAmistad.value
        },
        })

        .done(function(respuestaPeticion) {

        console.log(respuestaPeticion);

        if (respuestaPeticion == 'sendAgregarContacto') {
        hide(btnCancelarSolicitud);
        show(btnAgregarContacto);
        $('#btnAgregarContacto').addClass("btn btn-success");
        }

        if(respuestaPeticion == 'sendCancelarContacto'){
        hide(btnAgregarContacto);
        show(btnCancelarSolicitud);
        $('#btnCancelarSolicitud').addClass("btn btn-primary")
        }

        // if(respuestaPeticion == 'receivedCancelarContacto'){
        // hide(btnAgregarContacto);
        // show(btnCancelarSolicitud);
        // $('#btnCancelarSolicitud').addClass("btn btn-primary")
        // }

        // if(respuestaPeticion == 'receivedAgregarContacto'){
        // hide(btnCancelarSolicitud);
        // show(btnAgregarContacto);
        // $('#btnAgregarContacto').addClass("btn btn-success");
        // }

        })
        .fail(function() {
        console.log('error');
        })
        .always(function() {
        console.log('completo');
        });

        btnAgregarContacto?.addEventListener('click', (event) => {

        $.ajax({
        type: "GET",
        url: "{{ route('agregarContacto') }}",
        data: {
        usuarioLogin: usuarioLogin.value,
        usuarioSeguido: usuarioSeguido.value,
        solicitudAmistad: solicitudAmistad.value,
        },
        })
        .done(function(respuestaPeticion) {

        hide(btnAgregarContacto);
        show(btnCancelarSolicitud);
        $('#btnCancelarSolicitud').addClass("btn btn-primary")

        $('#mensajeNotification').html(respuestaPeticion);

        console.log(respuestaPeticion);

        if (respuestaPeticion == 'send') {
        $('#mensajeNotification').addClass('alert alert-success text-center');
        mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
        }

        // if (respuestaPeticion == 'addAfterReceiving') {
        // $('#mensajeNotification').addClass('alert alert-success text-center');
        // mensajeNotification.innerText = 'Solicitud de Amistad Aceptada';
        // }

        })
        .fail(function() {
        console.log('error');
        })
        .always(function() {
        console.log('completo');
        });
        });

        btnCancelarSolicitud?.addEventListener('click', (event) => {

        $.ajax({
        type: "GET",
        url: "{{ route('cancelarContacto') }}",
        data: {
        usuarioLogin: usuarioLogin.value,
        usuarioSeguido: usuarioSeguido.value,
        solicitudAmistad: solicitudAmistad.value
        },
        })
        .done(function(respuestaPeticion) {

        hide(btnCancelarSolicitud);
        show(btnAgregarContacto);
        $('#btnAgregarContacto').addClass("btn btn-success");

        $('#mensajeNotification').html(respuestaPeticion);

        console.log(respuestaPeticion);

        if (respuestaPeticion == 'sendCancelar' || respuestaPeticion == 'receivedCancelar') {

        $('#mensajeNotification').removeClass("alert alert-success text-center").addClass(
        "alert alert-primary text-center");

        mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';
        }
        })
        .fail(function() {
        console.log('error');
        })
        .always(function() {
        console.log('completo');
        });
        });


        function hide(element) {
        element.style.display = "none";
        }

        function show(element) {
        element.style.display = "block";
        } --}}
    @endpush
@endsection
