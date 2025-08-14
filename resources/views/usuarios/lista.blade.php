@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><i class="fas fa-user colorpersonal"></i> Listado de usuarios</h4>
                    </div>
                    
                    <div class="card-body">
                        <form class="form-inline" id="frmbusqueda" method="GET" action="{{url('/usuarios')}}">
                            @csrf
                        
                            <div class="input-group mr-2 mb-2">
                                
                                <input type="text" class="form-control" name="vbusqueda" placeholder="Búsqueda" aria-label="Búsqueda" aria-describedby="button-addon2" value="{{$vbusqueda}}">
                                
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-personal" id="button-addon2" data-toggle="tooltip" data-placement="top" title="Buscar"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Limpiar" href="{{url('/usuarios')}}"><i class="fas fa-broom"></i></a>
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
                                    <th class="text-center align-middle" scope="col">Nombre</th>
                                    <th class="text-center align-middle" scope="col">Correo electrónico</th>
                                    <th class="text-center align-middle" scope="col">Rol</th>
                                    <th class="text-center align-middle" scope="col">Permisos</th>
                                    <th class="text-center" scope="col" colspan="2" width="12%">
                                        @can('create', \App\Models\User::class)
                                            <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Nuevo" href="{{url('/usuarios/create?page='.$page.'&vbusqueda='.$vbusqueda)}}"><i class="fas fa-save"></i></a>
                                        @endcan
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $item)
                                    @if(!\Auth::user()->hasRole('administrador') && $item->hasRole('administrador')) @continue; @endif
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $item->name }}</th>
                                        <th class="text-center align-middle" scope="row">{{ $item->email }}</th>
                                        <th class="text-center align-middle" scope="row">
                                            @if($item->roles->isNotEmpty())
                                                @foreach ($item->roles as $role)
                                                    <span class="badge badge-danger">
                                                        {{$role->name}}
                                                    </span>                                     
                                                @endforeach    
                                            @endif
                                        </th>
                                        <th class="text-center align-middle" scope="row">
                                            @if ($item->permissions->isNotEmpty())
                                                @foreach ($item->permissions as $permission)
                                                    <span class="badge badge-danger">
                                                        {{$permission->name}}
                                                    </span>                                     
                                                @endforeach    
                                            @endif
                                        </th>
                                        <td class="text-center" width="6%">
                                            @can('update', $item)
                                                <a class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Editar" href="{{ url('/usuarios/'.$item->id.'/edit?page='.$page.'&vbusqueda='.$vbusqueda) }}"><i class="fas fa-pen"></i></a>
                                            @endcan
                                        </td>
                                        
                                        <td class="text-center" width="6%">
                                            @can('delete', $item)
                                                <form id="frmeliminar{{$item->id}}" method="POST" action="{{url('/usuarios/'.$item->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-outline-personal" onclick="funeliminar('frmeliminar{{$item->id}}')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash"></i></button>
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
                            {{$usuarios->withQueryString()->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();

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