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
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        "App\Events\CallMade"=>[
          "App\Listeners\SendCallLink"
        ],
        "App\Events\CallMissed"=>[
          "App\Listeners\DestroyCallSession"
        ],
        "App\Events\CallReceived"=>[
          "App\Listeners\SetTimeStartedField"
        ],
        "App\Events\CallEnded"=>[
          "App\Listeners\SetTimeEndedField"
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
