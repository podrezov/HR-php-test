<?php

namespace App\Listeners;

use App\Events\OrderCompletedEvent;
use App\Mail\OrderCompletedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendCompletionNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCompletedEvent $event)
    {
        $order = $event->order->load(['products.vendor', 'partner']);
        $partner = $order->partner;
        $products = $order->products;

        $vendors = [];
        foreach ($products as $product) {
            $vendors[] = $product->vendor;
        }

        $recipients = collect($vendors)->unique('email');
        $recipients->push($partner);

        Mail::to($recipients)->queue(new OrderCompletedMail($order));
    }
}
