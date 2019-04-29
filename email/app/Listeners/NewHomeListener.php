<?php

namespace App\Listeners;

use App\Events\HomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewHomeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(HomeEvent $event)
    {
        info("Entrou no Home 2 NewHomeListener");
        info($event->text);
    }
}
