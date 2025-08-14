@extends('welcome')

@section('contenido')
<div class="container-fluid">
    <div class="row p-0">
        <div class="col-12 sliders p-0 shadow bg-white ">
            <img class="img-fluid w-100 p-0" src="{{ asset('storage/configuraciones/' . ($config?->imagenc ?? 'default.jpg')) }}" alt="Banner de bienvenida al sitio web de CEJA">
        </div>
    </div>
</div>

@include('partials.Inicio.seccion_1')
@include('partials.Inicio.seccion_2')
@include('partials.Inicio.seccion_3')
@include('partials.Inicio.seccion_4')



<div class="container-fluid my-5 px-5 ">
    <h4 class="text-start fw-bold px-5">
        En el Poder Judicial es prioridad eliminar toda forma de violencia y discriminación entre los
        servidores públicos, asegurando condiciones de
    </h4>

    <div class="row my-5 justify-content-center text-center">
        <div class="col-md-4 col-sm-6 d-flex flex-column align-items-center pdf-hover">
            <img src="/storage/inicio/ico-igualdad-oportunidades.svg" alt="Igualdad de Oportunidades" class="img-fluid" style="height: 150px;">
            <p class="textInicio">Igualdad de Oportunidades</p>
        </div>

        <div class="col-md-4 col-sm-6 d-flex flex-column align-items-center pdf-hover">
            <img src="/storage/inicio/Ico-respeto-derechos-humanos.svg" alt="Respeto a los Derechos Humanos de la Ciudadanía" class="img-fluid" style="height: 150px;">
            <p class="textInicio">Respeto a los Derechos Humanos de la Ciudadanía</p>
        </div>

        <div class="col-md-4 col-sm-6 d-flex flex-column align-items-center pdf-hover">
            <img src="/storage/inicio/ico-estableciendo.svg" alt="Estableciendo la perspectiva de género" class="img-fluid" style="height: 150px;">
            <p class="textInicio">Estableciendo la perspectiva de género</p>
        </div>
    </div>

    <h4 class="text-start m-0 px-5" style="font-weight: 500;">
        como una herramienta para la planeación y ejecución de los programas, proyectos y acciones en beneficio de la
        sociedad.
    </h4>
</div>



<div class="container-fluid my-5 p-5" style="background-color: #FFD7E9;">
    <h4 class="px-5 pb-2 text-start fw-bold">
        Datos sobre género y derechos humanos
    </h4>

    <div class="row justify-content-center text-center">
        <!-- Tarjeta 1 -->
        <div class="col-md-4 col-sm-6 d-flex">
            <a href="#" class="w-100 text-decoration-none" style="color: inherit;">

                <div class="border-0 w-100 d-flex flex-column align-items-center p-3 pdf-hover" style="background-color: transparent; min-height: 100%;">
                    <img src="storage/inicio/ico-sabias-que.svg" alt="Icono sabías qué" class="img-fluid mb-3" style="height: 150px;">
                    <p class="textInicio flex-grow-1 text-black">
                        ¿Sabías qué...<br>
                        <span>20.- Día Mundial de los Refugiados.</span>
                    </p>
                    <span class="btn btn-lg px-5   mt-3 ">
                        Ver más
                    </span>
                </div>
            </a>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-md-4 col-sm-6 d-flex">
            <a href="#" class="w-100 text-decoration-none" style="color: inherit;">
                <div class="border-0 w-100 d-flex flex-column align-items-center p-3 pdf-hover" style="background-color: transparent; min-height: 100%;">
                    <img src="/storage/inicio/ico-herramientas.svg" alt="Icono herramientas" class="img-fluid mb-3" style="height: 150px;">
                    <p class="textInicio flex-grow-1">
                        Herramientas para incorporar la perspectiva de género
                    </p>
                    <span class="btn btn-lg px-5  mt-3 ">
                        Ver más
                    </span>
                </div>
            </a>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col-md-4 col-sm-6 d-flex">
            <a href="" class="w-100 text-decoration-none" style="color: inherit;">
                <div class="border-0 w-100 d-flex flex-column align-items-center p-3 pdf-hover" style="background-color: transparent; min-height: 100%; border-radius: 2rem !important;">
                    <img src="/storage/inicio/ico-normativa.svg" alt="Icono normativa" class="img-fluid mb-3" style="height: 150px;">
                    <p class="textInicio flex-grow-1">
                        Normativa con perspectiva de género
                    </p>
                    <span class="btn btn-lg px-5 mt-3 ">
                        Ver más
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid px-5 mb-5">
    <div class="row">
        <!-- Columna Izquierda -->
        <div class="col-md-6 mb-4">
            <h4 class="fw-bold">
                Criterios jurisprudenciales relevantes
            </h4>
            <ul class="lista-inicio ps-3">
                <li>Derechos Humanos</li>
                <li>Perspectiva de Género</li>
                <li>Violencia de Género</li>
                <li>Violencia Familiar</li>
                <li>Grupos en situación de Vulnerabilidad</li>
            </ul>
        </div>

        <!-- Columna Derecha -->
        <div class="col-md-6 d-flex flex-column">
            <h4 class="fw-bold">
                Opiniones consultivas de la Corte Interamericana de Derechos Humanos
            </h4>
            <div class="pt-2">
                <a href="" class="btn btn-lg px-5 ">
                    Ver más
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
