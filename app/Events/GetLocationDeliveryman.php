<?php

namespace CodeDelivery\Events;

use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Order;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class GetLocationDeliveryman extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Geo
     */
    public $geo;
    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Geo $geo, Order $order)
    {
        $this->geo = $geo;
        $this->order = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->order->hash];
    }
}
