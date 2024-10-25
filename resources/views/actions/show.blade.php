@extends('layouts.admin')

@section('title', 'Datos de la action')
@section('content-header', 'Actividad')

@section('content')
    <a href="{{ route('actions.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado de
            Actividades</i></a>
    @if ($action->mapa)
        <a href="{{ route('outlets.edit', $action->mapa) }}" class="btn btn-info"><i class="fa fa-map-marker"></i> Modificar
            en mapa<i class="fa fa-map-marker"></i></a>
    @else
        <a href="{{ route('outlets.create', ['action_id' => $action->id]) }}" class="btn btn-info"><i
                class="fa fa-map-marker"></i> Registar en mapa<i class="fa fa-map-marker"></i></a>
    @endif


    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('actions.show', $action) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-8 col-8">
                    <div class="form-group">
                        <label for="programa">
                            <strong>Actividad:</strong>
                        </label>
                    <input type="text" name="nombre" class="form-control" id="first_name" placeholder="Nombre" disabled
                        value="{{ old('Nombre', $action->nombre) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="programa">
                            <strong>Localidad:</strong>
                        </label>
                    <input type="text" name="localidad" class="form-control" id="localidad" placeholder="Localidad"
                        disabled
                        value="{{ old('Localidad',  $action->localidad->nombre . ' - ' . $action->localidad->departamento->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="programa">
                            <strong>Entidad Responsable:</strong>
                        </label>
                    <input type="text" name="entidad" class="form-control" id="entidad" placeholder="entidad" disabled
                        value="{{ old('Entidad', $action->entidad->nombre . ' - ' . optional($action->entidad->entidad_padre)->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="programa">
                            <strong>Responsable:</strong>
                        </label>
                    <input type="text" name="responsable" class="form-control" id="responsable"
                        placeholder="rensponsable" disabled
                        value="{{ old('Responsable', $action->team->nombre . ', ' . $action->team->apellido) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="programa">
                            <strong>Programa:</strong>
                        </label>
                        <input type="text" name="programa" class="form-control" id="programa" placeholder="programa"
                            disabled value="{{ old('programa', $action->program->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="programa">
                            <strong>Proyecto:</strong>
                        </label>
                    <input type="text" name="proyecto" class="form-control" id="proyecto" placeholder="proyecto"
                        disabled value="{{ old('Proyecto:', $action->project->nombre) }}">
                    </div>

                    <div class="form-group">
                        <label for="programa">
                            <strong>Direccion:</strong>
                        </label>
                    <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion"
                        disabled
                        value="{{ old('direccion:', $action->direccion . '- Telefono:  ' . $action->telefono) }}">
                    </div>

                    <div class="form-group">
                        <label for="programa">
                            <strong>Descripcion de la actividad:</strong>
                        </label>
                    <input type="text" name="nombre" class="form-control" id="first_name" placeholder="Nombre" disabled
                        value="{{ old('descripcion:',  $action->descripcion . '- codigo:  ' . $action->codigo) }}">
                    </div>

                </div>




            </form>

            @if (count($imagenes) > 0)
                <div class="alert alert-success">
                    <ul>
                        @foreach ($imagenes as $imagen)
                            <img src="{{ $imagen->image_path }}" alt="{{ $imagen->name }}" width="400" height="400">
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="container mt-3">
                <h3 class="text-center mb-3" style="color:#c7f8c7;"><i class="fa fa-camera" aria-hidden="true"></i> Agregar
                    Fotos <i class="fa fa-picture-o" aria-hidden="true"></i></h3>
                <form action="{{ route('imageUpload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="user-image mb-3 text-center">
                        <div class="imgPreview"> </div>
                    </div>

                    <div class="custom-file">


                        <input type="file" name="imageFile[]" class="custom-file-input" id="images"
                            multiple="multiple">

                        <label class="custom-file-label" for="images" data-browse="Elegir imagen">click aqui para Elegir
                            imagen</label>


                    </div>
                    <input name="action_id" type="hidden" value="{{ $action->id }}">
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                        Click para Subir las imágenes
                    </button>
                </form>
            </div>
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


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img width="200" height="100" >')).attr('src', event.target
                                .result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>




@endsection
