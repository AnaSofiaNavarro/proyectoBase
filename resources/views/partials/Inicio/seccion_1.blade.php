<article class="container-fluid px-0">
    <section class="my-5 mx-3 mx-md-6">
        <header>
            <h2 class="text-persian-green fw-bolder d-flex">BIENVENIDOS</h2>
        </header>
        <p class='fw-medium'>
            Este sitio fue creado con el objetivo de acercar nuestros
            <b>servicios de negociación, negociación colaborativa, mediación, conciliación y arbitraje</b>
            a todas las personas que necesiten ayuda en sus controversias familiares, civiles, mercantiles, penales,
            laborales burocráticas y sistema de justicia penal para adolescentes.
            Nuestros servicios son gratuitos y buscamos construir acuerdos que partan de la voluntad, la cooperación y el diálogo entre los interesados. Por una cultura de la paz.
        </p>
    </section>

    <section class="col-12 bg-iceberg d-flex flex-column align-items-center py-5">
        <h2 class="text-center fw-bolder mb-4">JUSTICIA ALTERNATIVA</h2>

        <div>
            <button class="btn rounded-pill text-white px-4 py-2">
                <h3 class="fw-bolder m-0 mx-4">Conoce nuestros principios</h3>
            </button>
        </div>

        <div class="container-fluid mt-5">
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach([
                ['title' => '¿Qué es la justicia alternativa?', 'image' => 'Icons/Ico-mediacion.svg'],
                ['title' => '¿Qué es el CEJA?', 'image' => 'Icons/Ico-mediacion.svg'],
                ['title' => '¿Beneficios?', 'image' => 'Icons/Ico-mediacion.svg'],
                ['title' => '¿Beneficios?', 'image' => 'Icons/Ico-mediacion.svg'],
                ['title' => '¿Beneficios?', 'image' => 'Icons/Ico-mediacion.svg'],

                ] as $card)
                <div class=" bg-white shadow-sm d-flex flex-column flex-md-row align-items-center justify-content-start p-4 rounded-xl hover" style="min-height: 160px; width:330px; border: 2px solid #009684;">
                    <figure class="mb-3 mb-md-0 me-md-4 flex-shrink-0">
                        <img src="{{ asset('assets/' . $card['image']) }}" alt="{{ $card['title'] }}" style="height: 5rem;">
                    </figure>
                    <figcaption class="text-md-start">
                        <h4 class="fw-bolder m-0" style="font-size: 1.1rem; line-height: 1.3;">
                            {{ $card['title'] }}
                        </h4>
                    </figcaption>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</article>
