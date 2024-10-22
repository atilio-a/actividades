@extends('layouts.admin')

@section('title', ' Actividades')
@section('content-header', ' Actividades')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('actions.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="entity_id">Entidad</label>
                    <select name="entity_id" class="form-control" required>
                        <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                        @foreach ($entidades as $entidad)
                            <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="team_id">Encargado principal</label>
                    <select name="team_id" class="form-control" required>
                        <!-- Aquí debes cargar los team_id desde tu base de datos -->
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id }}"> {{ $persona->nombre }} {{ $persona->apellido }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="team_id">Programa</label>
                    <select name="program_id" class="form-control" required>
                        <!-- Aquí debes cargar los team_id desde tu base de datos -->
                        @foreach ($programs as $programa)
                            <option value="{{ $programa->id }}"> {{ $programa->nombre }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="team_id">Proyecto</label>
                    <select name="project_id" class="form-control" required>
                        <!-- Aquí debes cargar los team_id desde tu base de datos -->
                        @foreach ($projects as $proyecto)
                            <option value="{{ $proyecto->id }}"> {{ $proyecto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="localidad_id">Localidad</label>
                    <select name="localidad_id" class="form-control" required>
                        <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                        @foreach ($localidades as $localidad)
                            <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="direccion">direccion</label>
                    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                        id="direccion" placeholder="direccion" value="{{ old('direccion') }}">
                    @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="direccion">telefono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                        id="telefono" placeholder="telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="avatar">avatar</label>
                    <input type="text" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                        id="avatar" placeholder="avatar" value="{{ old('avatar') }}">
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="monto_estimado">Monto Estimado</label>
                    <input type="text" name="monto_estimado" class="form-control @error('monto_estimado') is-invalid @enderror"
                        id="monto_estimado" placeholder="monto_estimado" value="{{ old('monto_estimado') }}">
                    @error('monto_estimado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="codigo">codigo</label>
                    <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                        id="codigo" placeholder="codigo" value="{{ old('codigo') }}">
                    @error('codigo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags">tags</label>
                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror"
                        id="tags" placeholder="tags" value="{{ old('tags') }}">
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fecha">fecha</label>
                    <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
                        id="fecha" placeholder="fecha" value="{{ old('fecha') }}">
                    @error('fecha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">descripcion</label>
                    <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                        id="descripcion" placeholder="descripcion" value="{{ old('descripcion') }}">
                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="repuesta">repuesta</label>
                    <input type="text" name="repuesta" class="form-control @error('repuesta') is-invalid @enderror"
                        id="repuesta" placeholder="repuesta" value="{{ old('repuesta') }}">
                    @error('repuesta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="respuesta_fecha">respuesta_fecha</label>
                    <input type="date" name="respuesta_fecha" class="form-control @error('respuesta_fecha') is-invalid @enderror"
                        id="respuesta_fecha" placeholder="respuesta_fecha" value="{{ old('respuesta_fecha') }}">
                    @error('respuesta_fecha')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar Actividad</button>
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
