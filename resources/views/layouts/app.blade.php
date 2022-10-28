<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('assets/js/main.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

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
            {{-- Menu  --}}
            <header id="header" class="header fixed-top d-flex align-items-center">

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">PabloSocial</span>
                    </a>
                </div>

                <div class="search-bar">
                    <form class="search-form d-flex align-items-center" id='formBuscador' method="POST" action="#">
                        <input type="text" name="query" id="search" placeholder="Buscar en PabloSocial"
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

                        <li class="nav-item dropdown">

                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="badge bg-primary badge-number">4</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                                <li class="dropdown-header">
                                    You have 4 new notifications
                                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                            all</span></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="notification-item">
                                    <i class="bi bi-exclamation-circle text-warning"></i>
                                    <div>
                                        <h4>Lorem Ipsum</h4>
                                        <p>Quae dolorem earum veritatis oditseno</p>
                                        <p>30 min. ago</p>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="notification-item">
                                    <i class="bi bi-x-circle text-danger"></i>
                                    <div>
                                        <h4>Atque rerum nesciunt</h4>
                                        <p>Quae dolorem earum veritatis oditseno</p>
                                        <p>1 hr. ago</p>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="notification-item">
                                    <i class="bi bi-check-circle text-success"></i>
                                    <div>
                                        <h4>Sit rerum fuga</h4>
                                        <p>Quae dolorem earum veritatis oditseno</p>
                                        <p>2 hrs. ago</p>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="notification-item">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <div>
                                        <h4>Dicta reprehenderit</h4>
                                        <p>Quae dolorem earum veritatis oditseno</p>
                                        <p>4 hrs. ago</p>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="dropdown-footer">
                                    <a href="#">Show all notifications</a>
                                </li>

                            </ul><!-- End Notification Dropdown Items -->

                        </li>

                        <li class="nav-item dropdown">

                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-chat-left-text"></i>
                                <span class="badge bg-success badge-number">3</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                                <li class="dropdown-header">
                                    You have 3 new messages
                                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                            all</span></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="message-item">
                                    <a href="#">
                                        <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                        <div>
                                            <h4>Maria Hudson</h4>
                                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                            <p>4 hrs. ago</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="message-item">
                                    <a href="#">
                                        <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                        <div>
                                            <h4>Anna Nelson</h4>
                                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                            <p>6 hrs. ago</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="message-item">
                                    <a href="#">
                                        <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                        <div>
                                            <h4>David Muldon</h4>
                                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                            <p>8 hrs. ago</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">Show all messages</a>
                                </li>

                            </ul>

                        </li>

                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                data-bs-toggle="dropdown">

                                @if (Auth::user()->fotoPerfil)
                                    <img src="{{ route('foto.perfil', ['filename' => Auth::user()->fotoPerfil]) }}"
                                        alt="Profile" class="rounded-circle">
                                @else
                                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                @endif

                                <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nombre }}</span>
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
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}">
                                        <i class="bi bi-person"></i>
                                        <span>Mi Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('configuracion') }}">
                                        <i class="bi bi-gear"></i>
                                        <span>Configuración</span>
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
                                        {{-- <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Cerrar Sesión</span>
                                        </a> --}}
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
            {{-- //Menu  --}}

            {{-- Sidebar --}}
            <aside id="sidebar" class="sidebar">
                <ul class="sidebar-nav" id="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="index.html">
                            <i class="bi bi-grid"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ route('home') }}">
                            <i class="bi bi-person"></i>
                            <span>Mi Perfil</span>
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

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.min.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <script src="assets/vendor/jquery/jquery-3.6.1.min.js"></script>
        <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <script>
            /* Cambiar de imagen de configuracion */
            function vista_preliminar(event) {
                let leer_img = new FileReader();
                let id_img = document.getElementById('previe');

                leer_img.onload = () => {
                    if (leer_img.readyState == 2) {
                        id_img.src = leer_img.result;
                    }
                }
                leer_img.readAsDataURL(event.target.files[0]);
            }

            /* Mostrar y ocultar Comentarios */
            function mostrarOcultar() {
                var caja = document.getElementById('formularioComentario');
                if (caja.style.display == 'none') {
                    mostrarComentarios();
                } else {
                    ocultarComentarios();
                }
            }

            function mostrarComentarios() {
                document.getElementById('formularioComentario').style.display = 'block';
                console.log('block');
            }

            function ocultarComentarios() {
                document.getElementById('formularioComentario').style.display = 'none';
                console.log('none');
            }

            /* Capturo el valor del formulario del buscador */
            // let formBuscador = document.getElementById('formBuscador');

            // if (formBuscador) {
            //     search.addEventListener('keyup', (event) => {
            //         valorBuscador = event.path[0].value;
            //         console.log(valorBuscador);
            //     });
            // }

            /* Autocompletado */
            $("#search").autocomplete({
                source: "{{ route('search') }}",
                minLength: 1,
                select: function(event, ui) {
                    $("#search").val(ui.item.value);
                }
            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };
        </script>

        <style>
            .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
                /* border-color: #6693bc;
                    background: #6693bc !important;
                    font-weight: bold !important;
                    padding: 0px;
                    color: #ffffff !important;
                    transition: transform .2s;  */
                border-color: #6693bc;
                background: #6693bc !important;
                font-weight: bold !important;
                color: #ffffff !important;
            }
        </style>

        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')

    @endguest
</body>

</html>
