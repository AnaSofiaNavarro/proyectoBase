@props([
    'titulo',
    'subtitulo' => null,
    'imagen' => null,
    'alt' => '',
    'link' => '#',
    'tipoContenido' => null,
    'archivo' => null,
    'target' => false,
    'fecha' => null,
])

@php
    use Carbon\Carbon;

    $extension = null;
    $tamañoFormateado = null;

    if ($tipoContenido == 2 && $archivo) {
        $rutaArchivo = public_path('/storage/anexos/' . $archivo);
        if (file_exists($rutaArchivo)) {
            $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
            $tamañoArchivo = filesize($rutaArchivo);
            $tamañoFormateado = formatBytes($tamañoArchivo);
        }
    }

    $mostrarImagen = $imagen ?? null;

    if (!$mostrarImagen && $tipoContenido == 2 && in_array($extension, ['jpg', 'jpeg', 'png'])) {
        $mostrarImagen = asset('storage/anexos/' . $archivo);
    }

    $icono = match (true) {
        $tipoContenido == 1 => 'fa-newspaper',
        $tipoContenido == 2 && $extension == 'pdf' => 'fa-file-pdf',
        $tipoContenido == 2 && in_array($extension, ['doc', 'docx']) => 'fa-file-word',
        $tipoContenido == 2 && $extension == 'mp4' => 'fa-video',
        $tipoContenido == 3 => 'fa-link',
        default => 'fa-file',
    };

    $TextoBoton = match (true) {
        $tipoContenido == 1 => 'Ver más',
        $tipoContenido == 2 => '<i class="fa-solid fa-download me-1"></i> Descargar',
        $tipoContenido == 3 => 'Ir al sitio',
        default => 'Ver más',
    };

    $esIcono = !$mostrarImagen;
    $fechaFormateada = $fecha ? Carbon::parse($fecha)->locale('es')->isoFormat('dddd DD [de] MMMM [de] YYYY') : null;
@endphp

<a href="{{ $link }}" @if ($target) target="_blank" @endif
    class="text-decoration-none text-dark" style="max-width: 540px;">
    <div class="card mb-2 shadow-inner border border-1">
        <div class="row g-0 h-100">
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3 border border-r-1 ">
                @if ($esIcono)
                    <i class="ml-3 fa-solid {{ $icono }} fa-5x" style="color: #C90166;"></i>
                @else
                    <img src="{{ $mostrarImagen }}" class=" ml-3 mr-1  img-fluid rounded-3" alt="{{ $alt }}"
                        style="max-height: 170px; object-fit: cover;">
                @endif
            </div>
            <div class="col-md-8 d-flex p-0">
                <div class="card-body d-flex flex-column justify-content-between h-100" style="overflow: hidden;">
                    <div>
                        @if ($subtitulo)
                            <h5 class="card-title text-muted" style="font-weight:500; font-size:1rem">
                                {{ $subtitulo }}
                            </h5>
                        @endif
<p class="card-text fw-bold m-0 px-1 titulo-fijo">
    {{ $titulo }}
</p>

                        @if ($tipoContenido == 2 && $extension && $tamañoFormateado)
                            <p class="card-text"><small class="text-muted">Formato: <b
                                        class="text-uppercase">{{ $extension }}</b> Tamaño:
                                    <b>{{ $tamañoFormateado }}</b></small></p>
                        @endif
                        @if ($fechaFormateada)
                            <p class="card-text"><small class="text-muted">{{ $fechaFormateada }}</small></p>
                        @endif
                    </div>
                    <div>
                        <button class="btn btn-sm btn-card mt-3 px-4">{!! $TextoBoton !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
