@extends('layouts.admin')

@section('title', ' Personas')
@section('content-header', ' Personas')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
                        id="apellido" placeholder="apellido" value="{{ old('apellido') }}">
                    @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                        id="telefono" placeholder="telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror"
                        id="mail" placeholder="mail" value="{{ old('mail') }}">
                    @error('mail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror"
                        id="observaciones" placeholder="observaciones" value="{{ old('observaciones') }}">
                    @error('observaciones')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="entity_id">Entidad</label>
                    <select name="entity_id" class="form-control" required>
                        <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                        @foreach ($entities as $entity)
                            <option value="{{ $entity->id }}">{{ $entity->nombre }}</option>
                        @endforeach
                    </select>
                </div>


             



                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar la persona</button>
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
