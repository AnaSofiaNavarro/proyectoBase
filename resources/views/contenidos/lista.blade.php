@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-info-circle colorpersonal"></i> Listado de contenidos</h4>
                    </div>

                    <div class="card-body">
                        <form class="form" id="frmbusqueda" action="{{ url('/contenidos') }}" method="GET">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" id="vfecha" name="vfecha"
                                        placeholder="Fecha" aria-label="Fecha" value="{{ $vfecha }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control chosen" id="vapartado" name="vapartado">
                                        <option value="">Apartado</option>
                                        @foreach ($apartados as $item)
                                            @if ($vapartado == $item->idapartado)
                                                <option value="{{ $item->idapartado }}" selected>{{ $item->apartado }}
                                                </option>
                                            @else
                                                <option value="{{ $item->idapartado }}">{{ $item->apartado }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control chosen" id="vseccion" name="vseccion">
                                        <option value="">Sección</option>
                                        @foreach ($secciones as $item)
                                            @if ($vseccion == $item->idseccion)
                                                <option value="{{ $item->idseccion }}" selected>{{ $item->seccion }}
                                                </option>
                                            @else
                                                <option value="{{ $item->idseccion }}">{{ $item->seccion }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="vbusqueda" name="vbusqueda"
                                            placeholder="Búsqueda" aria-label="Búsqueda" aria-describedby="button-addon2"
                                            value="{{ $vbusqueda }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-personal" id="button-addon2"
                                                data-toggle="tooltip" data-placement="top" title="Buscar"><i
                                                    class="fas fa-search"></i></button>
                                            <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top"
                                                title="Limpiar" href="{{ url('/contenidos') }}"><i
                                                    class="fas fa-broom"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="input-group mr-2 mb-2">
                                <input type="text" class="form-control" id="vfecha" name="vfecha" placeholder="Fecha" aria-label="Fecha" value="{{ $vfecha }}" readonly>
                            </div> --}}

                            {{-- <div class="input-group mr-2 mb-2">
                                
                            </div> --}}

                            {{-- <div class="input-group mr-2 mb-2">
                                
                            </div> --}}



                        </form>

                        @if (session('mensaje'))
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif

                        @if (session('mensajenegativo'))
                            <div class="alert alert-danger">{{ session('mensajenegativo') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="card-header">
                                    <tr>
                                        <th class="text-center align-middle" width="10%" scope="col">Fecha</th>
                                        <th class="text-center align-middle" scope="col">Apartado</th>
                                        <th class="text-center align-middle" scope="col">Sección</th>
                                        <th class="text-center align-middle" scope="col">Encabezado</th>
                                        <th class="text-center align-middle" scope="col">Traducción</th>
                                        <th class="text-center align-middle" scope="col">Slug</th>
                                        <th class="text-center align-middle" scope="col">Activo</th>
                                        <th class="text-center" scope="col" colspan="4">
                                            @can('create', \App\Models\Vcontenido::class)
                                                <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top"
                                                    title="Nuevo"
                                                    href="{{ url('/contenidos/create?page=' . $page . '&vfecha=' . $vfecha . '&vapartado=' . $vapartado . '&vseccion=' . $vseccion . '&vbusqueda=' . $vbusqueda) }}"><i
                                                        class="fas fa-save"></i></a>
                                            @endcan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datos as $item)
                                        <tr>
                                            <th class="text-center align-middle" scope="row">
                                                {{ date('d/m/Y', strtotime($item->fecha)) }}</th>
                                            <td class="align-middle">{{ $item->apartado }}</td>
                                            <td class="align-middle">{{ $item->seccion }}</td>
                                            <td class="align-middle">{{ $item->encabezado }}</td>
                                            <td class="align-middle">{{ $item->encabezadoen }}</td>
                                            <td class="align-middle">{{ $item->contenidoslug }}</td>
                                            <td class="text-center" width="7%">
                                                @can('update', $item)
                                                    <form id="frmpublicar{{ $item->idcontenido }}"
                                                        name="frmpublicar{{ $item->idcontenido }}" method="POST"
                                                        action="{{ url('/contenidos/' . $item->idcontenido . '/estatus') }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="checkbox" id="activo" name="activo"
                                                            onchange="funpublicar('frmpublicar{{ $item->idcontenido }}')"
                                                            data-toggle="toggle" data-on="Si" data-off="No"
                                                            data-onstyle="success" data-offstyle="danger"
                                                            @if ($item->activo == 1) {{ 'checked' }} @endif>
                                                    </form>
                                                @endcan
                                            </td>
                                            <td class="text-center" width="6%">
                                                @can('update', $item)
                                                    <a class="btn btn-outline-personal" data-toggle="tooltip"
                                                        data-placement="top" title="Editar"
                                                        href="{{ url('/contenidos/' . $item->idcontenido . '/edit?page=' . $page . '&vfecha=' . $vfecha . '&vapartado=' . $vapartado . '&vseccion=' . $vseccion . '&vbusqueda=' . $vbusqueda) }}"><i
                                                            class="fas fa-pen"></i></a>
                                                @endcan
                                            </td>
                                            <td class="text-center" width="6%">
                                                @can('update', $item)
                                                    <a class="btn btn-outline-personal" data-toggle="tooltip"
                                                        data-placement="top" title="Galería"
                                                        href="{{ url('/contenidoanexos/' . $item->idcontenido . '?page=' . $page . '&vfecha=' . $vfecha . '&vapartado=' . $vapartado . '&vseccion=' . $vseccion . '&vbusqueda=' . $vbusqueda) }}"><i
                                                            class="fas fa-images"></i></a>
                                                @endcan
                                            </td>
                                            <td class="text-center" width="6%">
                                                @can('delete', $item)
                                                    <form id="frmeliminar{{ $item->idcontenido }}"
                                                        action="{{ url('/contenidos/' . $item->idcontenido) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="btn btn-outline-personal"
                                                            onclick="funeliminar('frmeliminar{{ $item->idcontenido }}')"
                                                            data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="card-header">
                                        <th class="text-center align-middle" colspan="10">Número de registros: <strong
                                                class="colorpersonal">{{ $numero ?? '' }}</strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row justify-content-md-center">
                            {{ $datos->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $("#toggle-demo").bootstrapToggle();
        $(".chosen").chosen();

        $("#vfecha").datepicker({
            footer: true,
            uiLibrary: "bootstrap4",
            locale: "es-es",
            format: "dd/mm/yyyy",
            change: function(e) {
                $("#frmbusqueda").submit();
            }
        });

        $("#vapartado").change(function() {
            $("#frmbusqueda").submit();
        });

        $("#vseccion").change(function() {
            $("#frmbusqueda").submit();
        });

        function funpublicar(frm) {
            $("#" + frm).submit();
        }

        function funeliminar(frm) {
            $.confirm({
                title: "Borrar",
                content: "¡Confirmación!",
                type: "dark",
                typeAnimated: true,
                buttons: {
                    yes: {
                        text: "Si",
                        btnClass: "btn-success",
                        keys: ["enter"],
                        action: function() {
                            $("#" + frm).submit();
                        }
                    },
                    no: function() {},
                }
            });
        }
    </script>
@endsection
