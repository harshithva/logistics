<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\VendorPayment;

class VendorShipment extends JsonResource
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
            'total' => $this->total,
            'advance' => $this->advance,
            'shipment_id' => $this->shipment_id,
            'balance' => (int)$this->total - ((int)$this->advance + (int)VendorPayment::where('vendor_id', $this->vendor_id)->sum('amount')),
            'docket_no' => $this->shipment->docket_no,
            'from' => $this->shipment->package_pickup_address,
            'delivery_address' => $this->shipment->delivery_address,
            'sender_id' => $this->shipment->sender_id
            // 'shipment' => $this->shipment
        ];
    }
}
