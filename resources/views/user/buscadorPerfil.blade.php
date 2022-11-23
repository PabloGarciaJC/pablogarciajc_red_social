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
                                    {{-- 
                                    <form action="" method="POST">
                                 
                                    {{ csrf_field() }}

                                    </form> --}}

                                    <div class="col-md-auto">
                                        <button type="button" id="btnAgregarContacto" style="display:none">
                                            Agregar Contacto
                                        </button>
                                        <button type="button" id="btnCancelarSolicitud" style="display:none">
                                            Cancelar Solicitud
                                        </button>
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

                            </ul>
                            {{-- //Menu de Navegacion --}}

                            <div class="tab-content pt-2">

                                <div id="tes" role="alert"></div>

                                {{-- Mensaje de Notificacion --}}
                                <div id="mensajeNotification" role="alert"></div>

                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>

                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    <input type="hidden" id="idNotificacion" value="{{ $idNotificacion }}">

                                    <input type="hidden" id="idRegistroFollower" value="{{ $idFollower }}">

                                    <input type="hidden" id="solicitudAmistad" value="{{ $solicitudAmistad }}">

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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('scripts')
        <script>
            /* Tes */
            let btnAddContacto = document.getElementById('btnAddContacto');

            let btnAgregarContacto = document.getElementById('btnAgregarContacto');
            let btnCancelarSolicitud = document.getElementById('btnCancelarSolicitud');

            let usuarioLogin = document.getElementById('usuarioLogin');
            let usuarioSeguido = document.getElementById('usuarioSeguido');
            // let solicitudAmistad = document.getElementById('solicitudAmistad');

            let idRegistroFollower = document.getElementById('idRegistroFollower');
            let idNotificacion = document.getElementById('idNotificacion');

            let idNotificacionEnviado = document.getElementById('idNotificacionEnviado');


            $.ajax({
                    type: "GET",
                    url: "{{ route('btnValidarAmistad') }}",
                    data: {
                        usuarioLogin: usuarioLogin.value,
                        usuarioSeguido: usuarioSeguido.value,
                        solicitudAmistad: solicitudAmistad.value
                    },
                })

                .done(function(respuestaPeticion) {

                    // $('#tes').html(respuestaPeticion);

                    if (respuestaPeticion == 1) {

                        show(btnCancelarSolicitud);
                        $('#btnCancelarSolicitud').addClass("btn btn-primary");

                    } else {

                        show(btnAgregarContacto);
                        $('#btnAgregarContacto').addClass("btn btn-success");
                    }

                    // if (respuestaPeticion == 0) {

                    //     show(btnAgregarContacto);
                    //     // show(btnAgregarContacto);
                    //     // $('#btnAgregarContacto').addClass("btn btn-success");
                    //     $('#btnAgregarContacto').addClass("btn btn-primary");
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
                            idRegistroFollower: idRegistroFollower.value,
                            idNotificacion: idNotificacion.value
                        },
                    })
                    .done(function(respuestaPeticion) {

                        hide(btnAgregarContacto);
                        show(btnCancelarSolicitud);

                        $('#mensajeNotification').html(respuestaPeticion);

                        if (respuestaPeticion == 'solicitudEnviada') {
                            $('#mensajeNotification').addClass('alert alert-success text-center');
                            mensajeNotification.innerText = 'Solicitud de Amistad Enviada';
                        }

                        if (respuestaPeticion == 'solicitudAceptada') {
                            $('#mensajeNotification').addClass('alert alert-success text-center');
                            mensajeNotification.innerText = 'Solicitud de Amistad Confirmada';
                        }

                        $('#btnCancelarSolicitud').addClass("btn btn-primary");

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
                            solicitudAmistad: solicitudAmistad.value
                            // idFollower: idFollower.value,
                        },
                    })
                    .done(function(respuestaPeticion) {

                        $('#mensajeNotification').html(respuestaPeticion);

                        if (respuestaPeticion == 1) {

                            hide(btnCancelarSolicitud);
                            show(btnAgregarContacto);

                            $('#mensajeNotification').removeClass("alert alert-success text-center").addClass(
                                "alert alert-primary text-center");

                            mensajeNotification.innerText = 'Solicitud de Amistad Cancelada';

                            $('#btnAgregarContacto').addClass("btn btn-success");
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
    @endpush
@endsection
