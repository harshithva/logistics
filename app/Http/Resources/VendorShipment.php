<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'advance' => $this->shipment_id,
            'balance' => (int)$this->total - ((int)$this->advance + VendorPayment::where('vendor_id', $this->vendor_id)->sum('amount')),
            // 'shipment' => $this->shipment
        ];
    }
}
