<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;


class DebuctProductQuantity
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
    public function handle(object $event): void
    {
        $order = $event->order;
        
        
    try{


    foreach ($order->products as $product) {
        $product->decrement('quantity', $product->order_item->quantity);
        
        // Product::where('id', '=', $item->product_id)
        //     ->update([
        //         'quantity' => DB::raw("quantity - {$item->quantity}")
        //     ]);
    }

  }
catch(Throwable $e){

}
     
    }
}
