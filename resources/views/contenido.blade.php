@extends('welcome')

@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @php
        $anexosImagenes = $anexos->where('fktipo', 1)->values();
        $anexosVideos = $anexos->where('fktipo', 4)->values();
    @endphp





    <div class="container-fluid">
        <div class="textoinfo mt-5">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb bgGreen submenuComplemento">
                    <li class="breadcrumb-item "><a class="submenuInicio" href="{{ url('/') }}">Inicio</a></li>
                    @if ($apartado)
                        <li class="breadcrumb-item submenuInicio">{{ $apartado->apartado }}</li>
                    @endif
                    @if ($seccion)
                        @if ($seccion->division)
                            <li class="breadcrumb-item submenuInicio">{{ $seccion->division }}</li>
                        @endif
                        <li class="breadcrumb-item submenuInicio">{{ $seccion->seccion }}</li>
                    @endif
                    <li class="breadcrumb-item submenuInicio">{{ $dato->encabezado }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row container-fluid  my-5">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <img class="img-fluid " src="/assets/img/Greca-Titulo.svg"
                alt="Contenido del Poder Judicial del Estado de Chiapas">
            <h1 class="m-0 encabezado">{{ $dato->encabezado ?? '' }}</h1>
        </div>
    </div>
    @if ($anexos->where('fktipo', 1)->count() > 0)
        <div id="imagenes" class="mx-auto mb-5" style="max-width: 960px;">
            <div id="carouselImagenes" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner rounded overflow-hidden" style="height: 500px;">
                    @foreach ($anexos->where('fktipo', 1)->values() as $key => $item)
                        <div class="carousel-item @if ($key == 0) active @endif position-relative">
                            <img src="{{ asset('storage/anexos/' . $item->imagen) }}" alt="{{ $item->imagen }}"
                                class="w-100 h-100" style="object-fit: fill;">

                            @if ($item->descripcion)
                                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded mb-2">
                                    <h5 class="text-white">{{ $item->descripcion }}</h5>
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagenes"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImagenes"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    @endif

    @if ($dato->subtitulo)
        <div id="contenido" class="mx-3 mx-md-5 d-flex align-items-center gap-3">
            <i class="bi bi-chat-left-text fs-3" style="color: #009684;"></i>
            <h3 class="mb-0 titleTrata" style="color: #009684;">{{ $dato->subtitulo }}</h3>
        </div>
    @endif

    @php
        function resaltarPalabra($texto, $query)
        {
            if (!$query) {
                return $texto;
            }
            return preg_replace('/(' . preg_quote($query, '/') . ')/i', '<mark>$1</mark>', $texto);
        }
    @endphp

    @if ($dato->descripcion)
        <div class="contenido contenidoh3 mx-3 mx-md-5">
            {!! resaltarPalabra($dato->descripcion, $query) !!}
        </div>
    @endif


    @if ($anexos->where('fktipo', 4)->count() > 0)
        <div class="mx-auto " style="max-width: 960px;">
            <div id="carouselVideos" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
                <div class="carousel-inner rounded overflow-hidden">
                    @foreach ($anexos->where('fktipo', 4)->values() as $key => $item)
                        <div class="carousel-item @if ($key == 0) active @endif">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $item->url }}?controls=1&rel=0"
                                    title="Video relacionado"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen class="w-100 h-100 border-0">
                                </iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselVideos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselVideos" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
    @endif

    </div>


    @if (count($archivos) > 0)
        <div id="anexos" class="align-content-center px-md-5 px-3 py-3 my-5 d-flex align-items-center gap-1"
            style="background-color: #C90166;">
            <i class="bi bi-paperclip text-white fs-3"></i>
            <h3 class="titleTrata text-white mb-0">Anexos</h3>
        </div>
    @endif

    <div class="container-fluid pb-5">
        @if (count($archivos) > 0)
            <div class='row d-flex align-items-center justify-content-center gap-5 mx-2'>
                @foreach ($archivos as $item)
                    @php
                        $rutaArchivo = public_path('/storage/anexos/' . $item->archivo);
                        $extensionArchivo = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
                        $tamañoArchivo = filesize($rutaArchivo);
                        $tamañoFormateado = formatBytes($tamañoArchivo);
                    @endphp

                    <div class="card shadow-inner border border-1" style="width: 18rem;">
                        <div class="border-bottom text-center py-3">
                            <i class="fa-solid fa-file-pdf fa-4x" style="color: #C90166;"></i>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title line-clamp-2">
                                {{ $item->descripcion }}
                            </h5>
                            <p class="card-text text-muted small mb-0">
                                Formato: <b class="text-uppercase">{{ $extensionArchivo }}</b><br>
                                Tamaño: <b>{{ $tamañoFormateado }}</b><br>
                                Fecha publicación: <b>{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</b>
                            </p>

                            <a href="{{ url('/storage/anexos/' . $item->archivo) }}" class="btn btn-sm btn-card mt-3 px-4"
                                target="_blank">
                                <i class="fa-solid fa-download me-1"></i> Descargar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    @if ($dato->fuente || $dato->telefono || $dato->extension || $dato->correo)
        <div class="p-4 bg-light border border-1 rounded shadow-inner text-center">
            <h6 class="fw-bold mb-3 d-flex justify-content-center align-items-center gap-2 fs-5" style="color: #C90166;">
                <i class="bi bi-person-lines-fill fs-5"></i> Información de contacto
            </h6>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                @if ($dato->fuente)
                    <span
                        class="px-3 badge rounded-pill shadow-inner opacity-75 d-flex align-items-center gap-2 text-black"
                        style="background-color: #009684;">
                        <i class="bi bi-journal-text fs-5"></i>Fuente. {{ $dato->fuente }}
                    </span>
                @endif

                @if ($dato->telefono)
                    <a href="tel:+{{ $dato->telefono }}"
                        class=" px-3 badge rounded-pill text-decoration-none shadow-inner text-black opacity-75 d-flex align-items-center gap-2"
                        style="background-color: #C90166;">
                        <i class="bi bi-telephone fs-5"></i>Tel. {{ $dato->telefono }}
                    </a>
                @endif

                @if ($dato->extension)
                    <span
                        class="px-3 badge rounded-pill bg-secondary shadow-inner opacity-75 d-flex align-items-center gap-2 text-black">
                        <i class="bi bi-box-arrow-in-right fs-5"></i> Ext. {{ $dato->extension }}
                    </span>
                @endif

                @if ($dato->correo)
                    <a href="mailto:{{ $dato->correo }}"
                        class="px-3 badge rounded-pill text-decoration-none shadow-inner text-black opacity-75 d-flex align-items-center gap-2"
                        style="background-color: #009684;">
                        <i class="bi bi-envelope-at fs-5"></i>Correo. {{ $dato->correo }}
                    </a>
                @endif
            </div>
        </div>
    @endif


@endsection
