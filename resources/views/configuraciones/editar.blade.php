@extends('layouts.app')

@section('content')

<div class="modal fade" id="MyModalAddMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="divaddmap"></div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-pen colorpersonal"></i> Editar configuración</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{url('/configuraciones/'.$dato->idconfiguracion)}}" novalidate>
                        @method('PUT')
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="img">Logotipo:</label>
                                <img class="rounded mx-auto d-block mb-2 bg-secondary" id="img" name="img" width="40%" src="@if($dato->imagen=='') {{asset('storage/img/default.png')}} @else {{asset('storage/configuraciones/'.$dato->imagen)}} @endif" alt="Seleccionar imagen" />
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen" name="imagen" lang="es" aria-describedby="imagen" accept=".jpeg,.jpg,.png,.svg" />
                                    <label class="custom-file-label" for="imagen">@if($dato->imagen=='') {{'Seleccionar imagen'}} @else {{$dato->imagen}} @endif</label>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="img">Banner:</label>
                                <img class="rounded mx-auto d-block mb-2 bg-secondary" id="imgc" name="imgc" width="40%" src="@if($dato->imagenc=='') {{asset('storage/img/default.png')}} @else {{asset('storage/configuraciones/'.$dato->imagenc)}} @endif" alt="Seleccionar imagen" />
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagenc" name="imagenc" lang="es" aria-describedby="imagen" accept=".jpeg,.jpg,.png,.svg" />
                                    <label class="custom-file-label" for="imagen">@if($dato->imagenc=='') {{'Seleccionar imagen'}} @else {{$dato->imagenc}} @endif</label>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="img">Calendario:</label>
                                <img class="rounded mx-auto d-block mb-2 bg-secondary" id="imgcal" name="imgcal" width="40%" src="@if($dato->imagencalendario=='') {{asset('storage/img/default.png')}} @else {{asset('storage/configuraciones/'.$dato->imagencalendario)}} @endif" accept=".pjeg,.jpg,.png,.svg" alt="Seleccionar imagen">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagencalendario" name="imagencalendario" lang="es" aria-describedby="imagen" accept=".jpeg,.jpg,.png,.svg" />
                                    <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{$dato->nombre}}" maxlength="200" required />
                                <div class="invalid-feedback">
                                    ¡El <strong>nombre</strong> es un campo requerido!
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" cols="30" rows="3" maxlength="500" placeholder="Descripción, spot o lema">{{$dato->descripcion}}</textarea>
                            </div>
                            <div class="form-group col-4">
                                <label for="descripcionen">Traducción descripción:</label>
                                <textarea class="form-control" id="descripcionen" name="descripcionen" cols="30" rows="3" maxlength="500" placeholder="Traducción descripción, spot o lema">{{$dato->descripcionen}}</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="telefonoprincipal">Teléfono principal:</label>
                                <input type="tel" class="form-control" id="telefonoprincipal" name="telefonoprincipal" value="{{$dato->telefonoprincipal}}" maxlength="100" placeholder="Teléfono principal" />
                            </div>
                            <div class="form-group col-3">
                                <label for="telefonosecundario">Teléfono secundario:</label>
                                <input type="tel" class="form-control" id="telefonosecundario" name="telefonosecundario" value="{{$dato->telefonosecundario}}" maxlength="100" placeholder="Teléfono secundario o fax" />
                            </div>
                            <div class="form-group col-3">
                                <label for="correoprincipal">Correo electrónico principal:</label>
                                <input type="email" class="form-control" id="correoprincipal" name="correoprincipal" value="{{$dato->correoprincipal}}" maxlength="200" placeholder="Correo electrónico principal" />
                            </div>
                            <div class="form-group col-3">
                                <label for="correosecundario">Correo electrónico secundario:</label>
                                <input type="email" class="form-control" id="correosecundario" name="correosecundario" value="{{$dato->correosecundario}}" maxlength="200" placeholder="Correo electrónico secundrio" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="whatsapp">Whatsapp:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-whatsapp color-whatsapp"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="prefijo" name="prefijo" value="{{$dato->prefijo}}" maxlength="5" placeholder="Prefijo +521" />
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{$dato->whatsapp}}" maxlength="20" placeholder="Número a 10 digitos" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="facebook">Facebook:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-facebook color-facebook"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{$dato->facebook}}" maxlength="200" placeholder="Facebook" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="instagram">Instagram:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-instagram color-instagram"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="instagram" name="instagram" value="{{$dato->instagram}}" maxlength="200" placeholder="Instagram" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="twitter">Twitter:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-twitter color-twitter"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{$dato->twitter}}" maxlength="200" placeholder="Twitter" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="youtube">Youtube:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-youtube color-youtube"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="youtube" name="youtube" value="{{$dato->youtube}}" maxlength="200" placeholder="Youtube" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="tiktok">Tiktok:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fab fa-tiktok"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="tiktok" name="tiktok" value="{{$dato->tiktok}}" maxlength="200" placeholder="Tiktok" />
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="pagina">Sitio WEB:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-globe"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="pagina" name="pagina" value="{{$dato->pagina}}" maxlength="200" placeholder="Pagina WEB" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="buzon">Sitio correo:</label>
                                <input type="url" class="form-control" id="buzon" name="buzon" value="{{$dato->buzon}}" maxlength="200" placeholder="Correo del buzón" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="direccion">Dirección:</label>
                                <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="3" maxlength="200" placeholder="Dirección">{{$dato->direccion}}</textarea>
                            </div>
                            <div class="form-group col-4">
                                <label for="latitud">Latitud:</label>
                                <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud" maxlength="20" value="{{$dato->latitud}}" />
                            </div>
                            <div class="form-group col-4">
                                <label for="longitud">Longitud:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud" maxlength="20" value="{{$dato->longitud}}" />
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-personal" id="btnubicacion" href="javascript:MuestraModal();"><i class="fas fa-map-marker-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <div class="custom-control custom-switch" style="transform: scale(1.2); transform-origin: left;">
                                    <input type="checkbox" class="custom-control-input" id="busqueda_activa" name="busqueda_activa" {{ old('busqueda_activa', $dato->busqueda_activa) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="busqueda_activa">Activar / Desactivar</label>
                                </div>
                                <small class="form-text text-muted">Este interruptor activa o desactiva el buscador en el sistema.</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                        <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{ url('/home') }}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();

    $("#imagen").change(function() {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf(".") + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg")) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#img").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $("#img").attr("src", "/storage/img/default.png");
        }
    });
    $("#imagenc").change(function() {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf(".") + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg")) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imgc").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $("#imgc").attr("src", "/storage/img/default.png");
        }
    });

    bsCustomFileInput.init();

    $("#telefonoprincipal").validCampoFranz("-+()0123456789 ");
    $("#telefonosecundario").validCampoFranz("-+()0123456789 ");
    $("#prefijo").validCampoFranz("+0123456789");
    $("#whatsapp").validCampoFranz("0123456789");

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