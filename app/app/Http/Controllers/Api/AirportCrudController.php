<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airports = Airport::all();
        return response()->json($airports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:airports',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'country_id' => 'required|exists:countries,id'
        ]);

        $airport = Airport::create([
            'name' => $request->name,
            'code' => $request->code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'country_id' => $request->country_id
        ]);

        return response()->json($airport, 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:airports,code,'.$id,
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'country_id' => 'required|exists:countries,id'
        ]);

        $airport = Airport::findOrFail($id);
        $airport->name = $request->name;
        $airport->code = $request->code;
        $airport->latitude = $request->latitude;
        $airport->longitude = $request->longitude;
        $airport->country_id = $request->country_id;
        $airport->save();

        return response()->json($airport);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $airport = Airport::findOrFail($id);
        $airport->delete();
        return response()->json('Airport deleted.');
    }
}
