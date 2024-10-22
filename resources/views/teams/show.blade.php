@extends('layouts.admin')

@section('title', 'Datos de la Persona')
@section('content-header', 'Persona')

@section('content')

    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('teams.show', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-8 col-8">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" disabled
                        value="{{ old('nombre', $team->nombre . ', ' . $team->apellido) }}">

                </div>
                <div class="form-group col-lg-8 col-8">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control" id="telefono" placeholder="telefono" disabled
                        value="{{ old('telefono', $team->telefono ) }}">

                </div>

                <div class="form-group col-lg-8 col-8">
                    <label for="mail">Correo</label>
                    <input type="text" name="mail" class="form-control" id="mail" placeholder="mail" disabled
                        value="{{ old('mail', $team->mail) }}">

                </div>

                <div class="form-group col-lg-8 col-8">
                    <label for="observaciones">Observacion</label>
                    <input type="text" name="observaciones" class="form-control" id="observaciones" placeholder="observaciones" disabled
                        value="{{ old('observaciones', $team->observaciones) }}">

                </div>
                <div class="form-group col-lg-8 col-8">
                    <label for="entity_id">Entidad</label>
                    <input type="text" name="entity_id" class="form-control" id="entity_id" placeholder="entity_id" disabled
                        value="{{ old('entity_id', $team->entity->nombre) }}">

                </div>

              

                <a href="{{ route('teams.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado</i></a>

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
