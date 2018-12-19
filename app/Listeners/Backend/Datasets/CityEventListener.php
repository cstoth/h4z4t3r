<?php

namespace App\Listeners\Backend\Datasets\City;

/**
 * Class CityEventListener.
 */
class CityEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('City Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('City Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('City Deleted');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Datasets\City\CityCreated::class,
            'App\Listeners\Backend\Datasets\City\CityEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Datasets\City\CityUpdated::class,
            'App\Listeners\Backend\Datasets\City\CityEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Datasets\City\CityDeleted::class,
            'App\Listeners\Backend\Datasets\City\CityEventListener@onDeleted'
        );
    }
}
