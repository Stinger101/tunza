<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaregiverInvite extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $invite;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite,$user)
    {
        $this->user=$user;
        $this->invite=$invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.caregiver_invite')
        ->with([
          "invite"=>$this->invite,
          "user"=>$this->user
        ]);
    }
}
