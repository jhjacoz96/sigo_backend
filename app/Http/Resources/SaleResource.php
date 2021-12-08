<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            'month' => $this->month,
            'quantity' => $this->quantity,
            'year' => $this->year,
            'amount' => $this->amount,
            'client_id' => $this->client_id,
            'client' => $this->client,
            "created_at" => $this->created_at
        ];
    }
}
