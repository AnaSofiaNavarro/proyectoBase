@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-save colorpersonal"></i> Nuevo contenido</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{url('/contenidos')}}" novalidate>
                        @csrf

                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="fecha">Fecha: <span class="font-weight-bold text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" aria-label="Fecha" placeholder="Fecha" value="{{date("d/m/Y")}}" readonly/>
                                </div>
                                <div class="invalid-feedback">
                                    ¡La <strong>fecha</strong> es un campo requerido!
                                </div>    
                                <div class="form-group col-md-2">
                                    <label for="vista">Vista:</label><br>
                                    <input type="checkbox" class="form-control" id="vista" name="vista" data-toggle="toggle" data-on="Sección" data-off="Apartado" data-onstyle="secondary" data-offstyle="secondary" data-width="100%" checked/>
                                </div>
                                <div class="form-group col-8 d-none" id="divapartado">
                                    <label for="apartado">Apartado: <span class="font-weight-bold text-danger">*</span></label>
                                    <select class="form-control  @error('apartado') is-invalid @enderror chosen" id="apartado" name="apartado">
                                        <option value="">Apartado</option>
                                        @foreach ($apartados as $item)
                                            @if (old('apartado') == $item->idapartado)
                                                <option value="{{$item->idapartado}}" selected>{{$item->apartado}}</option>
                                            @else
                                                <option value="{{$item->idapartado}}">{{$item->apartado}}</option>
                                            @endif
                                        @endforeach  
                                    </select>
                                    <div class="invalid-feedback">
                                        ¡El <b>Apartado</b> es un campo requerido!
                                    </div> 
                                </div>

                                <div class="form-group col-8" id="divseccion">
                                    <label for="apartado">Sección: <span class="font-weight-bold text-danger">*</span></label>
                                    <select class="form-control  @error('seccion') is-invalid @enderror chosen" id="seccion" name="seccion[]" multiple required>
                                        <option value="">Secciones</option>
                                        @foreach ($secciones as $seccion)
                                            @if (old('seccion') == $seccion->idseccion)
                                                <option value="{{$seccion->idseccion}}" selected>{{$seccion->seccion}}</option>
                                            @else
                                                <option value="{{$seccion->idseccion}}">{{$seccion->seccion}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        ¡La <b>Sección</b> es un campo requerido!
                                    </div> 
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="encabezado">Encabezado: <span class="font-weight-bold text-danger">*</span></label>
                                    <input type="text" class="form-control @error('encabezado') is-invalid @enderror" id="encabezado" name="encabezado" placeholder="Encabezado" maxlength="250" value="{{old('encabezado')}}" required/>
                                    <div class="invalid-feedback">
                                        ¡El <strong>encabezado</strong> es un campo requerido!
                                    </div>                                
                                </div>
                                <div class="form-group col-4">
                                    <label for="encabezadoen">Traducción encabezado:</label>
                                    <input type="text" class="form-control" id="encabezadoen" name="encabezadoen" placeholder="Traducción encabezado" maxlength="250" value="{{old('encabezadoen')}}"/>
                                </div>
                                <div class="form-group col-4">
                                    <label for="slug">Slug: <span class="font-weight-bold text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" maxlength="250" value="{{ old('slug') }}" readonly required/>
                                    <div class="invalid-feedback">
                                        ¡El <strong>slug</strong> es un campo requerido!
                                    </div>                                
                                </div>
                            </div>

                            <div class="form-row"> 
                                <div class="form-group col-6">
                                    <label for="subtitulo">Subtitulo:</label>
                                    <input type="text" class="form-control" name="subtitulo" placeholder="Subtitulo" maxlength="250" value="{{old('subtitulo')}}"/>
                                </div>
                                <div class="form-group col-6">
                                    <label for="subtituloen">Traducción subtitulo:</label>
                                    <input type="text" class="form-control" name="subtituloen" placeholder="Traducción subtitulo" maxlength="250" value="{{old('subtituloen')}}"/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control ckeditor" name="descripcion" placeholder="Descripción" rows="10">{{old('descripcion')}}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="descripcionen">Traducción descripción:</label>
                                    <textarea class="form-control ckeditor" name="descripcionen" placeholder="Traducción descripción" rows="10">{{old('descripcionen')}}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="fuente">Fuente:</label>
                                    <input type="text" class="form-control" name="fuente" placeholder="Fuente" max="250" value="{{ old('fuente') }}"/>
                                </div>
                                <div class="form-group col-3">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" class="form-control" name="telefono" id="telefono" maxlength="20" value="{{ old('telefono') }}" placeholder="Teléfono"/>
                                </div>
                                <div class="form-group col-3">
                                    <label for="extension">Extensión:</label>
                                    <input type="text" class="form-control" name="extension" id="extension" maxlength="20" value="{{ old('extension') }}" placeholder="Extensión"/>
                                </div>
                                <div class="form-group col-3">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email" class="form-control" name="correo" id="correo" maxlength="200" value="{{ old('correo') }}" placeholder="Correo electrónico"/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="tipocontenido">Tipo de contenido: <span class="font-weight-bold text-danger">*</span></label>
                                    <select class="form-control  @error('tipocontenido') is-invalid @enderror chosen" id="tipocontenido" name="tipocontenido" required>
                                        @foreach ($tipocontenidos as $tipocontenido)
                                            @if (old('tipocontenido') == $tipocontenido->idtipocontenido)
                                                <option value="{{$tipocontenido->idtipocontenido}}" selected>{{$tipocontenido->tipocontenido}}</option>
                                            @else
                                                <option value="{{$tipocontenido->idtipocontenido}}">{{$tipocontenido->tipocontenido}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        ¡El <b>Tipo de contenido</b> es un campo requerido!
                                    </div> 
                                </div>
                                <div class="form-group col-4">
                                    <label for="url">Archivo:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="archivo" name="archivo" lang="es" aria-describedby="Archivo" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.mp4" disabled/>
                                        <label class="custom-file-label" for="archivo" id="labelarchivo">Seleccionar archivo</label>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="url">Url:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="url" class="form-control" id="url" name="url" placeholder="URL" value="{{ old('url') }}" maxlength="250" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="target">Target:</label><br>
                                    <input type="checkbox" class="form-control" id="target" name="target" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="relevante">Relevante:</label><br>
                                    <input type="checkbox" class="form-control" id="relevante" name="relevante" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="activo">Activo:</label><br>
                                    <input type="checkbox" class="form-control" id="activo" name="activo" data-toggle="toggle" data-on="Público" data-off="Privado" data-onstyle="success" data-offstyle="danger" data-width="100%" checked/>
                                </div>
                            </div>
                            {{-- PUSE UN SELECT PARA PONER LA LISTA DE LOS ARCHIVOS A ELEGIR --}}
                            <div class="form-group col-md-5">
                                <label for="template">Template</label><br>
                                <select class="form-control" name="template" id="template">
                                    <option value="">Selecciona un template</option>
                                    @foreach ($templates as $template)
                                        <option value="{{ $template }}" {{ old('template') == $template ? 'selected' : '' }}>
                                            {{ $template }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <input type="hidden" name="page" value="{{$page ?? ''}}"/>
                            <input type="hidden" name="vfecha" value="{{$vfecha ?? ''}}"/>
                            <input type="hidden" name="vapartado" value="{{$vapartado ?? ''}}"/>
                            <input type="hidden" name="vseccion" value="{{$vseccion ?? ''}}"/>
                            <input type="hidden" name="vbusqueda" value="{{$vbusqueda ?? ''}}"/>


                            <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                            <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{url('/contenidos?page=' . $page . '&vfecha=' . $vfecha . '&vapartado=' . $vapartado . '&vseccion=' . $vseccion . '&vbusqueda=' . $vbusqueda)}}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#fecha').datepicker({
            uiLibrary: 'bootstrap4',
            locale: 'es-es',
            format: 'dd/mm/yyyy'
        });

        $(".chosen").chosen();

        $("#vista").change(function(){
            if ($(this).prop('checked') == true) 
            {
                // Sección
                $("#apartado").removeAttr("required");
                $("#seccion").attr("required", true);

                $("#apartado option").prop("selected", false);
                $("#seccion option").prop("selected", false);

                $("#seccion").chosen();

                $("#divapartado").addClass("d-none");
                $("#divseccion").removeClass("d-none");
            }
            else
            {
                // Apartado
                $("#apartado").attr("required", true);
                $("#seccion").removeAttr("required");

                $("#apartado option").prop("selected", false);
                $("#seccion option").prop("selected", false);

                $("#seccion").chosen("destroy");

                $("#divapartado").removeClass("d-none");
                $("#divseccion").addClass("d-none");

            }
        });

        $("#encabezado").keyup(function(e){
            var str= $("#encabezado").val();
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
            var to   = "aaaaaeeeeeiiiiooooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

            // return str;
            // str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $("#slug").val(str);
            $("#slug").attr("placeholder", str);
        });

        $("#telefono").validCampoFranz("+-()0123456789 ");
        $("#extension").validCampoFranz("0123456789 ");

        $("#tipocontenido").change(function(e) { 
            var tipocontenido = $("#tipocontenido").val();
            if (tipocontenido == 1) {
                $("#labelarchivo").text("Seleccionar archivo");
                $("#archivo").val("");
                $("#archivo").prop("disabled", true);
                $("#url").val("");
                $("#url").prop("disabled", true);
            }
            else if (tipocontenido == 2) {
                $("#labelarchivo").text("Seleccionar archivo");
                $("#archivo").val("");
                $("#archivo").prop("disabled", false);
                $("#url").val("");
                $("#url").prop("disabled", true);
            }
            else if (tipocontenido == 3) {
                $("#labelarchivo").text("Seleccionar archivo");
                $("#archivo").val("");
                $("#archivo").prop("disabled", true);
                $("#url").val("");
                $("#url").prop("disabled", false);
            }
        });

        bsCustomFileInput.init();
        $('[data-toggle="tooltip"]').tooltip();

        if($("#vista").prop('checked') == true)
        {
            $("#seccion").change(function(){
                if($("#seccion").val() != "")
                {
                    if($("#seccion_chosen").hasClass("is-invalid") === true)
                    {
                        $("#seccion_chosen").removeClass("is-invalid");
                        $("#seccion_chosen").addClass("is-valid");
                    }
                }
                else
                {
                    if($("#seccion_chosen").hasClass("is-valid") === true)
                    {
                        $("#seccion_chosen").removeClass("is-valid");
                        $("#seccion_chosen").addClass("is-invalid");
                    }
                }
            });
        }

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function(){
            "use strict";
            window.addEventListener("load", function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener("submit", function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    if($("#vista").prop("checked") == true)
                    {
                        if($("#seccion").val() == "")
                        {
                            $("#seccion_chosen").addClass("is-invalid");
                        }
                        else
                        {
                            $("#seccion_chosen").addClass("is-valid");
                        }
                    }
                }
                form.classList.add("was-validated");
                if($("#vista").prop("checked") == true)
                {
                    if($("#seccion").val() != "")
                    {
                        $("#seccion_chosen").addClass("is-valid");
                    }
                }
                }, false);
            });
            }, false);
        })();
    </script>
@endsection
