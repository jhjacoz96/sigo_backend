<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientPaginateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $paginate = [
            "total" => $this->total(),
            "currentPage" => $this->currentPage(),
            "perPage" => $this->perPage(),
            "lastPage" => $this->lastPage(),
            "fromPage" => $this->firstItem(),
            "to" => $this->lastPage()
        ];
        return [
            "paginate" => $paginate,
             "data" => ClientResource::collection($this->items()),
        ];
    }
}
