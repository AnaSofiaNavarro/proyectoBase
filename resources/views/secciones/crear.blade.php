@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-save colorpersonal"></i> Nueva sección</h4>
                </div>

                <div class="card-body">

                    <form class="needs-validation" method="POST" action="{{url('/secciones')}}" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="apartado">Apartado: <span class="font-weight-bold text-danger">*</span></label>
                                <select class="form-control @error('apartado') is-invalid @enderror chosen" name="apartado" id="apartado" required>
                                    <option value="">Apartados</option>
                                    @foreach ($apartados as $item)
                                    @if (old('apartado') == $item->idapartado)
                                    <option value="{{$item->idapartado}}" selected>{{$item->apartado}}</option>
                                    @else
                                    <option value="{{$item->idapartado}}">{{$item->apartado}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    ¡El <strong>apartado</strong> es un campo requerido!
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="seccion">Sección: <span class="font-weight-bold text-danger">*</span></label>
                                <input class="form-control form-rounded @error('seccion') is-invalid @enderror" id="seccion" name="seccion" placeholder="Sección" value="{{ old('seccion') }}" maxlength="250" required />
                                <div class="invalid-feedback">
                                    ¡La <strong>sección</strong> es un campo requerido!
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="seccionen">Tradución sección:</label>
                                <input class="form-control form-rounded" id="seccionen" name="seccionen" placeholder="Traducción sección" value="{{old('seccionen')}}" maxlength="250" />
                            </div>
                            <div class="form-group col-4">
                                <label for="slug">Slug: <span class="font-weight-bold text-danger">*</span></label>
                                <input class="form-control form-rounded @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" value="{{ old('slug') }}" maxlength="250" readonly required />
                                <div class="invalid-feedback">
                                    ¡El <strong>slug</strong> es un campo requerido!
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="descripcion">Descripción: <span class="font-weight-bold text-danger">*</span></label>
                                <input class="form-control form-rounded @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" placeholder="Descripción" value="{{old('descripcion')}}" maxlength="250" required />
                                <div class="invalid-feedback">
                                    ¡La <strong>descripción</strong> es un campo requerido!
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="descripcionen">Traducción descripción:</label>
                                <input class="form-control form-rounded" id="descripcionen" name="descripcionen" placeholder="Traducción descripción" value="{{old('descripcion')}}" maxlength="250" />
                            </div>
                            <div class="form-group col-4">
                                <label for="division">División:</label>
                                <input class="form-control form-rounded" id="division" name="division" placeholder="División" value="{{old('division')}}" maxlength="250" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="enlace">Enlace:</label><br>
                                <input type="checkbox" class="form-control" id="enlace" name="enlace" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%" />
                            </div>

                            <div class="form-group col-8">
                                <label for="url">Dirección electrónica:</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Dirección electrónica" value="{{old('url')}}" maxlength="250" readonly />
                            </div>

                            <div class="form-group col-2">
                                <label for="target">Target:</label><br>
                                <input type="checkbox" class="form-control" id="target" name="target" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%" disabled />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="orden">Orden: <span class="font-weight-bold text-danger">*</span></label>
                                <select class="form-control @error('orden') is-invalid @enderror chosen" id="orden" name="orden" required>
                                    <option value="">Orden</option>
                                </select>
                                <div class="invalid-feedback">
                                    ¡El <strong>orden</strong> es un campo requerido!
                                </div>
                            </div>

                            <div class="form-group col-2">
                                <label for="activo">Activo:</label><br>
                                <input type="checkbox" class="form-control" id="activo" name="activo" data-toggle="toggle" data-on="Público" data-off="Privado" data-onstyle="success" data-offstyle="danger" data-width="100%" checked />
                            </div>
                        </div>

                        <input type="hidden" name="page" value="{{$page ?? ''}}" />
                        <input type="hidden" name="vbusqueda" value="{{$vbusqueda ?? ''}}" />

                        <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                        <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{url('/secciones?page='.$page.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>

                        <div class="d-none justify-content-center" id="divloading">
                            <div class="spinner-grow divloading" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p class="font-weight-bolder text-muted font-italic mt-1 mb-2">&nbsp;Cargando...</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".chosen").chosen();

    $("#apartado").change(function(e) {
        var Apartado = $("#apartado").val();
        if (Apartado) {
            var url = "{{url('/secciones/orden/idapartado')}}";
            url = url.replace("idapartado", Apartado);
            $("#divloading").addClass("d-flex").removeClass("d-none");
            $.ajax({
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                dataType: "json",
                success: function(response, textStatus, xhr) {
                    $("#orden").empty();
                    $("#orden").append("<option value=''>Orden</option>");
                    for (let i = 1; i <= response; i++) {
                        $("#orden").append("<option value='" + i + "'>" + i + "</option>");
                    }
                    $("#orden").trigger("chosen:updated");
                    $("#divloading").addClass("d-none").removeClass("d-flex");
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert("¡Error al cargar el concepto!");
                    $("#divloading").addClass("d-none").removeClass("d-flex");
                }
            });
            // Fin Ajax
        } else {
            $("#orden").empty();
            $("#orden").append("<option value=''>Orden</option>");
            $("#orden").trigger("chosen:updated");
        }
    });

    $("#seccion").keyup(function(e) {
        var str = $("#seccion").val();
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to = "aaaaaeeeeeiiiiooooouuuunc------";
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

    // Asigna un evento de cambio al checkbox enlace
    $("#enlace").on("change", function() {
        // Verifica si el checkbox está marcado
        if ($("#enlace").is(":checked")) {
            // Si está marcado, habilita el $("#url")
            $("#url").prop("readonly", false);
            $("#url").val("");
            $("#target").bootstrapToggle("off");
            $("#target").bootstrapToggle("enable");
        } else {
            // Si no está marcado, deshabilita el $("#url")
            $("#url").prop("readonly", true);
            $("#url").val("");
            $("#target").bootstrapToggle("off");
            $("#target").bootstrapToggle("disable");
        }
    });

    $("#apartado").change(function() {
        if ($("#apartado").val() != "") {
            if ($("#apartado_chosen").hasClass("is-invalid") === true) {
                $("#apartado_chosen").removeClass("is-invalid");
                $("#apartado_chosen").addClass("is-valid");
            }
        } else {
            if ($("#apartado_chosen").hasClass("is-valid") === true) {
                $("#apartado_chosen").removeClass("is-valid");
                $("#apartado_chosen").addClass("is-invalid");
            }
        }
    });

    $("#orden").change(function() {
        if ($("#orden").val() != "") {
            if ($("#orden_chosen").hasClass("is-invalid") === true) {
                $("#orden_chosen").removeClass("is-invalid");
                $("#orden_chosen").addClass("is-valid");
            }
        } else {
            if ($("#orden_chosen").hasClass("is-valid") === true) {
                $("#orden_chosen").removeClass("is-valid");
                $("#orden_chosen").addClass("is-invalid");
            }
        }
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
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
                        if ($("#apartado").val() == "") {
                            $("#apartado_chosen").addClass("is-invalid");
                        } else {
                            $("#apartado_chosen").addClass("is-valid");
                        }
                        if ($("#orden").val() == "") {
                            $("#orden_chosen").addClass("is-invalid");
                        } else {
                            $("#orden_chosen").addClass("is-valid");
                        }
                    }
                    form.classList.add("was-validated");
                    if ($("#apartado").val() != "") {
                        $("#apartado_chosen").addClass("is-valid");
                    }
                    if ($("#orden").val() != "") {
                        $("#orden_chosen").addClass("is-valid");
                    }
                }, false);
            });
        }, false);
    })();
</script>
@endsection