<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Http\Request;
use Meilisearch\Client;

class AirportsApiController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $country = $request->input('country');



        $airports = Airport::search($query)->where('country_id',$country)->get();

        return response()->json($airports);
    }

    public function searchNearestAirports(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $airports = Airport::search('', function ($meilisearch, $query, $options) use ($latitude, $longitude) {
            //$options['sort'] = '_geoRadius(' . $latitude . ', ' . $longitude . ', 30000)';

            $options['sort'] = ['_geoPoint(' . $latitude . ', ' . $longitude . '):asc'];
            // $options['limit'] = 5;
            return $meilisearch->search($query, $options);
        })->get()->mapWithKeys(function ($value) use ($latitude, $longitude) {
            return [$value->id => [
                'id' => $value->id,
                'name' => $value->name,
                'distance_me' => number_format($value->scoutMetadata()['_geoDistance'],0,'','.')." km"
            ]];
        });

        return response()->json($airports);

    }
}
