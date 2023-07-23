<?php

namespace App\Listeners;

use App\Events\CallWebhookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

class CallWebhookListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param CallWebhookEvent $event
     * @return void
     */
    public function handle(CallWebhookEvent $event): void
    {
        Http::get($event->url, [
            'longitude' => $event->longitude,
            'latitude' => $event->latitude,
            'status' => $event->status
        ]);
    }
}
