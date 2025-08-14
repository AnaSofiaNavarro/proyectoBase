@extends('welcome')

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 slider shadow p-3 mb-5 bg-white ">
        </div>
    </div>
</div>
<div class="container-fluid px-1 px-sm-5">
    <div class="row py-4">
        <div class="col-md-6 col-sm-6 fondoIzquierda ">
            <div class="row d-flex align-items-left justify-content-center mr-md-5  ">
                <div class="col-md-4">
                    <img src="{{asset('storage/notas/'.$nota->img)}}" alt="{{$nota->titulo}}" class="img-fluid rounded shadow-lg rounded-custom-full">
                </div>
                <div class="col-md-8 text-justify">
                    <a class="text-decoration-none" href="{{url('/nota/'.$nota->id.'/ver')}}">
                        <h3 class="tituloNota">{{mb_strtoupper(e($nota->titulo),'UTF-8')}}</h3>
                    </a>
                </div>
            </div>
            <div class=" row pt-4 mr-md-5">
                <div class="col-12">
                    <p class="text-justify textoNota">{{Str::limit($nota->contenido,450)}}</p>
                </div>
            </div>
            <div class="row pt-3 d-flex align-items-center ">
                <div class="col-md-8 d-flex justify-content-center col-12    text-md-left">
                    <a href="{{route('notaspje')}}" class="btn btnServicios btn-lg py-4  btn-block ">SEGUIR LEYENDO MÁS NOTICIAS</a>
                </div>
                <div class="col-md-2 col-12 text-center text-md-left">
                    <a id="shareNota" class="btn btn-link p-0" href="{{url('/nota/'.$nota->id.'/ver')}}">
                        <img class="img-fluid" src="/assets/img/comunicacion/btn-compartir.svg" alt="Compartir">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 fondoDerecha ">
            <div class="embed-responsive embed-responsive-21by9 rounded rounded-custom-full shadow-lg ">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$videos->url}}" allowfullscreen></iframe>
            </div>
            <div class="row pt-5 d-flex align-items-center justify-content-center  ">
                <div class="col-md-2 col-2">
                    <a href="{{$config->facebook}}" target="_blank">
                        <img class="img-fluid" src="/assets/img/comunicacion/btn-facebook.svg" alt="Facebook">
                    </a>
                </div>
                <div class="col-md-2 col-2">
                    <a href="{{$config->twitter}}" target="_blank">
                        <img class="img-fluid" src="/assets/img/comunicacion/btn-x.svg" alt="X">
                    </a>
                </div>
                <div class="col-md-2 col-2">
                    <a href="{{$config->youtube}}" target="_blank">
                        <img class="img-fluid" src="/assets/img/comunicacion/btn-yotube.svg" alt="Youtube">
                    </a>
                </div>
                <div class="col-3">
                    <a href="{{asset('storage/configuraciones/'.$config->imagencalendario)}}" target="_blank">
                        <img class="img-fluid w-100 h-100" src="/assets/img/comunicacion/btn-calendario.svg" alt="Calendario">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 plecaComunicacion">
    </div>
</div>
<div class="container-fluid px-sm-5 px-0 container-custom background-gradient ">
    <div class="fondoServicios">
        <div class="row pt-4 text-center ">
            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <a class="navbar-brand" href="{{url('seccion/expedicion-de-constancia-de-no-antecedentes-penales')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Antecedentes.svg" alt="Antecedentes no penales">
                    <div><span class="subtituloComunicacion text-wrap">No Antecedentes Penales</span></div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12  mt-4">
                <a class="navbar-brand" href="{{$config->dominiotmp}}paginas/edictolaboral.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Edictos.svg" alt="Edictos">
                    <div><span class="subtituloComunicacion text-wrap">Publicación de Edictos</span> </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12  mt-4">
                <a class="navbar-brand" href="{{route('constancianohabilitacionpje')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Constancia-No-Inhabilitacion.svg" alt="Constancia de No Inhabilitación">
                    <div><span class="subtituloComunicacion text-wrap">Constancia de No Inhabilitación</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12   mt-4">
                <a class="navbar-brand" href="https://consultalistas.poderjudicialchiapas.gob.mx/inicial.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Lista-Acuerdos.svg" alt="Lista de Acuerdos">
                    <div><span class="subtituloComunicacion text-wrap">Lista de Acuerdos</span> </div>
                </a>
            </div>
        </div>

        <div class="row mt-4 text-center collapses" id="filaServiciosOculta">

            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <a class="navbar-brand" href="{{$config->dominiotmp}}paginas/versionesPublicas.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-versiones-publicas-setencias.svg" alt="Versiones Públicas de Sentencias">
                    <div><span class="subtituloComunicacion text-wrap">Versiones Públicas de Sentencias</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <a class="navbar-brand" href="{{route('registrotitulopje')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Registro-titulos.svg" alt="Registro de Títulos Profesionales">
                    <div><span class="subtituloComunicacion text-wrap">Registro de Títulos Profesionales</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <a class="navbar-brand" href="https://ceja.poderjudicialchiapas.gob.mx">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-ceja.svg" alt="Registro de Certificaciones en MASC">
                    <div><span class="subtituloComunicacion text-wrap">Centro Estatal de Justicia Alternativa</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 mt-4">
                <a class="navbar-brand" href="{{route('defensoriapje')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-defensoria.svg" alt="Defensoría Pública">
                    <div><span class="subtituloComunicacion text-wrap">Defensoría Pública</span></div>
                </a>
            </div>
        </div>
        <!-- <div class="row">
            <div class="offset-md-4 offset-0 col-md-4 text-center my-4">
                <button type="button" id="btnServicios" class="btn btnServicios btn-lg px-5 btn-block" data-toggle="collapse" data-target="#filaServiciosOculta" aria-expanded="false" aria-controls="filaServiciosOculta">VER MÁS SERVICIOS
                    <i id="iconServicios" class="fas fa-chevron-down ml-2"></i>
                </button>
            </div>
        </div> -->
        <div class="row">
            <div class="col-12 text-center my-5">
                <img class="img-fluid" src="/assets/img/servicios/Linea-Separa-servicios.svg" alt="Justicia con Humanismo">
            </div>
        </div>
        <div class="row pb-4">
            <!-- <div class="col-md-3 col-12 text-md-right text-center">
                <img class="img-fluid" src="/assets/img/servicios/Icono-micrositios.svg" alt="Servicios">
            </div>
            <div class="col-md-9 col-12 text-md-left text-center ">
                <div><span class="subtituloComunicacion">Conoce la famila de secciones y micrositios<br>
                        del Poder Judicial</span> <a class="navbar-brand text-reset" href=""><u class="enlaceServicios">ver más</u></a></div>
            </div> -->
            <div class="col-md-12 d-flex align-items-center justify-content-center">
                <img class="img-fluidss pr-1 pr-md-4" height="100px" src="/assets/img/servicios/Icono-micrositios.svg" alt="Servicios">
                <span class="subtituloComunicacion">Conoce la famila de secciones y micrositios<br>
                    del Poder Judicial <a class="navbar-brand text-reset " href=""><u class="enlaceServicios">ver más</u></a></span>
            </div>
        </div>



        <div class="row text-center">
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="{{route('institutopje')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-instituto-formacion-judicial.svg" alt="Instituto de Formación Profesionalización Y carrera Judicial">
                    <div><span class="subtituloComunicacion text-wrap">Instituto de Formación Profesionalización y carrera Judicial</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="https://igualdad.poderjudicialchiapas.gob.mx/">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-igualdad-genero.svg" alt="Igualdad de Género y Derechos Humanos">
                    <div><span class="subtituloComunicacion text-wrap">Igualdad de Género y Derechos Humanos</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="{{$config->dominiotmp}}paginas/nuevomodeloJusticia.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-calendario-audiencias.svg" alt="Calendario de Audiencias">
                    <div><span class="subtituloComunicacion text-wrap">Calendario de Audiencias</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="#">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-archivo-judicial.svg" alt="Archivo Judicial">
                    <div><span class="subtituloComunicacion text-wrap">Archivo Judicial</span></div>
                </a>
            </div>
        </div>

        <div class="row text-center py-5">
            <div class="col-xl-3 col-md-6 col-sm-126 col-12 mt-4">
                <a class="navbar-brand" href="{{$config->dominiotmp}}paginas/versionesPublicas.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-contraloria-interna.svg" alt="Contraloria Interna">
                    <div><span class="subtituloComunicacion text-wrap">Contraloria Interna</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="{{route('mejoraregulatoriapje')}}">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-Mejora-Regulatoria.svg" alt="Mejora Regulatoria">
                    <div><span class="subtituloComunicacion text-wrap">Mejora Regulatoria</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="https://adolescentes.poderjudicialchiapas.gob.mx/">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-derechos-ninas-ninos-adolescentes.svg" alt="Derechos de Niñas Niños y Adolescentes">
                    <div><span class="subtituloComunicacion text-wrap">Derechos de Niñas Niños y Adolescentes</span></div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 col-12 mt-4">
                <a class="navbar-brand" href="{{$config->dominiotmp}}paginas/versionesPublicas.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-comision-etica-judicial.svg" alt="Comisión de Ética del Consejo de la Judicatura">
                    <div><span class="subtituloComunicacion text-wrap">Comisión de Ética del Consejo de la<br>Judicatura</span></div>
                </a>
            </div>
        </div>

        <div class="row  py-5">
            <div class="col-md-12  mt-4 text-center">
                <a class="navbar-brand" href="https://buscadorindigena.poderjudicialchiapas.gob.mx/index.php">
                    <img class="img-fluid" src="/assets/img/servicios/Ico-comision-criterios-indigenas.svg" alt="Comisión de Criterios indigenas">
                    <div><span class="subtituloComunicacion">Comisión de Criterios<br>Indigenas</span></div>
                </a>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid bgGreen">
    <div class="row">
        <div class="col-12 text-center">
            <p class="fontMontserrat fte24 font-weight-bold text-white py-4">Otros Sitios</p>
        </div>
    </div>
    <div class="container-fluid container-custom">
        <div class="row pt-1 pb-5 d-flex align-items-center justify-content-center ">
            <div class="col-md-2 col-sm-6  text-center pt-md-0 pt-5">
                <a href="https://www.scjn.gob.mx/" alt="Suprema Corte de Justicia" target="_blank">
                    <img class="img-fluid " src="/assets/img/sitios/ico-suprema-corte.svg" alt="Suprema Corte de Justicia">
                </a>
            </div>
            <div class="col-md-2 col-sm-6 text-center pt-md-0 pt-5">
                <a href="https://conatrib.org.mx/" alt="Conatrib" target="_blank">
                    <img class="img-fluid" src="/assets/img/sitios/ico-conatrib.svg" alt="Conatrib">
                </a>
            </div>
            <div class="col-md-2 col-sm-6 text-center pt-md-0 pt-5">
                <a href="https://conatrib.org.mx/" alt="amij" target="_blank">
                    <img class="img-fluid" src="/assets/img/sitios/ico-amij.svg" alt="amij">
                </a>
            </div>
            <div class="col-md-2 col-sm-6 text-center pt-md-0 pt-5">
                <a href="https://www.ceieg.chiapas.gob.mx/home" alt="Comité Estatal de Información Estadística y Geográfica" target="_blank">
                    <img class="img-fluid" src="/assets/img/sitios/Ico-cieg.svg" alt="Comité Estatal de Información Estadística y Geográfica">
                </a>
            </div>
            <div class="col-md-4 col-sm-12 text-center pt-md-0 pt-5">
                <a href="https://catalogonacional.gob.mx/" alt="Catálogo Nacional de Regulaciones,Trámites y Servicios" target="_blank">
                    <img class="img-fluid" src="/assets/img/sitios/Ico-conamer.svg" alt="Catálogo Nacional de Regulaciones,Trámites y Servicios">
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid container-custom px-0 px-sm-5">
    <div class="row py-5 d-flex align-items-center justify-content-center">
        <div class="col-md-3 col-12 text-center">
            <a href="https://www.plataformadetransparencia.org.mx/Inicio" alt="Plataforma Nacional de Transparencia" target="_blank">
                <img class="img-fluid " src="/assets/img/sitios/Ico-plataforma-transparencia.svg" alt="Plataforma Nacional de Transparencia">
            </a>
        </div>
        <div class="col-md-3 col-12 text-center mt-sm-4 mt-4">
            <a href="https://datos.gob.mx/" alt="Datos Gobierno de México" target="_blank">
                <img class="img-fluid " src="/assets/img/sitios/Gobierno de mexico.svg" alt="Datos Gobierno de México">
            </a>
        </div>
        <div class="col-md-3 col-12 text-center mt-sm-4 mt-4">
            <a href="https://www.plataformadetransparencia.org.mx/Inicio" alt="Archivo General" target="_blank">
                <img class="img-fluid " src="/assets/img/sitios/Archivo_General.png" alt="Archivo General">
            </a>
        </div>
        <div class="col-md-3 col-12 text-center mt-sm-4 mt-4">
            <a href="https://www.plataformadetransparencia.org.mx/Inicio" alt="Transparencia Chiapas" target="_blank">
                <img class="img-fluid " src="/assets/img/sitios/ico-transparencia-chiapas.svg" alt="Transparencia Chiapas">
            </a>
        </div>
    </div>
</div>
<script>
    document.getElementById('shareNota').addEventListener('click', function() {
        const shareUrl = event.currentTarget.getAttribute('href');
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: shareUrl
            }).then(() => {
                console.log('¡Contenido compartido con éxito!');
            }).catch((error) => {
                console.error('Error al compartir:', error);
            });
        } else {
            alert('La función de compartir no es compatible con tu navegador.');
        }
    });
    document.getElementById('btnServicios').addEventListener('click', function() {
        const button = this;
        const target = document.querySelector('#filaServiciosOculta'); // El contenedor colapsable
        const buttonIcon = document.querySelector('#iconServicios');
        $(target).on('shown.bs.collapse', function() {
            // button.textContent = 'VER MENOS SERVICIOS';
            button.innerHTML = 'VER MENOS SERVICIOS <i id="iconServicios" class="fa fa-chevron-up"></i>';
            // buttonIcon.classList.remove('fa-chevron-down');
            // buttonIcon.classList.add('fa-chevron-up');
            // console.log(buttonIcon);
        });
        $(target).on('hidden.bs.collapse', function() {
            button.innerHTML = 'VER MÁS SERVICIOS <i id="iconServicios" class="fa fa-chevron-down"></i>';
            // console.log("Mas" + buttonIcon);
            // buttonIcon.classList.remove('fa-chevron-up');
            // buttonIcon.classList.add('fa-chevron-down');
        });
    });
</script>
@endsection