@extends('layouts.admin')

@section('title', 'Datos de Usuario')
@section('content-header', 'Cuenta de Usuario')

@section('content')

    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('users.show', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-8 col-8">
                    <label for="first_name">Nombre</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nombre" disabled
                        value="{{ old('first_name', $user->first_name . ', ' . $user->last_name) }}">

                </div>

                <div class="form-group col-lg-8 col-8">
                    <label for="telfono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" id="telefono" disabled
                        placeholder="Telefono" value="{{ old('telefono', $user->telefono) }}">
                </div>




                <div class="form-group col-lg-8 col-8">
                    <label for="email">Email</label>
                    <input required type="text" name="email" class="form-control" id="email" placeholder="email"
                        value="{{ old('email', $user->email) }}">
                </div>
                <div class="form-group col-lg-8 col-8">
                    <label for="entity_id">Entidad</label>
                    <input required type="text" name="entity_id" class="form-control" id="entity_id" placeholder="rol"
                        value="{{ old('entity_id', $user->entity->nombre) }}">
                </div>
                <a href="{{ route('usuarios.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al
                        Listado</i></a>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
