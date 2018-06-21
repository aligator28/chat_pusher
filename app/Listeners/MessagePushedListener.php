<?php

namespace App\Listeners;

use App\Events\MessagePushed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessagePushedListener
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
     * @param  MessagePushed  $event
     * @return void
     */
    public function handle(MessagePushed $event)
    {
        // dd($event->chatMessage[1]);
        // return $event;
    }
}
