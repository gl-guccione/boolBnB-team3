<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Flat;
use Facade\FlareClient\Http\Response;

class GeoSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function geo_search(Request $request)
    {

        function km_distance ( $coordinate_a, $coordinate_b ) {

          list($decLatA, $decLonA) = array_map('trim', explode(',', $coordinate_a));
          list($decLatB, $decLonB) = array_map('trim', explode(',', $coordinate_b));

          $radLatA = pi() * $decLatA / 180;
          $radLonA = pi() * $decLonA / 180;
          $radLatB = pi() * $decLatB / 180;
          $radLonB = pi() * $decLonB / 180;

          $phi = abs($radLonA - $radLonB);

          $P = acos (
                      (sin($radLatA) * sin($radLatB)) +
                      (cos($radLatA) * cos($radLatB) * cos($phi))
                    );

          return $P * 6372.795477598;
        }

        if (isset($request->latlong)) {

          $latlong = $request->latlong;

          // dd(km_distance($latlong, '39.031234,10.846305'));

          $flats = Flat::where('active', true)->get();
          foreach ($flats as $flat) {

            $coordinate = $flat->lat.','.$flat->lng;

            $flat->distance_km = km_distance($latlong, $coordinate);

          }

          return response()->json($flats);

        } else {

            return response()->json(['error'=>'missing required parameter']);

        }

    }
}
