<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        \App\Models\Category::class => [
            \App\Observers\CategoryObserver::class
        ],
        \App\Models\Location::class => [
            \App\Observers\LocationObserver::class
        ],
        \App\Models\Plantation::class => [
            \App\Observers\PlantationObserver::class
        ],
        \App\Models\Specie::class => [
            \App\Observers\SpecieObserver::class
        ],
    
    ];

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}