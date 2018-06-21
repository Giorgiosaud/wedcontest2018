<?php

namespace App\Mail;

use App\Contestant;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContestantRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Contestant $contestant)
    {
        $this->user=$user;
        $this->contestant=$contestant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contestant Registrado')->markdown('emails.concursante-registrado', 
            [
                'logo'=>asset('/storage/contest/rethinking-plastic/enLogo.jpg'),
                'user'=>$this->user,
                'contestant'=>$this->contestant
            ]);
    }
}
