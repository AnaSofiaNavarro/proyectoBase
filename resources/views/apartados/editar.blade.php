@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-pen colorpersonal"></i> Editar apartado</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{url('/apartados/'.$dato->idapartado)}}" novalidate>
                        @method('PUT')
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="apartado">Apartado: <span class="font-weight-bold text-danger">*</span></label>
                                <input class="form-control @error('apartado') is-invalid @enderror" id="apartado" name="apartado" placeholder="Apartado" value="{{$dato->apartado}}" maxlength="50" required />
                                <div class="invalid-feedback">
                                    ¡El <strong>apartado</strong> es un campo requerido!
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="apartadoen">Traducción apartado:</label>
                                <input class="form-control" id="apartadoen" name="apartadoen" placeholder="Traducción apartado" value="{{$dato->apartadoen}}" maxlength="50" />
                            </div>
                            <div class="form-group col-4">
                                <label for="slug">Slug: <span class="font-weight-bold text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Sluj" value="{{$dato->slug}}" maxlength="50" readonly required />
                                <div class="invalid-feedback">
                                    ¡El <strong>slug</strong> es un campo requerido!
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="enlace">Enlace:</label><br>
                                <input type="checkbox" class="form-control" id="enlace" name="enlace" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%" @if($dato->enlace == 1) {{'checked'}} @endif/>
                            </div>
                            <div class="form-group col-8">
                                <label for="url">Dirección elctrónica:</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Dirección electrónica" value="{{$dato->url ?? ''}}" maxlength="250" @if(!$dato->enlace == true) readonly @endif/>
                            </div>
                            <div class="form-group col-2">
                                <label for="target">Target:</label><br>
                                <input type="checkbox" class="form-control" id="target" name="target" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%" @if($dato->target == true) {{'checked'}} @endif @if(!$dato->enlace == true) {{'disabled'}} @endif/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-2">
                                <label for="activo">Menú:</label><br>
                                <input type="checkbox" class="form-control" id="menu" name="menu" data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="100%" @if($dato->menu == 1) {{'checked'}} @endif @if($dato->enlace == true) {{'disabled'}} @endif/>
                            </div>
                            <div class="form-group col-2">
                                <label for="orden">Orden: <span class="font-weight-bold text-danger">*</span></label>
                                <select class="form-control @error('orden') is-invalid @enderror chosen" id="orden" name="orden" required>
                                    <option value="">Orden</option>
                                    @for($i = 1; $i <= $numero; $i++)
                                        @if ($dato->orden == $i)
                                        <option value="{{$i}}" selected>{{$i}}</option>
                                        @else
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endif
                                        @endfor
                                </select>
                                <div class="invalid-feedback">
                                    ¡El <strong>orden</strong> es un campo requerido!
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label for="activo">Estatus:</label><br>
                                <input type="checkbox" class="form-control" id="activo" name="activo" data-toggle="toggle" data-on="Activo" data-off="Inactivo" data-onstyle="success" data-offstyle="danger" data-width="100%" @if($dato->activo == 1) {{'checked'}} @endif/>
                            </div>
                        </div>

                        <input type="hidden" name="page" value="{{$page ?? ''}}" />
                        <input type="hidden" name="vbusqueda" value="{{$vbusqueda ?? ''}}" />

                        <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                        <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{url('/apartados?page='.$page.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".chosen").chosen();

    $("#apartado").keyup(function(e) {
        var str = $("#apartado").val();
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
        $("#slug").attr('placeholder', str);
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
            $("#menu").bootstrapToggle("off");
            $("#menu").bootstrapToggle("disable");
        } else {
            // Si no está marcado, deshabilita el $("#url")
            $("#url").prop("readonly", true);
            $("#url").val("");
            $("#target").bootstrapToggle("off");
            $("#target").bootstrapToggle("disable");
            $("#menu").bootstrapToggle("off");
            $("#menu").bootstrapToggle("enable");
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
                        if ($("#orden").val() == "") {
                            $("#orden_chosen").addClass("is-invalid");
                        } else {
                            $("#orden_chosen").addClass("is-valid");
                        }
                    }
                    form.classList.add("was-validated");
                    if ($("#orden").val() != "") {
                        $("#orden_chosen").addClass("is-valid");
                    }
                }, false);
            });
        }, false);
    })();
</script>
@endsection