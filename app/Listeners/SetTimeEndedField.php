<?php

namespace App\Listeners;

use App\Events\CallEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetTimeEndedField
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
     * @param  CallEnded  $event
     * @return void
     */
    public function handle(CallEnded $event)
    {
        //
    }
}
