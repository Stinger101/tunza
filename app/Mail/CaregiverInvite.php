<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Caregiver;

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
    public function __construct(Caregiver $invite,User $user)
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
      //->subject('Invite to caregiver role')
        return $this->markdown('caregiverinvite',[
          "invite"=>$this->invite,
          "user"=>$this->user
        ]);
    }
}
