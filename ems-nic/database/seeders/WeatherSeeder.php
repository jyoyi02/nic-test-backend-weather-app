<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Weather;
use App\Models\Location; // Assuming you have a Location model

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example 1: Manually create a few weather records
        $locations = Location::all();

        foreach ($locations as $location) {
            Weather::create([
                'location_id' => $location->id,
                'temperature' => rand(15, 40), // random temperature between 15–40°C
                'humidity' => rand(20, 90),    // random humidity %
                'wind_speed' => rand(5, 25),   // random wind speed (km/h)
                'precipitation' => rand(0, 10) // random precipitation (mm)
            ]);
        }

        // Example 2: Add some fixed examples
        Weather::create([
            'location_id' => 1,
            'temperature' => 32,
            'humidity' => 45,
            'wind_speed' => 10,
            'precipitation' => 0,
        ]);

        Weather::create([
            'location_id' => 2,
            'temperature' => 27,
            'humidity' => 68,
            'wind_speed' => 7,
            'precipitation' => 5,
        ]);

        Weather::create([
            'location_id' => 3,
            'temperature' => 21,
            'humidity' => 82,
            'wind_speed' => 12,
            'precipitation' => 8,
        ]);
    }
}
