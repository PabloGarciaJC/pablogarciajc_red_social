<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    @guest
        @yield('content')
    @else
        <main class="py-4">
            {{-- Menu NAV --}}
            <header id="header" class="header fixed-top d-flex align-items-center">

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="">
                        <span class="d-none d-lg-block">PabloSocial</span>
                    </a>
                </div>

                <div class="search-bar">
                    <form class="search-form d-flex align-items-center" id='formBuscador' method="POST" action="#">
                        <input type="text" name="search" id="search" placeholder="Buscar en PabloSocial"
                            title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <nav class="header-nav ms-auto">
                    <ul class="d-flex align-items-center">

                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link nav-icon search-bar-toggle " href="#">
                                <i class="bi bi-search"></i>
                            </a>
                        </li>

                        {{-- Notificaciones --}}

                        <li class="nav-item dropdown">

                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span
                                    class="badge bg-primary badge-number">{{ count(auth()->user()->unReadNotifications) }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                                id="notificacionesAmistad">

                                <li class="dropdown-header">
                                    Tú tienes {{ count(auth()->user()->unReadNotifications) }} solicitud de amistad
                                    {{-- Tú tienes {{ count(auth()->user()->notifications) }} solicitud de amistad --}}
                                </li>

                                @foreach (auth()->user()->unReadNotifications as $notification)
                                {{-- @foreach (auth()->user()->notifications as $notification) --}}
                                    <a
                                        href="{{ route('usuarioBuscador.perfil', ['perfil' => $notification->data['alias'], 'solicitudAmistad' => 1, 'idFollower' => $notification->data['idFollower'], 'idNotificacion' => $notification->id]) }}">
                                        <li class="notification-item">
                                            <img src=" {{ route('foto.perfil', ['filename' => $notification->data['fotoPerfil']]) }} "
                                                width="60"
                                                style="border-radius: 10px; padding: 0px; margin-right: 10px; margin-top: -10px"
                                                alt="">
                                            <div>
                                                <h4>{{ $notification->data['alias'] }}</h4>
                                                <p>{{ $notification->data['mensaje'] }}</p>
                                            </div>
                                        </li>
                                    </a>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endforeach

                                <li class="dropdown-footer">
                                    <a href="{{ route('markAsRead') }}">Marcar todo como leído</a><br>
                                    <a href="{{ route('borrarNotificacion', ['id' => auth()->id()]) }}">Borrar todas las
                                        notificaciones</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Perfil --}}
                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                data-bs-toggle="dropdown">

                                @if (Auth::user()->fotoPerfil)
                                    <img src="{{ route('foto.perfil', ['filename' => Auth::user()->fotoPerfil]) }}"
                                        alt="Profile" class="rounded-circle">
                                @else
                                    <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile"
                                        class="rounded-circle">
                                @endif

                                <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->alias }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <h6>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h6>
                                    <span>{{ Auth::user()->cargo }}</span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('perfil') }}">
                                        <i class="bi bi-gear"></i>
                                        <span>Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="dropdown-item d-flex align-items-center"><i
                                                class="bi bi-box-arrow-right"></i>Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
            {{-- //Menu NAV --}}

            {{-- Sidebar --}}
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('home') }}">
                            <i class="bi bi-grid"></i>
                            <span>Inicio</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="pages-contact.html">
                            <i class="bi bi-envelope"></i>
                            <span>Contactos</span>
                        </a>
                    </li>
                </ul>
            </aside>
            {{-- //Sidebar --}}

            {{-- Contenido Dinamico --}}
            @yield('dynamic-content')
            {{-- /Contenido Dinamico --}}
        </main>

        {{-- Foter --}}
        <footer id="footer" class="footer">
            <div class="copyright">
                Desarrollado por <strong><span>Pablo Garcia JC</span></strong>
            </div>
        </footer>
        {{-- /Footer --}}
    @endguest

    <!-- Vendor JS Files -->
    {{-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="assets/vendor/chart.js/chart.min.js"></script> --}}
    {{-- <script src="assets/vendor/echarts/echarts.min.js"></script> --}}
    {{-- <script src="assets/vendor/quill/quill.min.js"></script> --}}
    {{-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> --}}
    {{-- <script src="assets/vendor/tinymce/tinymce.min.js"></script> --}}
    {{-- <script src="assets/vendor/php-email-form/validate.js"></script> --}}
    {{-- <script src="assets/vendor/jquery/jquery-3.6.1.min.js"></script> --}}
    {{-- <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Anexos de JS --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/config/parameters.js') }}"></script>
    <script src="{{ asset('assets/js/user/autocompletado.js') }}"></script>
    <script src="{{ asset('assets/js/user/cambiar-imagen-configuracion.js') }}"></script>
    <script src="{{ asset('assets/js/comments/mostrar-ocultar.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

    {{-- Autocompletado CSS --}}
    <style>
        .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
            padding: 0px;
            border-radius: 10px;
            border-color: #ffffff;
            background: #3c249c !important;
            font-weight: bold !important;
            color: #ffffff !important;
        }
    </style>
</body>

</html>
