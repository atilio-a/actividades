<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Escuelas Rurales de Jujuy</title>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
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
                font-size: 84px;
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
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="#">Todas las Regiones </a>
                     <a href="#/region1">Region I</a>
                     <a href="#/region2">Region II</a>

                     <a href="#/region3">Region III</a>

                     <a href="#/region4">Region IV</a>

                     <a href="#/region5">Region V</a>

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
                <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
            </head>
            
            <body>
                <h1 class='text-center'>Escuelas Rurales de Jujuy by Marco Antonio Farfan

                    <?php //echo json_encode($initialMarkers); ?>
                </h1>
                <div id='map'></div>
            
                <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
                <script>
                    let map, markers = [];
                    /* ------------------------------24.25326425032, -64.60074314945  Initialize Map ----------------------------- */
                    function initMap() {
                        map = L.map('map', {
                            center: {
                                lat: -24.25326425032,//  lat: {{ config('leaflet.map_center_latitude') }},
                                lng: -64.60074314945,// lng: {{ config('leaflet.map_center_longitude') }},
                            },
                            zoom: 11.8
                        });
            
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        
            
                        map.on('click', mapClicked);
                        initMarkers();
                    }
                    initMap();
// -24.23009861529, -64.86227886967  -24.23009861529, -64.86227886967   24.25705956872, -64.79934153766
var circle = L.circle([  -24.25705956872, -64.79934153766], {
    color: '#f03#f1d7d4',
    fillColor: '#f03',
    fillOpacity: 0.2,
    radius: 20000
}).addTo(map);
              
var circle = L.circle([-24.29770540722, -64.64330611739], {
    color: 'green',
    fillColor: 'green',
    fillOpacity: 0.5,
    radius: 800
}).addTo(map);
var polygon = L.polygon([
    [-24.13238096380, -64.82991388983 ],
    [-24.25138611272, -64.61167431409],
    [-24.36218781527, -64.69785780616],
    [-24.34842598111, -64.98619544033],
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



                <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr class="success">
                        <th class="text-center">{{ __('#') }}</th>
                        <th>{{ __('Escuelas Nombre') }}</th>
                       
                        
                        <th class="text-center">{{ __('Accion') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outlets as $key => $outlet)
                    <tr class="info">
                        <td class="text-center"><i class="fas fa-clock" ></i>{{ $outlet->id }}</td>
                        <td>{!! $outlet->name_link !!}</td>
                        
                       
                        <td class="text-center">
                            <a href="{{ route('outlets.show', $outlet) }}" id="show-outlet-{{ $outlet->id }}">{{ __('Ver Detalle') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </body>
            
            </div>
        </div>
    </body>
</html>
