<?php

namespace App\Listeners;

use App\Events\CallMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCallLink
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
     * @param  CallMade  $event
     * @return void
     */
    public function handle(CallMade $event)
    {
        //
    }
}
