@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-project-diagram colorpersonal"></i> Listado de apartados</h4>
                    </div>
                
                    <div class="card-body">
                        <form class="form-inline" id="frmbusqueda" method="GET" action="{{url('/apartados')}}">
                            @csrf
                            
                            <div class="input-group mr-2 mb-2">
                                
                                <input type="text" class="form-control" name="vbusqueda" placeholder="Búsqueda" aria-label="Búsqueda" aria-describedby="button-addon2" value="{{$vbusqueda}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-personal" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Buscar"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Limpiar" href="{{url('/apartados')}}"><i class="fas fa-broom"></i></a>
                                </div>
                                
                            </div>

                        </form>

                        @if (session('mensaje'))
                            <div class="alert alert-success">{{session('mensaje')}}</div>
                        @endif
                        
                        @if (session('mensajenegativo'))
                            <div class="alert alert-danger">{{session('mensajenegativo')}}</div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="card-header">
                                    <tr>
                                        <th class="text-center align-middle" scope="col">Apartado</th>
                                        <th class="text-center align-middle" scope="col">Traducción</th>
                                        <th class="text-center align-middle" scope="col">Slug</th>
                                        <th class="text-center align-middle" scope="col" width="5%">Orden</th>
                                        <th class="text-center align-middle" scope="col" width="7%">Activo</th>
                                        <th class="text-center" scope="col" colspan="3" width="12%">
                                            @can('create', \App\Models\Apartado::class)
                                                <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Nuevo" href="{{url('/apartados/create?page='.$page.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-save"></i></a>
                                            @endcan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datos as $item)
                                    <tr>
                                        <td class="align-middle" scope="row">{{$item->apartado}}</td>
                                        <td class="align-middle" scope="row">{{$item->apartadoen}}</td>
                                        <td class="align-middle" scope="row">{{$item->slug}}</td>
                                        <td class="text-center align-middle" scope="row">{{$item->orden}}</td>
                                        <td class="text-center" width="7%">
                                            @can('update', $item)
                                                <form id="frmpublicar{{$item->idapartado}}" name="frmpublicar{{$item->idapartado}}" method="POST" action="{{url('/apartados/'.$item->idapartado.'/estatus')}}">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="checkbox" id="activo" name="activo" onchange="funpublicar('frmpublicar{{$item->idapartado}}')"  data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" @if($item->activo == 1) {{'checked'}} @endif>
                                                </form>
                                            @endcan
                                        </td>
                                        <td class="text-center" width="6%">
                                            @can('update', $item)
                                                <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Editar" href="{{url('/apartados/'.$item->idapartado.'/edit?page='.$page.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-pen"></i></a>
                                            @endcan 
                                        </td>
                                        <td class="text-center" width="6%">
                                            @can('delete', $item)
                                                <form id="frmeliminar{{$item->idapartado}}" method="POST" action="{{url('/apartados/'.$item->idapartado)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-outline-personal" onclick="funeliminar('frmeliminar{{$item->idapartado}}')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="card-header">
                                        <th class="text-center align-middle" colspan="7">Número de registros: <strong class="colorpersonal">{{$numero ?? ''}}</strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row justify-content-md-center">
                            {{$datos->withQueryString()->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        
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
    </script>
@endsection