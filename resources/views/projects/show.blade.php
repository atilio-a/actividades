@extends('layouts.admin')

@section('title', 'Datos del Proyecto')
@section('content-header', 'Proyecto')

@section('content')

    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('projects.show', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-8 col-8">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" disabled
                        value="{{ old('nombre', $project->nombre) }}">

                </div>
                <div class="form-group col-lg-8 col-8">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion" disabled
                        value="{{ old('descripcion', $project->descripcion ) }}">

                </div>

          
                <div class="form-group col-lg-8 col-8">
                    <label for="entity_id">Entidad</label>
                    <input type="text" name="entity_id" class="form-control" id="entity_id" placeholder="entity_id" disabled
                        value="{{ old('entity_id', $project->entity->nombre) }}">

                </div>

              

                <a href="{{ route('projects.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado</i></a>

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
