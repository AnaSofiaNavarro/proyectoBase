@foreach ($consulta as $item)
    @php
        $link = match (true) {
            $item->fktipocontenido == 1 && $item->apartado && $item->seccion => url('/seccion/' . $item->seccionslug . '/' . $item->contenidoslug),
            $item->fktipocontenido == 1 && $item->apartado => url('/apartado/' . $item->apartadoslug . '/' . $item->contenidoslug),
            $item->fktipocontenido == 2 => asset('storage/anexos/' . $item->archivo),
            $item->fktipocontenido == 3 => $item->url,
            default => '#',
        };
    @endphp

    <x-card-libro
        :titulo="$item->encabezado"
        :subtitulo="$item->subtitulo"
        :imagen="$item->imagen ? asset('storage/anexos/' . $item->imagen) : null"
        alt="{{ $item->imagen ?? $item->archivo }}"
        :link="$link"
        :tipoContenido="$item->fktipocontenido"
        :archivo="$item->archivo"
        :target="$item->target"
        :fecha="$item->fecha"
    />
@endforeach
