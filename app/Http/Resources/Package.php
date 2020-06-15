<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Package extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'shipment_date'=> $this->shipment->date,
            'description'=> $this->description,
            'shipment_sender_address' => $this->shipment->sender->address,
            'shipment_delivery_address' => $this->shipment->delivery_address,
            'shipment_docket_no' => $this->shipment->docket_no,
            'shipment_freight_invoice_number' => $this->shipment->freight_invoice_number,
            'shipment_charge_total' => $this->shipment->charge_total,
            'shipment_sender_name' => $this->shipment->sender->name,
            'shipment_receiver_name' => $this->shipment->receiver->name,
            'shipment_sender_gst' => $this->shipment->sender->gst,
            'shipment_receiver_gst' => $this->shipment->receiver->gst,
          ];
    }

}
