<?php

namespace App\Observers;

use App\Models\Plantation;
use App\Services\ActivityLogsService;

class PlantationObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the Plantation "created" event.
     *
     * @param  \App\Models\Plantation  $plantation
     * @return void
     */
    public function created(Plantation $plantation)
    {
        $this->service->log_activity(model:$plantation, event:'added', model_name:'Plantation', model_property_name: $plantation->location->specie->scientific_name . ' to ' . $plantation->location->name);
    }

    /**
     * Handle the Plantation "updated" event.
     *
     * @param  \App\Models\Plantation  $plantation
     * @return void
     */
    public function updated(Plantation $plantation)
    {
        $this->service->log_activity(model:$plantation, event:'updated', model_name:'Plantation', model_property_name: $plantation->location->specie->scientific_name . ' to ' . $plantation->location->name);
    }

    /**
     * Handle the Plantation "deleted" event.
     *
     * @param  \App\Models\Plantation  $plantation
     * @return void
     */
    public function deleted(Plantation $plantation)
    {
        $this->service->log_activity(model:$plantation, event:'deleted', model_name:'Plantation', model_property_name: $plantation->specie->scientific_name . ' to ' . $plantation->location->name);
    }

    /**
     * Handle the Plantation "restored" event.
     *
     * @param  \App\Models\Plantation  $plantation
     * @return void
     */
    public function restored(Plantation $plantation)
    {
        //
    }

    /**
     * Handle the Plantation "force deleted" event.
     *
     * @param  \App\Models\Plantation  $plantation
     * @return void
     */
    public function forceDeleted(Plantation $plantation)
    {
        //
    }
}