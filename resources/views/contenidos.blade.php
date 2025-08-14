@extends('welcome')

@section('contenido')
<body>
    <div class="container-fluid">
        <div class="textoinfo my-5">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb bgGreen submenuComplemento">
                    <li class="breadcrumb-item submenuInicio"><a href="{{ url('/') }}"
                            style="all: unset; cursor: pointer;">Inicio</a></li>
                    @if ($apartado)
                        <li class="breadcrumb-item submenuInicio">{{ $apartado->apartado }}</li>
                    @endif
                    @if ($seccion)
                        @if ($seccion->division)
                            <li class="breadcrumb-item submenuInicio">{{ $seccion->division }}</li>
                        @endif
                        <li class="breadcrumb-item submenuInicio">{{ $seccion->seccion }}</li>
                    @endif

                </ol>
            </nav>
        </div>
    </div>


    <div class="container mb-5">
        <form method="GET">
            <input name="titulo" type="text" class="form-control inputBorder" placeholder="Buscar por título..."
                value="{{ $query ?? request('titulo') }}">
        </form>
    </div>
    <div class='container-fluid'>
        <div id="contenedor-cards" class='row d-flex align-items-center justify-content-center gap-4'>
            @foreach ($datos as $item)
                @php
                    $link = match (true) {
                        $item->fktipocontenido == 1 && $item->apartado && $item->seccion => url(
                            '/seccion/' . $item->seccionslug . '/' . $item->contenidoslug,
                        ),
                        $item->fktipocontenido == 1 && $item->apartado => url(
                            '/apartado/' . $item->apartadoslug . '/' . $item->contenidoslug,
                        ),
                        $item->fktipocontenido == 2 => asset('storage/anexos/' . $item->archivo),
                        $item->fktipocontenido == 3 => $item->url,
                        default => '#',
                    };
                @endphp

                <x-card-libro :titulo="$item->encabezado" :subtitulo="$item->subtitulo" :imagen="$item->imagen ? asset('storage/anexos/' . $item->imagen) : null"
                    alt="{{ $item->imagen ?? $item->archivo }}" :link="$link" :tipoContenido="$item->fktipocontenido" :archivo="$item->archivo"
                    :target="$item->target" :fecha="$item->fecha" />
            @endforeach
        </div>
    </div>


    <div class="col-12 d-flex justify-content-center my-5">
        <div class="row col-auto ">
            {{ $datos->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>   
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="titulo"]');
        const contenedor = document.getElementById('contenedor-cards');
        let timeout = null;

        const modo = "{{ $seccion ? 'seccion' : 'apartado' }}";
        const slug = "{{ $seccion->slug ?? $apartado->slug }}";

        input.addEventListener('keyup', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = input.value;

                fetch(`/ajax/${modo}/${slug}/filtrar?titulo=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        contenedor.innerHTML = html;
                    });
            }, 300);
        });
    });
</script>

</body>


@endsection
