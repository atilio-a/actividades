@extends('layouts.admin')

@section('title', ' Entidades')
@section('content-header', ' Entidades')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('entities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                        id="nombre" placeholder="nombre" value="{{ old('name') }}">
                    @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="name">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                        placeholder="descripcion" value="{{ old('descripcion') }}">
                    @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="name">Telefono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        placeholder="telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="name">Mail</label>
                    <input type="text" name="mail" class="form-control @error('mail') is-invalid @enderror" id="mail"
                        placeholder="mail" value="{{ old('mail') }}">
                    @error('mail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
    
                <div class="form-group">
                    <label for="entity_id">Depende </label>
                    <select name="entity_id" class="form-control" required>
                        <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                        @foreach ($entidades_padre as $entidad_padre)
                            <option value="{{ $entidad_padre->id }}">{{ $entidad_padre->nombre }}
                            </option>
                        @endforeach
                        
                    </select>
                </div>
                
           

             



                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar Entidad</button>
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
