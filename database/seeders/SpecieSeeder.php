<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $species = array(
            [
                'category_id' => 1,
                'scientific_name' => 'Quercus alba',
                'generic_name' => 'White Oak',
                'family' => 'Fagaceae',
                'description' => 'Deciduous tree with lobed',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Acer rubrum ',
                'generic_name' => 'Red Maple',
                'family' => 'Sapindaceae',
                'description' => 'Deciduous tree with red',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Artocarpus heterophyllus',
                'generic_name' => 'Jackfruit',
                'family' => 'Moraceae',
                'description' => 'Evergreen tree with large, lobed leaves and sweet, fleshy fruit.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Santol (Sandoricum koetjape)',
                'generic_name' => 'Santol',
                'family' => 'Meliaceae',
                'description' => 'Evergreen tree with fragrant flowers and edible, sour fruits.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Lansium domesticum',
                'generic_name' => 'Lanzones',
                'family' => 'Meliaceae',
                'description' => 'Evergreen tree with glossy leaves and small, sweet fruits.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Mangifera indica',
                'generic_name' => 'Mango',
                'family' => 'Anacardiaceae',
                'description' => 'Evergreen tree with fragrant flowers and large, sweet fruits.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Cocos nucifera',
                'generic_name' => 'Coconut Palm',
                'family' => 'Arecaceae',
                'description' => 'Tall palm with pinnate leaves and large, coconut fruits.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Agathis philippinensis',
                'generic_name' => 'Philippine Kauri',
                'family' => 'Araucariaceae',
                'description' => 'Large evergreen tree with cone-shaped crown and cone-like fruits.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Mimusops elengi',
                'generic_name' => 'Bullet Wood',
                'family' => 'Sapotaceae',
                'description' => 'Evergreen tree with fragrant flowers and hard, durable wood.',
                'created_at' => now()
            ],
            [
                'category_id' => 1,
                'scientific_name' => 'Dipterocarpus grandiflorus',
                'generic_name' => 'Philippine Mahogany',
                'family' => 'Dipterocarpaceae',
                'description' => 'Tall hardwood tree with large, winged fruits and valuable timber.',
                'created_at' => now()
            ],

        );

        Specie::insert($species);

        Specie::all()->each(function($specie) use($service) 
        {

            $specie->addMedia(public_path("/tmp_files/species/1.png"))->preservingOriginal()->toMediaCollection('featured_photo');

            $service->log_activity(model:$specie, event:'added', model_name: 'Specie', model_property_name: $specie->scientific_name);
            
        });
       
    }
}