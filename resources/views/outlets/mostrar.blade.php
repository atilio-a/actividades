@extends('layouts.app2')

@section('title', 'Escuelas Rurales de Jujuy')

@section('content')

 
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"> :)  Puede agregar fotos mas abajo</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td><i class="fas fa-school text-primary" aria-hidden="true"></i> {{ __('Nombre') }}</td><td>{{ $outlet->name }}</td></tr>
                         <tr><td><i class="fa fa-commenting-o text-primary" aria-hidden="true"></i> Observacion</td><td>{{ $outlet->observacion }}</td></tr>
                       
                        
                        <tr><td><i class="fa fa-list-alt text-primary" aria-hidden="true"></i> {{ __('Direccion:') }}</td><td>{{ $outlet->address }}</td></tr>
                        <tr><td><i class="fa fa-mobile"></i> Celular</td><td>{{ $outlet->celular }}</td></tr>
                        <tr><td><i class="fa fa-envelope" aria-hidden="true"></i> Email </td><td>{{ $outlet->email }}</td></tr>
                         <tr style="color:#227dc7;"><td ><i class="fa fa-camera" aria-hidden="true"></i> Puede agregar fotos  </td><td>mas abajo<i class="fa fa-picture-o" aria-hidden="true"></i></td></tr>
                                           
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer">
                @can('update', $outlet)
                    <a href="{{ route('outlets.edit', $outlet) }}" id="edit-outlet-{{ $outlet->id }}" class="btn btn-warning">{{ __('outlet.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('outlet_map.region') }}" class="btn btn-link">{{ __('Volver al mapa') }}</a>
                @else
                    <a href="{{ route('outlet_map.region') }}" class="btn btn-link">{{ __('Volver al mapa') }}</a>
                @endif
            </div>
            
            @if (count($imagenes) > 0)
                <div class="alert alert-success">
                    <ul>
                        @foreach ($imagenes as $imagen)
                        
                        <img src="{{ $imagen->image_path }}" alt="{{ $imagen->name }}" width="400" height="400">
                        @endforeach
                    </ul>
                </div>
            @endif

            
            
            
            
            
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
         
            @if ($outlet->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('outlet.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
 <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>
<div class="container mt-3">
        <h3 class="text-center mb-3" style="color:#c7f8c7;"><i class="fa fa-camera" aria-hidden="true"></i> Agregar Fotos <i class="fa fa-picture-o" aria-hidden="true"></i></h3>
        <form action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
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
               

                <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
              
                 <label class="custom-file-label" for="images" data-browse="Elegir imagen">click aqui para Elegir imagen</label>
               
                 
            </div>
            <input name="outlet_id" type="hidden" value="{{ $outlet->id }}">
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
               Click para Subir las imágenes y adjuntar a la escuela
            </button>
        </form>
    </div>
  
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
                        $($.parseHTML('<img width="200" height="100" >')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
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

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $outlet->latitude }}, {{ $outlet->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $outlet->latitude }}, {{ $outlet->longitude }}]).addTo(map)
        .bindPopup('{!! $outlet->map_popup_content !!}');
</script>
@endpush
