<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Create some common city locations
        $locations = [
            [
                'name' => 'New York City',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
            ],
            [
                'name' => 'Los Angeles',
                'latitude' => 34.0522,
                'longitude' => -118.2437,
            ],
            [
                'name' => 'London',
                'latitude' => 51.5074,
                'longitude' => -0.1278,
            ],
            [
                'name' => 'Tokyo',
                'latitude' => 35.6895,
                'longitude' => 139.6917,
            ],
            [
                'name' => 'Sydney',
                'latitude' => -33.8688,
                'longitude' => 151.2093,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
