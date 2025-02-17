<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([
            BarangaySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SpecieSeeder::class,
            //LocationSeeder::class,
            //PlantationSeeder::class,
            // PatientSeeder::class,
            // SettingSeeder::class,
        ]);

    }
}