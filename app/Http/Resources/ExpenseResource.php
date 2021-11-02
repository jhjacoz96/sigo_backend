<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'id'=> $this->id,
            'total' => $this->total,
            'type_payment' => $this->type_payment,
            'provider_id' => $this->provider_id,
            'provider' => $this->provider,
            'products' => ExpenseProductResource::collection($this->products)
        ];
    }
}
