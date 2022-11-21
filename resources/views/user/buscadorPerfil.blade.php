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
                                        <button type="button" id="btnAgregarContacto"
                                            class="btn btn-success">{{ $idFollower == 0 ? 'Agregar Contacto' : 'Confirmar' }}
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

                            <div id="mensajeAgregarAmigo" role="alert"></div>

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

                                {{-- Perfil --}}
                                <div class="tab-pane fade show {{ session('message') || $errors->any() ? '' : 'active' }} profile-overview"
                                    id="perfil">
                                    <h5 class="card-title">Sobre Mi</h5>
                                    <p class="small">{{ Auth::user()->sobreMi }}</p>

                                    <h5 class="card-title">Detalles de mi Perfil</h5>

                                    <input type="hidden" id="idNotificacion" value="{{ $idNotificacion }}">

                                    <input type="hidden" id="idFollower" value="{{ $idFollower }}">

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
            let btnAgregarContacto = document.getElementById('btnAgregarContacto');
            let usuarioLogin = document.getElementById('usuarioLogin');
            let usuarioSeguido = document.getElementById('usuarioSeguido');
            let solicitudAmistad = document.getElementById('solicitudAmistad');
            let idFollower = document.getElementById('idFollower');
            let idNotificacion = document.getElementById('idNotificacion');

            if (btnAgregarContacto) {

                btnAgregarContacto.addEventListener('click', (event) => {

                    $.ajax({
                            type: "GET",
                            url: "{{ route('agregarContacto') }}",
                            data: {
                                usuarioLogin: usuarioLogin.value,
                                usuarioSeguido: usuarioSeguido.value,
                                solicitudAmistad: solicitudAmistad.value,
                                idFollower: idFollower.value,
                                idNotificacion: idNotificacion.value,
                            },
                        })
                        .done(function(respuestaPeticion) {

                            $('#mensajeAgregarAmigo').html(respuestaPeticion);

                            // $('#mensajeAgregarAmigo').addClass('alert alert-success text-center');

                            // if (respuestaPeticion == 1) {
                            //     mensajeAgregarAmigo.innerText = 'La solicitud se ha enviado correctamente';
                            // } else {
                            //     mensajeAgregarAmigo.innerText = 'Ya se ha enviado la solicitud';
                            // }

                        })
                        .fail(function() {
                            console.log('error');
                        })
                        .always(function() {
                            console.log('completo');
                        });
                });
            }
        </script>
    @endpush
@endsection
