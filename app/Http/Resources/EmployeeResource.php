<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            "document"=> $this->document,
            "comment"=> $this->comment,
            "user_id" => $this->user_id,
            "type_document_id"=> $this->type_document_id,
            "type_document"=> $this->type_document,
            "status"=> $this->status
        ];
    }
}
