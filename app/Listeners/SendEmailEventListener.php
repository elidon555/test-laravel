<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Models\User;
use App\Notifications\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailEventListener
{
    private $data;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendEmailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        User::query()->first()->notify(new SendMail($event->data));
    }
}
