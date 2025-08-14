@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-user-tag colorpersonal"></i> Listado de roles</h4>
                    </div>
                    
                    <div class="card-body">
                        <form class="form-inline" id="frmbusqueda" method="GET" action="{{ url('/roles') }}">
                            @csrf
                        
                            <div class="input-group mr-2 mb-2">
                                
                                <input type="text" class="form-control" name="vbusqueda" placeholder="Búsqueda" aria-label="Búsqueda" aria-describedby="button-addon2" value="{{ $vbusqueda }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-personal" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Buscar"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Limpiar" href="{{url('/roles')}}"><i class="fas fa-broom"></i></a>
                                </div>
                                
                            </div>

                        </form>
                        @if ( session('mensaje') )
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif 
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="card-header">
                                    <tr>   
                                        <th class="text-center align-middle" scope="col">Rol</th>
                                        <th class="text-center align-middle" scope="col">Slug</th>
                                        <th class="text-center align-middle" scope="col">Permisos</th>
                                        <th class="text-center align-middle" scope="col" colspan="2" width="12%"><a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Nuevo" href="{{ url('/roles/create?page='.$page.'&vbusqueda='.$vbusqueda) }}"><i class="fas fa-save"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{$item->name}}</th>
                                        <th class="text-center align-middle" scope="row">{{$item->slug}}</th>
                                        <th class="text-center align-middle" scope="row">
                                            @if($item->permissions != null)
                                                @foreach($item->permissions as $permisos)
                                                    <span class="badge badge-danger">
                                                        {{ $permisos->name }}
                                                    </span>                                
                                                @endforeach
                                            @endif
                                        </th>
                                        <td class="text-center" width="6%"><a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ url('/roles/'.$item->id.'/edit?page='.$page.'&vbusqueda='.$vbusqueda) }}"><i class="fas fa-pen"></i></a></td>
                                        
                                        <td class="text-center" width="6%">
                                            <form id="frmeliminar{{$item->id}}" method="POST" action="{{ url('/roles/'.$item->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-outline-personal" onclick="funeliminar('frmeliminar{{$item->id}}')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="card-header">
                                        <th class="text-center align-middle" colspan="5">Número de registros: <strong class="colorpersonal">{{$numero ?? ''}}</strong></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row justify-content-md-center">
                            {{$roles->withQueryString()->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

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