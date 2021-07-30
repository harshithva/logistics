<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Quote extends JsonResource
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
            'quotation_no'=> $this->quotation_no,
            'customer_name'=> $this->customer->name,
            'from' => count($this->list) ? $this->list[0]->from: "NO INFO",
            'to' => count($this->list) ? $this->list[0]->to: "NO INFO",
            'status' => $this->status,
            'customer_id' => $this->customer->id
          ];
    }
}