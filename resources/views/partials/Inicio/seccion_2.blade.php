<article class="container-fluid p-0 px-3 px-md-6 mb-5">
    <header class="mt-5 mb-4">
        <h2 class="text-persian-green fw-bolder">
            ¿QUÉ SON LOS MASC (MEDIOS ALTERNATIVOS DE SOLUCIÓN DE CONFLICTOS)?
        </h2>
    </header>

    <section>
        <h4 class="text-persian-green fw-semibold mb-4">
            Medios alternativos de solución de conflictos
        </h4>
        <p class='fw-medium'>
            Son procedimientos no judiciales que, a través de la amigable composición, la buena fe y la voluntad de las personas interesadas, generan un cambio sustancial en la conducta social. Estos mecanismos construyen una justicia basada en la reconciliación entre las partes, mediante la intervención de un especialista público, cuyo desempeño permite encontrar una forma armoniosa de resolver los conflictos.
            <b class="text-magenta">
                Los MASC, contemplados por la Ley de Justicia Alternativa del Estado de Chiapas, son:
            </b>
        </p>
    </section>

    <section class="d-grid gap-4 mt-4" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
        @foreach([
        ['number' => 1, 'title' => 'Negociación', 'image' => 'Icons/Ico-negociacion.svg'],
        ['number' => 2, 'title' => 'Negociación colaborativa', 'image' => 'Icons/Ico-negociacion-colaborativa.svg'],
        ['number' => 3, 'title' => 'Mediación', 'image' => 'Icons/Ico-mediacion.svg'],
        ['number' => 4, 'title' => 'Conciliación', 'image' => 'Icons/Ico-conciliacion.svg'],
        ['number' => 5, 'title' => 'Arbitraje', 'image' => 'Icons/Ico-arbitraje.svg'],
        ['number' => 6, 'title' => 'Justicia restaurativa', 'image' => 'Icons/Ico-restaurativa.svg'],
        ] as $masc)
        <article class="bg-white rounded-xl p-3 d-flex flex-column align-items-center text-center h-100">
            <p class="text-persian-green fw-bolder mb-1 fs-1 ">{{ $masc['number'] }}</p>
            <h4 class="text-magenta fw-bolder mb-2" style="min-height: 2.5em; line-height: 1.2;">
                {{ $masc['title'] }}
            </h4>
            <figure class="m-0 mb-3">
                <img src="{{ asset('assets/' . $masc['image']) }}" alt="{{ $masc['title'] }}" style="height: 5rem; object-fit: contain;">
            </figure>
            <button class="btn rounded-pill btn-persian-green text-white px-4 mt-auto">
                Saber más
            </button>
        </article>
        @endforeach
    </section>
</article>
