@extends('layouts.app')

@section('content')

    <head>
        <!-- Choices.js CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

        <!-- Choices.js JS -->
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    </head>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const choices = new Choices('#secciones', {
                removeItemButton: true,
                placeholderValue: 'Selecciona secciones',
                searchPlaceholderValue: 'Buscar...',
                noResultsText: 'No hay coincidencias',
                noChoicesText: 'No hay opciones disponibles',
                itemSelectText: 'Presiona Enter para seleccionar',
                shouldSort: false,

                callbackOnCreateTemplates: function(template) {
                    return {
                        item: (classNames, data) => {
                            return template(`
                <div class="${classNames.item} d-inline-flex align-items-center shadow-sm border border-1 rounded-sm pl-3 py-1 m-1"
                    data-item
                    data-id="${data.id}"
                    data-value="${data.value}"
                    ${data.active ? 'aria-selected="true"' : ''}
                    ${data.disabled ? 'aria-disabled="true"' : ''}>

                    <span class="me-2 text-dark fw-semibold">${data.label}</span>
                    <span 
                        data-button 
                        role="button" 
                        aria-label="Eliminar"
                        class="text-danger fw-bold fs-2 px-2"
                        style="color:#C90166 !important; cursor: pointer; font-size: 1.3rem; font-weight:bold;">&times;</span>
                </div>
            `);
                        }
                    };
                }


            });

            const select = document.getElementById('secciones');

            select.addEventListener('change', function() {
                const values = Array.from(select.selectedOptions).map(opt => opt.value);
                if (values.includes('__all__')) {
                    for (let i = 0; i < select.options.length; i++) {
                        if (select.options[i].value !== '__all__') {
                            choices.setChoiceByValue(select.options[i].value);
                        }
                    }
                    choices.removeActiveItemsByValue('__all__');
                }
            });
        });
    </script>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-save colorpersonal"></i> Nuevo usuario</h4>
                    </div>

                    <div class="card-body">

                        <form class="needs-validation" method="POST" action="{{ url('/usuarios') }}" novalidate>
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="250"
                                        placeholder="Nombre del usuario" required />
                                    <div class="invalid-feedback">
                                        ¡El <strong>nombre</strong> es un campo requerido!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono') }}" maxlength="20" placeholder="Número de teléfono" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email " class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" maxlength="250"
                                        placeholder="Correo electrónico" required />
                                    <div class="invalid-feedback">
                                        ¡El <strong>correo electrónico</strong> es un campo requerido!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="contraseña">Contraseña:</label>
                                    <input type="password" class="form-control @error('contraseña') is-invalid @enderror"
                                        id="contraseña" name="contraseña" maxlength="250" placeholder="Contraseña"
                                        required />
                                    <div class="invalid-feedback">
                                        ¡La <strong>contraseña</strong> es un campo requerido y debe ser confirmado!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="contraseña_confirmation">Confirma contraseña:</label>
                                    <input type="password"
                                        class="form-control @error('contraseña_confirmation') is-invalid @enderror"
                                        id="contraseña_confirmation" name="contraseña_confirmation" maxlength="250"
                                        placeholder="Confirmación de contraseña" required />
                                    <div class="invalid-feedback">
                                        ¡La <strong>confirmación</strong> es un campo requerido!
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="secciones" class="form-label fw-bold">Secciones visibles para el
                                        usuario:</label>
                                    <select id="secciones" name="secciones[]" multiple class="form-select"
                                        aria-label="Seleccione secciones">
                                        <option value="__all__" style="font-weight: bold;">Seleccionar todo</option>
                                        @foreach ($secciones as $seccion)
                                            <option value="{{ $seccion->idseccion }}">
                                                {{ $seccion->seccion ?? $seccion->slug }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="role">Roles:</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">Rol</option>
                                        @foreach ($roles as $item)
                                            @if (old('role') == $item->id)
                                                <option data-role-id="{{ $item->id }}"
                                                    data-role-slug="{{ $item->slug }}" value="{{ $item->id }}"
                                                    selected>{{ $item->name }}</option>
                                            @else
                                                <option data-role-id="{{ $item->id }}"
                                                    data-role-slug="{{ $item->slug }}" value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row" id="permissions_box">
                                <div class="form-group col-12">
                                    <label for="role">Permisos:</label>
                                    <div id="permissions_checkbox_lista"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="role">Nota:</label>
                                    <textarea class="form-control" name="nota" id="nota" cols="30" rows="3" placeholder="Nota">{{ old('nota') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="activo">Estatus:</label><br>
                                    <input type="checkbox" class="form-control" id="activo" name="activo"
                                        data-toggle="toggle" data-on="Activo" data-off="Inactivo" data-onstyle="success"
                                        data-offstyle="danger" checked />
                                </div>
                            </div>

                            <input type="hidden" name="page" value="{{ $page ?? '' }}" />
                            <input type="hidden" name="vbusqueda" value="{{ $vbusqueda ?? '' }}" />

                            <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip"
                                data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                            <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top"
                                title="Regresar"
                                href="{{ url('/usuarios?page=' . $page . '&vbusqueda=' . $vbusqueda) }}"><i
                                    class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();

        $("#telefono").validCampoFranz("0123456789");

        $(document).ready(function() {
            var permissions_box = $("#permissions_box");
            var permissions_checkbox_lista = $("#permissions_checkbox_lista");

            permissions_box.hide();

            $("#role").on("change", function() {
                var role = $(this).find(":selected");
                var role_id = role.data("role-id");
                var role_slug = role.data("role-slug");

                permissions_checkbox_lista.empty();

                //console.log(role_id);
                var url = "{{ url('/usuarios/create') }}";
                $.ajax({
                    url: url,
                    method: "get",
                    dataType: "json",
                    data: {
                        "role_id": role_id,
                        "role_slug": role_slug
                    }
                }).done(function(data) {
                    //console.log(data);
                    permissions_box.show();
                    $.each(data, function(index, element) {
                        $(permissions_checkbox_lista).append(
                            "<div class='custom-control custom-checkbox'>" +
                            "<input class='custom-control-input' type='checkbox' name='permissions[]' id='" +
                            element.slug + "' value='" + element.id + "'>" +
                            "<label class='custom-control-label' for='" + element.slug +
                            "'>" + element.name + "</label>" +
                            "</div>"
                        );
                    });
                })
            });
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
                        }
                        form.classList.add("was-validated");
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
