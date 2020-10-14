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
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'company_name' => $this->company_name,
            'gst' => $this->gst,
            'phone' => $this->phone,
            'address' => $this->address,
            'user_notes' => $this->user_notes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'vendor_shipments' => $this->vendor_shipments,
        ];
    }
}
