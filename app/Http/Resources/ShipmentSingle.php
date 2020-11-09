<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentSingle extends JsonResource
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
             "bill_to" => $this->bill_to,
            "bill_to_id" => $this->bill_to_id,
            "charge_Insurance" => $this->charge_Insurance,
            "charge_advance_paid" => $this->charge_advance_paid,
            "charge_balance" => $this->charge_balance,
            "charge_halting" => $this->charge_halting,
            "charge_handling" => $this->charge_handling,
            "charge_odc" => $this->charge_odc,
            "charge_tax_amount" => $this->charge_tax_amount,
            "charge_tax_percent" => $this->charge_tax_percent,
            "charge_total" => $this->charge_total,
            "charge_transportation" => $this->charge_transportation,
            "created_at" => $this->created_at,
            "date" => $this->date,
            "delivery_address" => $this->delivery_address,
             "freight_invoice_number" => $this->freight_invoice_number,
            "insurance" => $this->insurance,
            "package" => $this->package,
            "package_contact_person" => $this->package_contact_person,
            "package_pickup_address" => $this->package_pickup_address,
            "package_transaction_type" => $this->package_transaction_type,
            "payment" => $this->payment,
            "payment_type" => $this->payment_type,
            "receiver" => $this->receiver,
            "receiver_id" => $this->receiver_id,
            "remarks" => $this->remarks,
            "sender" => $this->sender,
            "sender_id" => $this->sender_id,
            "transport_company_name" => $this->transport_company_name,
            "transport_company_phone" => $this->transport_company_phone,
            "transport_driver_name" => $this->transport_driver_name,
            "transport_driver_phone" => $this->transport_driver_phone,
            "transport_driver_vehicle" => $this->transport_driver_vehicle,
            "user_notes" => $this->user_notes,
            "vendor_details" => $this->vendor_details,
            'document'=>$this->document,
            'updated_at'=>$this->updated_at,
        
        ];
    }
}
