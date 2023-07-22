<?php

namespace App\Listeners;

use App\Events\CallWebhookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

class CallWebhookListener implements ShouldQueue
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
     * @param CallWebhookEvent $event
     * @return void
     */
    public function handle(CallWebhookEvent $event)
    {
        Http::get($event->url, ['status'=>$event->status]);
    }
}
