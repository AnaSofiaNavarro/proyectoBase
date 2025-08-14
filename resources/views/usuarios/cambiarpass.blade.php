@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-save colorpersonal"></i> Cambiar Contraseña</h4>
                </div>

                <div class="card-body">
                    @if (session('mensaje'))
                    <div class="alert alert-danger">{{session('mensaje')}}</div>
                    @endif

                    <form class="needs-validation" method="POST" action="{{ route('usuarios.updatepassword') }}" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="nombre">Contraseña:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" maxlength="18" placeholder="Contraseña" required />
                                <div class="invalid-feedback">
                                    ¡La <strong>contraseña</strong> es un campo requerido y deben coincidir, Minimo 8 Carácteres!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4 mt-3">
                                <label for="nombre">Repetir Contraseña:</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password') }}" maxlength="18" placeholder="Contraseña" required />
                                <div class="invalid-feedback">
                                    ¡La <strong>contraseña</strong> es un campo requerido y deben coincidir, Minimo 8 Carácteres!
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-outline-personal" data-toggle="tooltip" data-placement="top" title="Guardar"><i class="fas fa-save"></i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection