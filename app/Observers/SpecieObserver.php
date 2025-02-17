<?php

namespace App\Observers;

use App\Models\Specie;
use App\Services\ActivityLogsService;

class SpecieObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    
    /**
     * Handle the Specie "created" event.
     *
     * @param  \App\Models\Specie  $specie
     * @return void
     */
    public function created(Specie $specie)
    {
        $this->service->log_activity(model:$specie, event:'added', model_name:'Specie', model_property_name: $specie->scientific_name);
    }

    /**
     * Handle the Specie "updated" event.
     *
     * @param  \App\Models\Specie  $specie
     * @return void
     */
    public function updated(Specie $specie)
    {
        $this->service->log_activity(model:$specie, event:'updated', model_name:'Specie', model_property_name: $specie->scientific_name);
    }

    /**
     * Handle the Specie "deleted" event.
     *
     * @param  \App\Models\Specie  $specie
     * @return void
     */
    public function deleted(Specie $specie)
    {
        $this->service->log_activity(model:$specie, event:'deleted', model_name:'Specie', model_property_name: $specie->scientific_name);
    }

    /**
     * Handle the Specie "restored" event.
     *
     * @param  \App\Models\Specie  $specie
     * @return void
     */
    public function restored(Specie $specie)
    {
        //
    }

    /**
     * Handle the Specie "force deleted" event.
     *
     * @param  \App\Models\Specie  $specie
     * @return void
     */
    public function forceDeleted(Specie $specie)
    {
        //
    }
}