<?php

namespace App\Events;

use App\Models\AutoBid;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use \App\Models\Item;

class AutoBidEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $autoBid, $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($autoBid, $message)
    {
        $this->autoBid = $autoBid;
        $this->message = $message;
    }

    public function broadcastWith()
    {


        $autoBidWithItem = AutoBid::with('item:id,name')->find($this->autoBid->id);

        if ($this->message === 'canceled') {
            $this->autoBid->delete();
        }

        return ['autoBid' => $autoBidWithItem, 'message' => $this->message];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notify-with-bid-' . $this->autoBid->user_id);
    }
}
