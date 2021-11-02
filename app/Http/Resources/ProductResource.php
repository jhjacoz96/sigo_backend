<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Client;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $favorites = Client::whereHas('favorite', function ($q){
            $q->where('product_id', $this->id);
        })->pluck('id');
        return [
            "id"=> $this->id,
            "image" => '',
            'slug' => $this->slug,
            'code' => $this->code,
            'status' => $this->status,
            'name' => $this->name,
            'price_sale' => $this->price_sale,
            'price_purchase' => $this->price_purchase,
            'stock' => $this->stock,
            'comment' => $this->comment,
            'category_id' => $this->category_id,
            'category' => $this->category,
            'favorites' => $favorites
        ];
    }
}
