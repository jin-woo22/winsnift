<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $categories = array(
            ['name' => 'native / indigenous', 'created_at' => now()],
        );

        Category::insert($categories);

        Category::all()->each(fn(
            $category) => $service->log_activity(model:$category, event:'added', model_name: 'Category', model_property_name: $category->name)
        );
    }
}