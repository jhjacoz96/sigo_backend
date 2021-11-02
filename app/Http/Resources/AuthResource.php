<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CLient;
use App\Models\Employee;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $modelAssociate = !empty($this->client) ? Client::class : Employee::class;
        return [
            'id' => $this->id,
            'email' => $this->email,
            'profile' =>  substr($modelAssociate, 11) === 'CLient' ? new ClientResource($this->client) : new EmployeeResource($this->employee),
            'modelAssociate' => substr($modelAssociate, 11)
        ];
    }
}
