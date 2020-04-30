<?php

namespace App\Listeners;

use App\Events\CallReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetTimeStartedField
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
     * @param  CallReceived  $event
     * @return void
     */
    public function handle(CallReceived $event)
    {
        //
    }
}
