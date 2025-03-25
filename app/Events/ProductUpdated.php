<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product; // This will hold the product data to be broadcasted

    public function __construct(Product $product)
    {
        $this->product = $product; // Pass the product data to the event
    }

    // Define the channel that will be broadcasted on
    public function broadcastOn()
    {
        return new Channel('products');
    }

    // Define the name of the event that will be broadcasted
    public function broadcastAs()
    {
        return 'ProductUpdated';
    }
}