<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class VendorPayment extends JsonResource
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
            'name' => $this->vendor->name,
            'payment_method' => $this->type,
            'amount' => $this->amount,
            'date' => Carbon::parse( $this->created_at)->format('d-m-Y '),
        ];
    }
}
