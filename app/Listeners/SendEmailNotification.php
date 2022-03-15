<?php

namespace App\Listeners;

use App\Events\AccountRegistered;
use App\Mail\AccountRegistered as MailAccountRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
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
     * @param  \App\Events\AccountRegistered  $event
     * @return void
     */
    public function handle(AccountRegistered $event)
    {
        $user = $event->user;
        Mail::to($user->email)
            ->send(new MailAccountRegistered($user));
    }
}
