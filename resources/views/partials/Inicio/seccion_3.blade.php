<article class="container-fluid bg-iceberg p-0 px-3 px-md-6 py-5">
    <header class="pb-5">
        <h2 class="fw-bolder m-0">CONOCE NUESTRO SERVICIO DE MEDIACIÓN</h2>
    </header>

    <section class="row g-3 align-items-stretch">
        <div class="col-12 col-md-6 col-lg-3">
            <x-mediacion-card title="Familiar" :items="[
                'Guarda y custodia',
                'Pensión alimenticia',
                'Acuerdo para divorcio por mutuo consentimiento',
                'Convivencias',
                'Liquidación de sociedad conyugal',
                'Otros'
            ]" />
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <x-mediacion-card title="Civil" :items="[
                'Deudas civiles',
                'Arrendamiento inmobiliario',
                'Servidumbre legal de paso',
                'Incumplimiento de contratos',
                'Conflictos vecinales',
                'Otros',
            ]" />
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <x-mediacion-card title="Mercantil" :items="[
                'Deudas Mercantiles',
                'Garantía prendaria',
                'Créditos hipotecarios',
                'Prestamos mercantiles',
                'Créditos refaccionarios',
                'Otros'
            ]" />
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <x-mediacion-card title="Penal y justicia penal para adolescentes" :items="[
                'Delitos que persiguen por querella',
                'Delitos que persiguen por requisitos equivalente de parte ofendida',
                'Delitos que admiten el perdón de la victima o el ofendido',
                'Delitos culposos',
                'Delitos patrimoniales',
                'Otros',
            ]" />
        </div>
    </section>

    <div class='d-flex mx-auto justify-content-center'>
        <button class='btn rounded-pill btn-persian-green mt-5 px-4 py-2'>
            <h3 class="fw-bolder m-0 mx-6">Requisitos</h3>
        </button>
    </div>
</article>
