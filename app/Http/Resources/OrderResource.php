<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'type_payment' => $this->type_payment,
            'code' => $this->code,
            'client_id' => $this->client_id,
            'client' => new ClientResource($this->client),
            'total' => $this->total,
            'status' => $this->status,
            'name_delivery' => $this->name_delivery,
            'phone_delivery' => $this->phone_delivery,
            'cost_delivery' => $this->cost_delivery,
            'address_delivery' => $this->address_delivery,
            'comment_delivery' => $this->comment_delivery ?? null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => OrderProductResource::collection($this->products)
        ];
    }
}
