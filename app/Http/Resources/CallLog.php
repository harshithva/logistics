<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CallLog extends JsonResource
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
            'name' => $this->customer->name,
            'company_name' => $this->customer->company_name,
            'duration' => $this->duration,
            'feedback' => $this->feedback,
            'date' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
