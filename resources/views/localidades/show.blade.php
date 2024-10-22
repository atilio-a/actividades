@extends('layouts.admin')

@section('title', 'Datos de la Localidad')
@section('content-header', 'Localidad')

@section('content')

    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('localidades.show', $localidad) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-8 col-8">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="first_name" placeholder="Nombre" disabled
                        value="{{ old('nombre', $localidad->nombre . ' Departemaneto:  ' . $localidad->departamento->nombre) }}">

                </div>

              

                <a href="{{ route('localidades.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado</i></a>

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
