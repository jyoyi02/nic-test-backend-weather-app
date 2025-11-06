<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Weather;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('weather')->get();

        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Locations fetched successfully.',
            'data' => $locations
        ], 200);
    }


    public function show($id)
    {
        $location = Location::with('weather')->findOrFail($id);

        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Location fetched successfully.',
            'data' => $location
        ], 200);
    }



    public function search(Request $request)
    {
        $request->validate([
            'location' => 'required|string'
        ]);

        $locationInput = $request->input('location');

        // Use Eloquent to fetch location and related weather
        $location = Location::with(['weather' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->where('name', 'like', '%' . $locationInput . '%')
            ->get();

        if ($location->isEmpty()) {
            return response()->json(['message' => 'Weather data not found for this location.'], 404);
        }

        return response()->json(['data' => $location]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create($validated);

        // Step 2: Insert default Weather data
        Weather::create([
            'location_id' => $location->id,
            'temperature' => '39',
            'humidity' => 24,
            'wind_speed' => '14',
            'precipitation' => '0'
        ]);

        return response()->json([
            'status_code' => 201,
            'status' => 'Successful',
            'message' => 'Location registered successfully.',
            'data' => [
                'location' => [
                    'id' => $location->id,
                    'name' => $location->name,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                ],
            ]
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->all());

        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Location updated successfully.',
            'data' => [
                'location' => [
                    'id' => $location->id,
                    'name' => $location->name,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                ],
            ]
        ], 200);
    }


    public function destroy($id)
    {
        Location::destroy($id);
        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Location deleted successfully.',
        ], 200);
    }
}
