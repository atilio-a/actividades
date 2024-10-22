<?php

namespace App\Http\Controllers;

use App\Http\Resources\Outlet;
use App\Http\Resources\Outlet as OutletResource;
use App\Models\Outlet as ModelsOutlet;
use Illuminate\Http\Request;
use Mail;
class OutletMapController extends Controller
{



    public function index2()
    {
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 28.625485,
                    'lng' => 79.821091
                ],
                'draggable' => true
            ],
            [
                'position' => [
                    'lat' => 28.625293,
                    'lng' => 79.817926
                ],
                'draggable' => false
            ],
            [
                'position' => [
                    'lat' => 28.625182,
                    'lng' => 79.81464
                ],
                'draggable' => true
            ]
        ];
        return view('welcome', compact('initialMarkers'));
    }
    /**
     * Show the outlet listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
      //  echo  'Feature';
        $outlets = ModelsOutlet::all();

        $geoJSONdata = $outlets->map(function ($outlet) {
            return [
                    'properties' => new OutletResource($outlet),
                  
                    'position' => [
                                        'lat' => $outlet->latitude,
                                        'dato' =>  $outlet->name,
                                        'lng' => $outlet->longitude
                                    ],
                    /*

                    'type'       => 'Feature',
                    'properties' => new OutletResource($outlet),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $outlet->longitude,
                            $outlet->latitude,
                        ],
                    
                    ],*/
            ];
        });
      ///  echo $geoJSONdata;
/*
        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
        */
        $initialMarkers= $geoJSONdata;
        return view('outlets.map', compact('initialMarkers'));
      //  return view('outlets.map', compact('geoJSONdata'));
    }


    public function region(Request $request)
    {
      //  echo  'Feature';
        $outlets = ModelsOutlet::all();

        $geoJSONdata = $outlets->map(function ($outlet) {
            return [
                    'properties' => new OutletResource($outlet),
                  
                    'position' => [
                                        'lat' => $outlet->latitude,
                                        'dato' =>  $outlet->name,
                                        'lng' => $outlet->longitude
                                    ],
                    /*

                    'type'       => 'Feature',
                    'properties' => new OutletResource($outlet),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $outlet->longitude,
                            $outlet->latitude,
                        ],
                    
                    ],*/
            ];
        });
      ///  echo $geoJSONdata;
/*
        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
        */
        $initialMarkers= $geoJSONdata;
        return view('welcome', compact('initialMarkers', 'outlets'));
      //  return view('outlets.map', compact('geoJSONdata'));
    }
}
