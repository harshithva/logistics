<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Undelivered extends JsonResource
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
            "id" => $this->id, 
            "docket_no" => $this->docket_no,
            "sender_id" => $this->sender_id,
            "delivery_date" => $this->delivery_date,
        ];
    }
}
