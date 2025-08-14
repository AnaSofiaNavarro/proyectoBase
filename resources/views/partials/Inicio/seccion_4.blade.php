<style>
    .step-hover {
        position: relative;
        overflow: hidden;
        max-height: 220px;
        /* altura uniforme de todas las cards */
    }

    @media (min-width: 768px) {
        .step-hover {
            height: 280px;
        }
    }

    .collapse-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.97);
        padding: 1rem;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        overflow-y: auto;
        /* permite scroll interno si hay mucho texto */
    }

    .step-hover:hover .collapse-content {
        opacity: 1;
        transform: translateY(0);
    }

</style>


<article class="container-fluid d-flex flex-column justify-content-center align-items-center p-0">
    <header class="header-diagrama w-100 d-flex flex-column flex-md-row gap-3 text-white bg-magenta px-3 px-md-6 py-5 align-items-end">
        <h2 class="fw-bolder m-0 p-0 flex-grow-1">DIAGRAMA DE FLUJO DEL PROCEDIMIENTO DE MEDIACIÓN Y CONCILIACIÓN</h2>
        <button class='text-decoration-underline fw-bolder m-0 cursor-pointer text-white border-0 bg-transparent' type="button" data-bs-toggle="collapse" data-bs-target="#diagramaFlujo" aria-expanded="false" aria-controls="diagramaFlujo">
            Ver diagrama
        </button>
    </header>

    <section id="diagramaFlujo" class="collapse">

        <!-- Fila superior -->
        <section class="row g-3 mb-2 container mt-5">
            @foreach([
            ['num'=>1,'title'=>'SOLICITUD DEL SERVICIO','items'=>[
            'Comparecencia personal (una o ambas partes)','Escrito','Vía Mail','Por derivación del órgano jurisdiccional'
            ]],
            ['num'=>2,'title'=>'ORIENTACIÓN Y ACTA DE COMPARECENCIA','items'=>[
            'Lo realiza una persona especialista pública'
            ]],
            ['num'=>3,'title'=>'CLASIFICACIÓN DEL ASUNTO','items'=>[
            'Se podrá prevenir','Acuerdo de Radicación'
            ]],
            ['num'=>4,'title'=>'INVITACIÓN A SESIONES','items'=>[
            'Se señala fecha y hora para sesión de orientación conjunta'
            ]],
            ] as $step)
            <div class="col-12 col-md-6 col-lg-3 position-relative">
                <section class="shadow-sm rounded-xl text-center p-3 d-flex flex-column justify-content-center step-hover" style="border: 2px solid #009684;">
                    <h2 class="fw-bolder fs-6 flex-grow-1 d-flex align-items-center justify-content-center m-0">
                        <span class="fw-bolder fs-4 text-magenta">{{ $step['num'] }}.</span> {{ $step['title'] }}
                    </h2>
                    <div class="collapse-content mt-2">
                        <ul class="list-unstyled small fw-medium text-start mb-0">
                            @foreach($step['items'] as $item)
                            <li class='mb-2'>- {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                @if(!$loop->last)
                <div class="d-none d-md-flex position-absolute top-50 end-0 translate-middle-y">
                    <span class="fs-3 fw-bolder">→</span>
                </div>
                @endif
            </div>
            @endforeach
        </section>

        <!-- Fila inferior -->
        <section class="row g-3 flex-row-reverse container mb-5">
            @foreach([
            ['num'=>5,'title'=>'SESIÓN DE MEDIACIÓN CONJUNTA','items'=>[
            'Se informa procedimiento a las partes','Suscripción de compromiso de participación'
            ]],
            ['num'=>6,'title'=>'SESIÓN DE MEDIACIÓN O CONCILIACIÓN','items'=>[
            'El número de sesiones dependerá del caso en concreto'
            ]],
            ['num'=>7,'title'=>'CONCLUSIÓN','items'=>[
            'Pudiendo ser por convenio u otras causas'
            ]],
            ['num'=>8,'title'=>'SEGUIMIENTO DE CONVENIO','items'=>[
            'Se verifica el cumplimiento del mismo'
            ]],
            ] as $step)
            <div class="col-12 col-md-6 col-lg-3 position-relative">
                <section class="shadow-sm rounded-xl text-center p-3 d-flex flex-column justify-content-center step-hover" style="border: 2px solid #009684;">
                    <h2 class="fw-bolder fs-6 flex-grow-1 d-flex align-items-center justify-content-center m-0">
                        <span class="fw-bolder fs-4 text-magenta">{{ $step['num'] }}.</span> {{ $step['title'] }}
                    </h2>
                    <div class="collapse-content mt-2">
                        <ul class="list-unstyled small fw-medium text-start mb-0">
                            @foreach($step['items'] as $item)
                            <li class='mb-2'>- {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                @if(!$loop->last)
                <div class="d-none d-md-flex position-absolute top-50 start-0 translate-middle-y">
                    <span class="fs-3">←</span>
                </div>
                @endif
            </div>
            @endforeach
        </section>

    </section>
</article>
