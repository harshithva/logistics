<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Payment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $createdAt = Carbon::parse($this->created_at);
        return [
            'id' => $this->id,
            'date'=> $createdAt->format('Y-m-d'),
            'payment_type'=> $this->payment_type,
            'amount'=> $this->amount,
            'customer_name'=> $this->customer->name,
            'freight_invoice_number'=> $this->shipment->freight_invoice_number
           
          ];
    }
}
