@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-images colorpersonal"></i> Galería</h4>
                    </div>

                    <div class="card-body">
                        
                        @if ( session('mensaje') )
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center"><strong>Guardar</strong></div>
                                    <div class="card-body">
                                        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{url('/contenidoanexos')}}" novalidate>
                                        @csrf

                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <select class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                                        <option value="">Tipo</option>
                                                        @foreach ($tipos as $item)
                                                            @if (old('tipo') == $item->idtipo)
                                                                <option value="{{$item->idtipo}}" selected>{{$item->tipo}}</option>
                                                            @else
                                                                <option value="{{$item->idtipo}}">{{$item->tipo}}</option>
                                                            @endif
                                                        @endforeach  
                                                    </select> 
                                                    <div class="invalid-feedback">
                                                        ¡El <strong>tipo</strong> es un campo requerido!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row" id="divanexo">
                                                <div class="form-group col-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('anexo') is-invalid @enderror" id="anexo" name="anexo" lang="es" aria-describedby="anexo" disabled required>
                                                        <label class="custom-file-label" for="anexo" id="labelanexo">Seleccionar anexo</label>
                                                        <div class="invalid-feedback">
                                                            ¡El <strong>anexo</strong> es un campo requerido!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row d-none" id="divdescripcionfile">
                                                <div class="form-group col-12">
                                                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" maxlength="250" placeholder="Descripción">
                                                    <div class="invalid-feedback">
                                                        ¡La <strong>Descripción</strong> es un campo requerido!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row d-none" id="divurl">
                                                <div class="form-group col-12">
                                                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" maxlength="250" placeholder="Código de YouTube">
                                                    <div class="invalid-feedback">
                                                        ¡La <strong>URL</strong> es un campo requerido!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <input type="checkbox" class="form-control" id="activo" name="activo" data-toggle="toggle" data-on="Público" data-off="Privado" data-onstyle="success" data-offstyle="danger" checked>
                                                </div>
                                            </div>

                                            <input type="hidden" id="fkcontenido" name="fkcontenido" value="{{$id}}">

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>
                                                    <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Regresar" href="{{url('/contenidos?page='.$page.'&vfecha='.$vfecha.'&vapartado='.$vapartado.'&vseccion='.$vseccion.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <table class="table table-bordered">
                                    <thead class="card-header">
                                        <tr>
                                            <th class="text-center" scope="col" colspan="4">Anexos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datos as $item)
                                            <tr>
                                                <td class="text-center">
                                                    @if($item->fktipo == 1)
                                                        <img class="img-thumbnail" src="{{asset('storage/anexos/'.$item->imagen)}}" alt="{{$item->imagen}}">
                                                        <p class="text-danger mb-0">{{asset('storage/anexos/'.$item->imagen)}}</p>
                                                    @elseif($item->fktipo == 2)
                                                        <video width="100%" controls>
                                                            <source src="{{asset('storage/anexos/'.$item->video)}}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <p class="text-danger mb-0">{{$item->video}}</p>
                                                    @elseif($item->fktipo == 3)
                                                        <a class="text-danger" href="{{asset('storage/anexos/descargas.php?f='.$item->archivo)}}">
                                                            <i class="fas fa-file-pdf fa-10x"></i><br>{{asset('storage/anexos/'.$item->archivo)}}</a>
                                                    @elseif($item->fktipo == 4)
                                                        <iframe width="100%" src="https://www.youtube.com/embed/{{$item->url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        <p class="text-danger mb-0">https://www.youtube.com/embed/{{$item->url}}</p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->descripcion)
                                                        <p class="text-danger mb-0">{{$item->descripcion}}</p> 
                                                    @endif    
                                                </td>
                                                <td class="text-center">
                                                    <form id="frmpublicar{{$item->idanexo}}" name="frmpublicar{{$item->idanexo}}" method="POST" action="{{url('/contenidoanexos/'.$item->idanexo)}}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="checkbox" id="activo" name="activo" onchange="funpublicar('frmpublicar{{$item->idanexo}}')"  data-toggle="toggle" data-on="Público" data-off="Privado" data-onstyle="success" data-offstyle="danger" @if($item->activo == 1) {{'checked'}} @endif>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <form id="frmeliminar{{$item->idanexo}}" method="POST" action="{{url('/contenidoanexos/'.$item->idanexo)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                        <button type="button" class="btn btn-outline-personal" onclick="funeliminar('frmeliminar{{$item->idanexo}}')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $("#toggle-demo").bootstrapToggle();

        $("#tipo").change(function(e){
            var tipo = $(this).val();
            $("#anexo").removeAttr("disabled");
            if(tipo == 1)
            {
                $("#divanexo").removeClass("d-none");
                $("#anexo").attr("required", true);

                $("#divurl").addClass("d-none");
                $("#url").removeAttr("required");
                $("#url").val("");

                $("#divdescripcionfile").removeClass("d-none");
                $("#descripcion").removeAttr("required");
                $("#descripcion").val("");

                $("#anexo").val("")
                $("#labelanexo").empty().append("Seleccionar anexo");
            
                $("#anexo").removeAttr("accept");
                $("#anexo").attr("accept", "image/jpg,image/png,image/jpeg");
            }
            else if(tipo == 2)
            {
                $("#divanexo").removeClass("d-none");
                $("#anexo").attr("required", true);

                $("#divurl").addClass("d-none");
                $("#url").removeAttr("required");
                $("#url").val("");

                $("#divdescripcionfile").addClass("d-none");
                $("#descripcion").removeAttr("required");
                $("#descripcion").val("");

                $("#anexo").val("")
                $("#labelanexo").empty().append("Seleccionar anexo");
                
                $("#anexo").removeAttr("accept");
                $("#anexo").attr("accept", "video/mp4");
            }
            else if(tipo == 3)
            {
                $("#divanexo").removeClass("d-none");
                $("#anexo").attr("required", true);

                $("#divurl").addClass("d-none");
                $("#url").removeAttr("required");
                $("#url").val("");

                $("#divdescripcionfile").removeClass("d-none");
                $("#descripcion").attr("required", true);
                $("#descripcion").val("");

                $("#anexo").val("")
                $("#labelanexo").empty().append("Seleccionar anexo");
                
                $("#anexo").removeAttr("accept");
                $("#anexo").attr("accept", "application/pdf");
            }
            else if(tipo == 4)
            {
                $("#divanexo").addClass("d-none");
                $("#anexo").removeAttr("required");

                $("#divurl").removeClass("d-none");
                $("#url").attr("required", true);
                $("#url").val("");

                $("#divdescripcionfile").addClass("d-none");
                $("#descripcion").removeAttr("required");
                $("#descripcion").val("");

                $("#anexo").val("")
                $("#labelanexo").empty().append("Seleccionar anexo");
            }
            else
            {
                $("#divanexo").removeClass("d-none");
                $("#anexo").val("")
                $("#labelanexo").empty().append("Seleccionar anexo");
                $("#anexo").attr("disabled", true);

                $("#divurl").addClass("d-none");
                $("#url").removeAttr("required");
                $("#url").val("");

                $("#divdescripcionfile").addClass("d-none");
                $("#descripcion").removeAttr("required");
                $("#descripcion").val("");
            }
        });
        
        bsCustomFileInput.init();

        function funpublicar(frm)
        {
            $("#"+frm).submit();
        }

        function funeliminar(frm)
        {
            $.confirm({
                title: 'Borrar',
                content: '¡Confirmación!',
                type: 'dark',
                typeAnimated: true,
                buttons:{
                    yes:{
                        text: 'Si',
                        btnClass: 'btn-success',
                        keys: ['enter'],
                        action: function(){
                            $("#"+frm).submit();
                        }
                    },
                    no: function(){
                    },
                }
            });
        }
        
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