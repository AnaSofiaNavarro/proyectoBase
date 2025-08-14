<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/ico/favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyARXT3C5cJ7pgk9pwhIPzEdASmMjCyhZjc"></script>

    <!-- Google Gráficas -->
    <script src="https://www.google.com/jsapi"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Fontawesome By CIRG -->
    {{-- <link rel="stylesheet" href="{{asset('fontawesome5/css/all.min.css')}}"/> --}}

    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}">

    <!-- Detepicker By CIRG -->
    <script src="{{ asset('datetimepicker/js/gijgo.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('datetimepicker/css/gijgo.min.css') }}">
    <!-- Detepicker languaje By CIRG -->
    <script src="{{ asset('datetimepicker/js/messages/messages.es-es.min.js') }}"></script>

    <!-- Checkbox By CIRG -->
    <link rel="stylesheet" href="{{ asset('checkbox/css/bootstrap4-toggle.min.css') }}">
    <script src="{{ asset('checkbox/js/bootstrap4-toggle.js') }}"></script>

    <!-- Custom File Input By CIRG -->
    <link rel="stylesheet" href="{{ asset('bs-custom-file-input/css/bs-custom-file-input.css') }}">
    <script src="{{ asset('bs-custom-file-input/js/bs-custom-file-input.min.js') }}"></script>

    <!-- Custom Tag Input By CIRG -->
    <link rel="stylesheet" href="{{ asset('tag-input/tagsinput.css') }}">
    <script src="{{ asset('tag-input/tagsinput.js') }}"></script>

    <!-- Custom Chosen By CIRG -->
    <link rel="stylesheet" href="{{ asset('chosen/component-chosen.min.css') }}">
    <script src="{{ asset('chosen/chosen.js') }}"></script>

    <!-- Custom Confirm By CIRG -->
    <link rel="stylesheet" href="{{ asset('confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('confirm/dist/jquery-confirm.min.js') }}"></script>

    <!-- Custom Ckeditor By CIRG -->
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

    <!-- Custom By CIRG -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Datatables -->
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="colorpersonal">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @auth

                            @can('viewAny', \App\Models\Configuracion::class)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-sliders-h colorpersonal"></i> Configuración<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item font-weight-bold" href="{{ url('/configuraciones') }}">
                                            <i class="fas fa-sliders-h colorpersonal"></i> Configuración
                                        </a>
                                    </div>
                                </li>
                            @endcan

                            @can('viewAny', \App\Models\Vseccion::class)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-sitemap colorpersonal"></i> Catálogos<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item font-weight-bold" href="{{ url('/apartados') }}">
                                            <i class="fas fa-project-diagram colorpersonal"></i> Apartados
                                        </a>
                                        <a class="dropdown-item font-weight-bold" href="{{ url('/secciones') }}">
                                            <i class="fas fa-project-diagram colorpersonal"></i> Secciones
                                        </a>
                                        @can('viewAny', \App\Models\Grupo::class)
                                            <a class="dropdown-item font-weight-bold" href="{{ url('/grupos') }}">
                                                <i class="fas fa-project-diagram colorpersonal"></i> Grupos
                                            </a>
                                        @endcan
                                        @can('viewAny', \App\Models\Vindicador::class)
                                            <a class="dropdown-item font-weight-bold" href="{{ url('/indicadores') }}">
                                                <i class="fas fa-project-diagram colorpersonal"></i> Indicadores
                                            </a>
                                        @endcan
                                    </div>
                                </li>
                            @endcan

                            @can('viewAny', \App\Models\Vcontenido::class)
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="{{ url('/contenidos') }}"><i
                                            class="fas fa-info-circle colorpersonal"></i> Contenidos</a>
                                </li>
                            @endcan

                            <li class="nav-item dropdown">
                                @can('viewAny', \App\Models\User::class)
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        <i class="fas fa-users colorpersonal"></i> Usuarios<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @can('viewAny', \App\Models\Role::class)
                                            <a class="dropdown-item font-weight-bold" href="{{ url('/roles') }}">
                                                <i class="fas fa-user-tag colorpersonal"></i> Roles
                                            </a>
                                        @endcan
                                        @can('viewAny', \App\Models\User::class)
                                            <a class="dropdown-item font-weight-bold" href="{{ url('/usuarios') }}">
                                                <i class="fas fa-user colorpersonal"></i> Usuarios
                                            </a>
                                        @endcan
                                    </div>
                                @endcan
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    @if (App::getLocale() == 'es')
                                        <img class="img-fluid traductorflag" src="{{ asset('assets/img/lang/es.png') }}"
                                            alt="es">
                                    @else
                                        <img class="img-fluid traductorflag" src="{{ asset('assets/img/lang/en.png') }}"
                                            alt="en">
                                    @endif <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item font-weight-bold"
                                        href="{{ route('set_language', ['es']) }}"><img class="img-fluid traductorflag"
                                            src="{{ asset('assets/img/lang/es.png') }}" alt="es"> Español</a>
                                    <a class="dropdown-item font-weight-bold"
                                        href="{{ route('set_language', ['en']) }}"><img class="img-fluid traductorflag"
                                            src="{{ asset('assets/img/lang/en.png') }}" alt="en"> Ingles</a>
                                </div>
                            </li>

                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Acceso') }}</a>
                        </li> --}}
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <i class="fas fa-user-tie colorpersonal"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item font-weight-bold" href="{{ route('cambiarpass') }}">
                                        <i class="fas fa-key colorpersonal"></i> Cambiar Contraseña
                                    </a>
                                    <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off colorpersonal"></i> {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
