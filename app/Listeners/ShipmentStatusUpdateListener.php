<?php

namespace App\Listeners;
use App\Settings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Helpers;

class ShipmentStatusUpdateListener
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
    public function handle($event)
    {
        // Helpers::send_whatsapp_update($event->shipment->sender->phone, $event->shipment->docket_no, $event->shipment->status->status);
        Helpers::send_whatsapp_update('9110650853','GLBN006','Delivered');
    }
}
