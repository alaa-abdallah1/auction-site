<?php

namespace App\Events;

use \App\Models\Item;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemWithBidsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item, $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->getItem($item);

        if ($this->getItem($item)->count() > 0) {
            $this->user_id = $this->getItem($item)[0]->user_id;
        }

        $this->item = $item;
    }


    public function broadcastWith()
    {
        $item = $this->item;

        if ($this->getItem($item)->count() > 0) {
            $item->hasAutoBid = true;
            $item->max_auto_bid = $this->getItem($item)[0]->max_auto_bid;
        }

        return ['itemWithBid' => $item];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('item-has-bid-' . $this->user_id);
    }

    public function getItem($item)
    {
        $itemWithBids = Item::with(['autoBids' => function ($query) use ($item) {
            $query->where('item_id', $item->id)->where('max_auto_bid', '>', $item->max_bid);
        }])->find($item->id);

        return $itemWithBids->autoBids;
    }
}
