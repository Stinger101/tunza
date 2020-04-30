<?php

namespace App\Listeners;

use App\Events\CallMissed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyCallSession
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
     * @param  CallMissed  $event
     * @return void
     */
    public function handle(CallMissed $event)
    {
        //
    }
}
