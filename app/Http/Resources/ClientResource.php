<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            "name"=> $this->name,
            "phone"=> $this->phone,
            "email"=> $this->email,
            "user_id"=> $this->user_id,
            "document"=> $this->document,
            "comment"=> $this->comment,
            "type_document_id"=> $this->type_document_id,
            "type_document"=> $this->type_document,
            "status"=> $this->status
        ];
    }
}
