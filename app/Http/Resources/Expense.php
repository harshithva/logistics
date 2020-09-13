<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class Expense extends JsonResource
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
           "amount" => $this->amount,
           "category_name" => $this->category->name,
           "category_id"=> $this->category_id,
           "date" => Carbon::parse( $this->date)->format('d-m-Y '),
           "id" => $this->id,
           "name" => $this->name,
           'note' => $this->note
        ];
    }
}
