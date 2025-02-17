<?php

namespace Database\Seeders;

use App\Models\Plantation;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $plantations = array(
            [
                'specie_id' => 1,
                'location_id' => 1,
                'method' => 'seedling',
                'planted_at' => now()->addDays(mt_rand(1,5)),
                'created_at' => now()
            ],
            [
                'specie_id' => 2,
                'location_id' => 2,
                'method' => 'sapling',
                'planted_at' => now()->addDays(mt_rand(1,5)),
                'created_at' => now()
            ],
            [
                'specie_id' => 3,
                'location_id' => 3,
                'method' => 'seedling',
                'planted_at' => now()->addDays(mt_rand(1,5)),
                'created_at' => now()
            ],
        );

        Plantation::insert($plantations);

        Plantation::all()->each(fn(
            $plantation) => $service->log_activity(model:$plantation, event:'added', model_name: 'Plantation', model_property_name: $plantation->specie->scientific_name . ' ' . $plantation->location->name)
        );
    }
}