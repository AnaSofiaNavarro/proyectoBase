<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $config->descripcion }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon_redondo.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}" />

    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    {{--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- scripts para los datatables -->
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 pleca"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center" style="min-height: 80px;">
                    <div class="col-12 cursor-default user-select-none" style="border-bottom: 3px solid #C90166;">
                        <nav class="navbar navbar-expand-lg navbar-light h-100">
                            @if ($config->imagen)
                                <a class="navbar-brand p-0 cursor-default user-select-none" href="{{ url('/') }}">
                                    <img class="d-block rounded"
                                        src="{{ asset('storage/configuraciones/' . $config->imagen) }}"
                                        alt="Poder Judicial del Estado de Chiapas" style="max-height: 80px;">
                                </a>
                            @endif

                            <div class="header-container">
                                <div class="header-left">
                                    <div class="separator"></div>
                                    <div class="header-title">
                                        <p class="title">{{ $config->nombre }}</p>
                                        <p class="subtitle">{{ $config->descripcion }}</p>
                                    </div>
                                </div>
                            </div>

                            <button class="navbar-toggler custom-toggler ml-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Activar navegación">
                                <i class="fas fa-bars barras"></i>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ol class="navbar-nav me-auto mb-2 mb-lg-0" style="justify-content: center; gap:4;">
                                    @foreach ($apartados as $apartado)
                                        @if ($apartado->enlace)
                                            <li class="nav-item">
                                                <a class="nav-link tituloMenu fs-6 p-2 cursor-default user-select-none"
                                                    href="{{ $apartado->url }}"
                                                    @if ($apartado->target) target="_blank" @endif>
                                                    {{ $apartado->apartado }}
                                                    @if ($apartado->target)
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                    @endif
                                                </a>
                                            </li>
                                        @elseif ($apartado->menu)
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle tituloMenu fs-6 cursor-default user-select-none"
                                                    href="#" id="Dropdown{{ $apartado->slug }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $apartado->apartado }}
                                                </a>
                                                <div class="dropdown-menu pb-0"
                                                    aria-labelledby="Dropdown{{ $apartado->slug }}">
                                                    @php
                                                        $secciones = App\Models\Seccion::where([
                                                            ['fkapartado', $apartado->idapartado],
                                                            ['activo', 1],
                                                        ])
                                                            ->orderBy('orden', 'asc')
                                                            ->get();
                                                        $divisionactual = '';
                                                        $divisionanterior = '';
                                                    @endphp
                                                    @foreach ($secciones as $key => $seccion)
                                                        @php $divisionactual = $seccion->division; @endphp
                                                        @if ($divisionactual !== $divisionanterior)
                                                            @if ($key > 0 && $divisionanterior !== null)
                                                                <div class="dropdown-divider"></div>
                                                            @endif
                                                            <a class="dropdown-item disabled subMenuRosa" tabindex="-1"
                                                                aria-disabled="true">{{ $seccion->division }}</a>
                                                            @php $divisionanterior = $divisionactual; @endphp
                                                        @endif
                                                        @if ($seccion->enlace)
                                                            <a class="dropdown-item" href="{{ $seccion->url }}"
                                                                @if ($seccion->target) target="_blank" @endif>
                                                                {{ $seccion->seccion }}
                                                                @if ($seccion->target)
                                                                    <i
                                                                        class="fa-solid fa-arrow-up-right-from-square"></i>
                                                                @endif
                                                            </a>
                                                        @else
                                                            <a class="dropdown-item @if (Request::is('/seccion/' . $seccion->slug)) active @endif"
                                                                href="{{ url('/seccion/' . $seccion->slug) }}">
                                                                {{ $seccion->seccion }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link fs-6 p-2 tituloMenu"
                                                    href="{{ url('/apartado/' . $apartado->slug) }}">{{ $apartado->apartado }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>

                                @if ($config->busqueda_activa)
                                <!-- Buscador principal que solo abre el modal -->
                                <form id="abrir-modal-busqueda" role="search" class="d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn rounded-circle d-none d-lg-flex align-items-center justify-content-center search-btn-zoom"
                                        style="width: 48px; height: 48px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: transform 0.2s;">
                                        <i class="fa-solid fa-magnifying-glass" style="font-weight: bold; font-size: 1.4rem;"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-lg px-5 d-flex d-lg-none align-items-center justify-content-center"
                                        style="cursor:text; min-width: 100px;">
                                        Buscar
                                    </button>
                                </form>
                                <style>
                                    .search-btn-zoom:hover {
                                        transform: scale(1.1);
                                    }
                                </style>
                                @endif

                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


        <div class="floating-buttons">
            <button onclick="scrollToTop()" class="btnGreen" aria-label="Subir al inicio"
                style="background: none; border: none;">
                <img src="/assets/img/Ico-top.svg" alt="Subir" class="img-fluid">
            </button>
            <a href="" id="INDmenu-btn" rel="noopener noreferrer"><img class="img-fluid"
                    src="/assets/img/btn-discapacidad.svg" alt="Accesibilidad"></a>
        </div>
    </div>

</body>


<main id="main" style="min-height: 75vh;">
    @yield('contenido')
</main>

<!-- FOOTER DEPENDENCIA -->

<!-- FOOTER PORTAL DE GOBIERNO -->
<footer>
    <div class="container-fluid bg-dark d-sm-block">
        <div class="row py-5">
            <!-- Primera columna: Logo alineado a la izquierda -->
            <div
                class="col-md-2 col-sm-12 text-md-end text-center py-3 d-flex align-items-start justify-content-md-end justify-content-center">
                <img src="/assets/img/footer/Logo-footer-pj.svg" alt="Poder Judicial del Estado de Chiapas"
                    style="width: 120px; height: auto;">
            </div>

            <!-- Segunda columna: Texto centrado -->
            <div class="col-md-5 col-sm-12 text-center d-flex flex-column justify-content-center">
                <p class="textoFooter text-left  ">
                    <b>
                        Tribunal Superior de Justicia Consejo de la Judicatura Responsable:
                    </b>
                    Mtra. Guadalupe del Rocío Santos Acosta<br>
                    Titular de la Unidad de Transparencia<br>
                    Palacio de Justicia Libramiento Norte No. 2100<br>
                    Fraccionamiento El Bosque. C.P. 29047 Tuxtla Gutiérrez,<br>
                    Chiapas. Tel (961) 78700
                </p>
            </div>

            <!-- Tercera columna: Información del sitio -->
            <div
                class="col-md-5 col-sm-12 text-center d-flex flex-column justify-content-start align-items-md-center align-items-sm-start">
                <p class="textoFooter text-left  ">
                    <b>
                        Sitio creado por
                    </b><br>
                    Dirección de Desarrollo e Infraestructura Tecnológica<br>
                    Departamento de Diseño e Imagen Institucional<br>
                    Departamento de Desarrollo de Sistemas<br>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 plecaFooter"></div>
        </div>
    </div>
</footer>



</html>

<!-- Modal -->
<div class="modal fade" id="modalBusqueda" tabindex="-1" aria-labelledby="modalBusquedaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input id="input-busqueda-modal" type="text" class="form-control border-start-0"
                        placeholder="Escribe para buscar..." autofocus>
                </div>

                <div id="resultados-busqueda-modal">
                    <div class="text-center text-muted">Escribe para ver los resultados.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('abrir-modal-busqueda').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('modalBusqueda'));
        modal.show();

        setTimeout(() => {
            document.getElementById('input-busqueda-modal')?.focus();
        }, 300);
    });

    // También puedes enfocar el input cuando el modal se muestre por cualquier medio
    document.getElementById('modalBusqueda').addEventListener('shown.bs.modal', function() {
        document.getElementById('input-busqueda-modal')?.focus();
    });
</script>

<script>
    let timeout = null;
    const inputBusqueda = document.getElementById('input-busqueda-modal');
    const resultadosContenedor = document.getElementById('resultados-busqueda-modal');

    function cargarResultados(url) {
        fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                resultadosContenedor.innerHTML = html;
                prepararPaginacion(); // <- vuelve a conectar los links de paginación
            })
            .catch(() => {
                resultadosContenedor.innerHTML =
                    '<div class="text-danger">Error en la búsqueda.</div>';
            });
    }

    function prepararPaginacion() {
        resultadosContenedor.querySelectorAll('.pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                if (url) {
                    cargarResultados(url);
                }
            });
        });
    }

    inputBusqueda?.addEventListener('input', function() {
        clearTimeout(timeout);

        const query = this.value.trim();
        if (query.length === 0) {
            resultadosContenedor.innerHTML =
                '<div class="text-center text-muted">Escribe para ver los resultados.</div>';
            return;
        }

        timeout = setTimeout(() => {
            const url = `{{ route('busqueda.general') }}?q=${encodeURIComponent(query)}`;
            cargarResultados(url);
        }, 300);
    });
</script>


<script>
    window.onscroll = function() {
        let btn = document.getElementById("btnTop");
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            btn.style.display = "block";

        } else {
            btn.style.display = "none";
        }
    };

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
</script>



<script>
    window.interdeal = {
        "sitekey": "e6c80a4853ba94d1c4774ac5ab7d50f2",
        "Position": "right",
        "domains": {
            "js": "https://cdn.equalweb.com/",
            "acc": "https://access.equalweb.com/"
        },
        "Menulang": "ES",
        "btnStyle": {
            "vPosition": [
                "20%",
                "20%",
            ],
            "scale": [
                "0.7",
                "0.7"
            ],
            "color": {
                "main": "#009684",
                "second": "#ffffff"
            },
            "icon": {
                "outline": false,
                "type": 13,
                "shape": "circle"
            }
        }
    };
    (function(doc, head, body) {
        var coreCall = doc.createElement('script');
        coreCall.src = interdeal.domains.js + 'core/5.0.13/accessibility.js';
        coreCall.defer = true;
        coreCall.integrity =
            'sha512-pk3CeR0KGJu+GfK2x2ybTSZ1o1qfua6XW2PRAxMWOhC85M3+CanPYmvRp6BOiW0/riZjWGerRN7+JH4wEF0wJQ==';
        coreCall.crossOrigin = 'anonymous';
        coreCall.setAttribute('data-cfasync', true);
        body ? body.appendChild(coreCall) : head.appendChild(coreCall);
    })(document, document.head, document.body);


    document.querySelector('#INDmenu-btn.INDcircle-btn').style.right = '40px !important';
</script>
