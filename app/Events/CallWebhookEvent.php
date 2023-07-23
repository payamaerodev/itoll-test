<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallWebhookEvent implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public string $longitude;
    public string $latitude;
    public string $status;
    public string $url;

    /**
     * Create a new event instance.
     *
     * @param string $webhook_url
     * @param int $longitude
     * @param int $latitude
     * @param string $status
     */
    public function __construct(string $webhook_url, int $longitude, int $latitude, string $status)
    {
        $this->url = $webhook_url;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PrivateChannel|array
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        return new PrivateChannel('channel-name');
    }
}
