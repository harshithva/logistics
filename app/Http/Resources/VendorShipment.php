<?php

namespace App\Http\Resources;
use Carbon\Carbon;
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
        $query = VendorPayment::where('vendor_id', $this->vendor_id)->where('shipment_id',$this->shipment_id);
        if($query->count() > 0)
        {
            $payment_date = Carbon::parse($query->orderBy('created_at','DESC')->first()->created_at)->format("d/m/Y h:i A");
        }else if($this->advance > 0){
            $payment_date = Carbon::parse($this->created_at)->format("d/m/Y h:i A");
        }else{
            $payment_date = "NO INFO";
        }
       
        return [
            'id' => $this->id,
            'total' => $this->total,
            'advance' => $this->advance,
            'commission' => $this->commission,
            'memo_no' => $this->memo_no,
            'shipment_id' => $this->shipment_id,
            'vendor_id' => $this->vendor_id,
            'balance' => (int)$this->total - ((int)$this->advance + (int)VendorPayment::where('vendor_id', $this->vendor_id)->where('shipment_id',$this->shipment_id)->sum('amount')),
            'docket_no' => $this->shipment->docket_no,
            'cash' => $this->cash,
            'from' => $this->shipment->package_pickup_address,
            'delivery_address' => $this->shipment->delivery_address,
            'sender_id' => $this->shipment->sender_id,
            'payment_date' =>       $payment_date
            // 'shipment' => $this->shipment
        ];
    }
}
