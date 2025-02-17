<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $locations = array(
            [
                'name' => 'Mahogany Forest Park',
                'latitude' => '15.218756272703734',
                'longitude' => '120.70044596147004',
                'created_at' => now()
            ],
            [
                'name' => 'Garden A',
                'latitude' => '15.218675',
                'longitude' => '120.700404',
                'created_at' => now()
            ],
            [
                'name' => 'Garden B',
                'latitude' => '15.21798637542426',
                'longitude' => '120.70345932747128',
                'created_at' => now()
            ],

        );

        Location::insert($locations);

        Location::all()->each(fn(
            $location) => $service->log_activity(model:$location, event:'added', model_name: 'Location', model_property_name: $location->name)
        );
    }
}