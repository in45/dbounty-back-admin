<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use App\Http\Controllers\NodeJSController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageCreatedListener
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
     * @param  MessageCreated  $event
     * @return void
     */
    public function handle(MessageCreated $event)
    {

        if($event->message->type == 'am') NodeJSController::post('message_am',['report_message'=>$event->message->ToArray()]);
        if($event->message->type == 'au') NodeJSController::post('message_au',['report_message'=>$event->message->ToArray()]);

    }
}
