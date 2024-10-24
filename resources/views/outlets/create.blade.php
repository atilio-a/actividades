@extends('layouts.admin')
@section('title', __('Registar Mapa'))

@section('content')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <style> 
        #map { 
          width: 100%; 
          height: 380px; 
          box-shadow: 5px 5px 5px #888; 
        } 
       </style>
       
    <div id="map"></div>
    <script> 
      
var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('map').setView(mapCenter, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Tu ubicacion :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
        </script>
</body> 



<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"><i class="fa fa-map-marker text-primary" aria-hidden="true"></i> {{ __('Marcar en el Mapa( Usar el mouse en la imagen del mapa)') }} <i class="fa fa-map-marker text-primary" aria-hidden="true"></i></div>
            <form method="POST" action="{{ route('outlets.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">

                    <label for="name" class="control-label">Actividad: {{ $action->nombre}}</label>

                    <div class="d-none">
                        <label for="name" class="control-label">{{ __('Nombre') }}</label>
                        <input id="name" type="text" class="form-control" name="action_id" value="{{ $action->id }}" >
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $action->nombre }}" >
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <!--div class="form-group">
                        <label for="address" class="control-label"><i class="fa fa-home" aria-hidden="true"></i>{{ __('outlet.address2') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="4">{{ old('address') }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div-->
                  
                
                     <div class="d-none">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular" class="control-label">Celular <i class="fa fa-phone text-primary"></i></label>
                                <input id="celular" type="text" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular', request('celular')) }}" >
                                {!! $errors->first('celular', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                         
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email <i class="fa fa-envelope text-primary" aria-hidden="true"></i></label>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', request('email')) }}" >
                                {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-none">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observacion" class="control-label">Observacion <i class="fa fa-commenting-o text-primary"></i></label>
                                <input id="observacion" type="text" class="form-control{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ old('observacion', request('observacion')) }}" >
                                {!! $errors->first('observacion', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                         
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="control-label">Referencia <i class="fa fa-list-alt text-primary" aria-hidden="true"></i></label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', request('address')) }}" >
                                {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                   
                      <div class="d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required  readonly>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required readonly>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="card-footer">
                    <input type="submit" value="Registrar" class="btn btn-success">
                    <a href="{{ route('actions.index') }}" class="btn btn-link">{{ __('cancelar') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



<script>
   

   
</script>

