@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-save colorpersonal"></i> Nuevo rol</h4>
                    </div>
                    
                    <div class="card-body">
                        
                        <form class="needs-validation" method="POST" action="{{ url('/roles') }}" novalidate>
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="250" placeholder="Nombre del rol" required>
                                    <div class="invalid-feedback">
                                        ¡El <strong>nombre</strong> es un campo requerido!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="slug">Slug:</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" maxlength="250" placeholder="Slug" readonly required>
                                    <div class="invalid-feedback">
                                        ¡El <strong>slug</strong> es un campo requerido!
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="permiso">Permisos:</label>
                                    <input type="text" class="form-control" id="permiso" name="permiso" data-role="tagsinput" maxlength="250">
                                    <div class="invalid-feedback">
                                        ¡La <strong>contraseña</strong> es un campo requerido y debe ser confirmado!
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="page" value="{{$page ?? ''}}">
                            <input type="hidden" name="vbusqueda" value="{{$vbusqueda ?? ''}}">

                            <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                            <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{ url('/roles?page='.$page.'&vbusqueda='.$vbusqueda) }}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $("#permiso").tagsinput({tagClass:'badge badge-danger'});

        // $(document).ready(function(){
        //     $("#nombre").keyup(function(e){
        //         var str= $("#nombre").val(); 
        //         str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
        //         $("#slug").val(str);
        //         $("#slug").attr('placeholder', str);
        //     });
        // });

        $(document).ready(function(){
            $("#nombre").keyup(function(e){
                var str= $("#nombre").val();
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
                $("#slug").attr('placeholder', str);
            });
        });

        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
    </script>
@endsection