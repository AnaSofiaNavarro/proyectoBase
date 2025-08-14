        @if ($resultados->count())
            <div class="list-group w-100">
                @foreach ($resultados as $contenido)
                    <div
                        class="bg-light  list-group-item list-group-item-action flex-column align-items-start mb-3 shadow-sm rounded px-4">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <h5>{{ $contenido->encabezado }}</h5>
                            </div>

                            <small class="text-muted text-nowrap">
                                {{ $contenido->fecha ? \Carbon\Carbon::parse($contenido->fecha)->format('d/m/Y') : 'Sin fecha' }}
                            </small>
                        </div>

                        {{-- Descripción con coincidencias resaltadas --}}
                        @if (!empty($contenido->descripcion))
                            @php
                                $descripcion = strip_tags(html_entity_decode($contenido->descripcion));
                                $parrafos = preg_split('/\r\n|\r|\n|\<br\s*\/?\>|\<\/p\>|\<p\>/', $descripcion);
                                $parrafos = array_filter(array_map('trim', $parrafos));

                                $queryClean = preg_quote($query, '/');

                                // Buscar el primer párrafo que contenga la palabra buscada
                                $parrafoCoincidente = collect($parrafos)->first(function ($p) use ($queryClean) {
                                    return preg_match("/$queryClean/i", $p);
                                });

                                // Si no hay coincidencia, usar el primero
                                $parrafoMostrar = $parrafoCoincidente ?? (array_values($parrafos)[0] ?? '');

                                // Limitar el texto y resaltar coincidencia
                                $parrafoCorto = Str::limit($parrafoMostrar, 200, '...');
                                $parrafoResaltado = preg_replace("/($queryClean)/i", '<mark>$1</mark>', $parrafoCorto);
                            @endphp
                            <p class="mb-2 text-muted" style="white-space: normal;">{!! $parrafoResaltado !!}</p>
                        @endif

                        {{-- Etiquetas tipo --}}
                        <div class="mb-2 d-flex gap-2 flex-wrap">
                            @if ($contenido->archivo && Str::endsWith($contenido->archivo, '.pdf'))
                                <span class="badge text-bg-danger rounded-pill opacity-75">
                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                </span>
                            @endif

                            @if ($contenido->url)
                                <span class="badge text-bg-primary rounded-pill opacity-75">
                                    <i class="bi bi-link-45deg"></i> Enlace externo
                                </span>
                            @endif

                            @if ($contenido->imagen)
                                <span class="badge rounded-pill opacity-75"
                                    style="background-color: #009684; color: #fff;">
                                    <i class="bi bi-image"></i> Imagen
                                </span>
                            @endif

                            @if (!empty($contenido->seccionslug))
                                <span class="badge text-bg-success rounded-pill opacity-75">
                                    <i class="bi bi-folder2-open"></i> Contenido en sección
                                </span>
                            @endif
                            @if ($contenido->tipo_resultado === 'anexo')
                                <span class="badge text-bg-secondary rounded-pill opacity-75">
                                    <i class="bi bi-folder2-open"></i> Anexo en sección
                                </span>
                            @endif
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex flex-wrap gap-2">
                            @if ($contenido->archivo && Str::endsWith($contenido->archivo, '.pdf'))
                                <a href="{{ url('storage/anexos/' . basename($contenido->archivo)) }}"
                                    class="btn  btn-sm" target="_blank">
                                    {{-- <i class="bi bi-file-earmark-pdf-fill"></i>  --}}

                                    Ver PDF
                                </a>
                            @endif

                            @if ($contenido->imagen)
                                <a href="{{ url('storage/anexos/' . basename($contenido->imagen)) }}"
                                    class="btn  btn-sm" target="_blank">
                                    {{-- <i class="bi bi-file-earmark-pdf-fill"></i>  --}}

                                    Ver imagen
                                </a>
                            @endif


                            @if ($contenido->url)
                                <a href="{{ $contenido->url }}" class="btn  btn-sm" target="_blank">
                                    {{-- <i class="bi bi-link-45deg"></i>  --}}
                                    Ver enlace
                                </a>
                            @endif

                            @if (!empty($contenido->seccionslug))
                                <a href="{{ url('seccion/' . $contenido->seccionslug . '?q=' . urlencode($query) . '#contenido') }}"
                                    class="btn btn-sm">
                                    Ver en sección
                                </a>
                            @endif

                            @if (!empty($contenido->contenido->seccionslug) && $contenido->imagen)
                                <a href="{{ url('seccion/' . $contenido->contenido->seccionslug . '#imagenes') }}"
                                    class="btn btn-sm">
                                    {{-- <i class="bi bi-eye-fill"></i>  --}}
                                    Ver en sección
                                </a>
                            @endif

                            @if (!empty($contenido->contenido->seccionslug) && $contenido->archivo)
                                <a href="{{ url('seccion/' . $contenido->contenido->seccionslug . '#anexos') }}"
                                    class="btn btn-sm">
                                    {{-- <i class="bi bi-eye-fill"></i>  --}}
                                    Ver en sección
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-12 d-flex justify-content-center mt-5 mb-0">
                <div class="row col-auto">
                    {{ $resultados->appends(['q' => $query])->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                No se encontraron resultados para <strong>"{{ $query }}"</strong>.
            </div>
        @endif
