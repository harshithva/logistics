<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helpers;

class CustomerInvoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $advance_paid = $this->shipment->sum('charge_advance_paid');
        $paid_invoice = $this->payments->sum('amount');
   
        return [
            'advance_paid' => $advance_paid,
            'paid_invoice' =>  $paid_invoice + $advance_paid,
            'outstanding_invoice' => $this->shipment->sum('charge_total') -  $paid_invoice - $advance_paid,
            'total_invoice' => $this->shipment->count(),
            'shipment'=> Helpers::getPaidInvoices($this->shipment, $this->type)
        ];
    }
}
