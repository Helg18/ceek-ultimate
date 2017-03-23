<?php

namespace App\Listeners;

use Sellout\MailHandler;
use App\Events\UserAccountCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
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
     * @param  UserAccountCreated  $event
     * @return void
     */
    public function handle(UserAccountCreated $event)
    {
        $mailer = new MailHandler;
        $mailer->to = $event->user->email;
        $mailer->type = 'ceek_welcome';
        if(env('EMAIL_WELCOME') === true) return $mailer->send();
    }
}
