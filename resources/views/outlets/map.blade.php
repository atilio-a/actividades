@extends('layouts.admin')

@section('content')
<head>
	
  <!-- Styles -->
  <style>
    html, body {
        background-color: #fff;
        color: #d1d6d8;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 104px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 1px;
    }
</style>
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
        
           
 </head>
 <body>

    <div class="flex-center position-ref full-height">
       

        <div class="content">
            <div id='map'></div>
            <div class="title m-b-md">
                Mapa de Actividades
            </div>

           

            <style>
                .text-center {
                    text-align: center;
                }
                #map {
                    width: '100%';
                    height: 600px;
                }
            </style>
           
            
        
            <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
            <script>
                let map, markers = [];
                /* ----------------------------- Initialize Map ----------------------------- */
                function initMap() {
                    map = L.map('map', {
                        center: {
                            lat: {{ config('leaflet.map_center_latitude') }},
                            lng: {{ config('leaflet.map_center_longitude') }},
                        },
                        zoom: 12
                    });
        
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    
        
                    map.on('click', mapClicked);
                    initMarkers();
                }
                initMap();

var circle = L.circle([ -24.24317183888, -65.22973307560], {
color: 'red',
fillColor: '#f03',
fillOpacity: 0.5,
radius: 800
}).addTo(map);
          
var circle = L.circle([-24.26732188955, -65.21053895260], {
color: 'green',
fillColor: 'green',
fillOpacity: 0.5,
radius: 800
}).addTo(map);
var polygon = L.polygon([
[-24.24, -65.20],
[-24.254, -65.21324162],
[-24.254, -65.22324162],
]).addTo(map);


var theMarker;

map.on('click', function(e) {
let latitude = e.latlng.lat.toString().substring(0, 15);
let longitude = e.latlng.lng.toString().substring(0, 15);

if (theMarker != undefined) {
    map.removeLayer(theMarker);
};

var popupContent = "Tu locacion : " + latitude + ", " + longitude + ".";
popupContent += '<br><a href="{{ route('outlets.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Deseas agregar una nueva marca aqui??</a>';

theMarker = L.marker([latitude, longitude]).addTo(map);
theMarker.bindPopup(popupContent)
.openPopup();
});
                /* --------------------------- Initialize Markers --------------------------- */
                function initMarkers() {
                    const initialMarkers = <?php echo json_encode($initialMarkers); ?>;
        
                    for (let index = 0; index < initialMarkers.length; index++) {
        
                        const data = initialMarkers[index];
                        const marker = generateMarker(data, index);
                        marker.addTo(map).bindPopup(`<b>${data.position.dato},${data.position.lat},  ${data.position.lng}</b>`);
                        map.panTo(data.position);
                        markers.push(marker)
                    }
                }
        
                function generateMarker(data, index) {
                    return L.marker(data.position, {
                            draggable: data.draggable
                        })
                        .on('click', (event) => markerClicked(event, index))
                        .on('dragend', (event) => markerDragEnd(event, index));
                }
               
                /* ------------------------- Handle Map Click Event ------------------------- */
                function mapClicked($event) {
                    console.log(map);
                    console.log($event.latlng.lat, $event.latlng.lng);
                }
        
                /* ------------------------ Handle Marker Click Event ----------------------- */
                function markerClicked($event, index) {
                    console.log(map);
                    console.log($event.latlng.lat, $event.latlng.lng);
                }
        
                /* ----------------------- Handle Marker DragEnd Event ---------------------- */
                function markerDragEnd($event, index) {
                    console.log(map);
                    console.log($event.target.getLatLng());
                }
            </script>
        </body>
            
 @endsection