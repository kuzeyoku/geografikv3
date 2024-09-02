<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Events\MessageSending;

class ChangeMailSettingsBeforeSending
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSending $event): void
    {

    }
}
