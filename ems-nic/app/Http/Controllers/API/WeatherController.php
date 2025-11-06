<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function index()
    {
        $weathers = Weather::with('location')->get();
        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Weather fetched successfully.',
            'data' => $weathers
        ], 200);
    }

    public function show($location_id)
    {
        $weather = Weather::where('location_id', $location_id)
            ->latest('updated_at')
            ->firstOrFail();

        return response()->json([
            'status_code' => 200,
            'status' => 'Successful',
            'message' => 'Weather fetched successfully.',
            'data' => $weather
        ], 200);
    }



}
