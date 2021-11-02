<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseProductResource extends JsonResource
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
            "id"=> $this->pivot->id,
            "product_id"=> $this->id,
            'slug' => $this->slug,
            'code' => $this->code,
            'name' => $this->name,
            'price_sale' => $this->price_sale,
            'price_purchase' => $this->pivot->price,
            'quantity' => $this->pivot->quantity,
            'comment' => $this->comment,
            'category_id' => $this->category_id,
            'category' => $this->category
        ];
    }
}
