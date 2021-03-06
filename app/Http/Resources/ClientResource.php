<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
        $year = intval(Carbon::now()->format('Y'));
        $last_year = $year;
        $month = intval(Carbon::now()->format('m'));
        if ($month == 01)  {
            $last_year = $year - 1;
            $last_month = 12;
        } else {
            $last_month = $month - 1;
        }
        $year = strval($year);
        $month = strval($month);
        $last_year = strval($last_year);
        $last_month = strval($last_month);
        $current_orders = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $month)->whereYear('created_at', $year);
        $current_sale_quantity = 0;
        foreach ($current_orders->get() as $key => $value) {
            $current_sale_quantity += $value->products->sum('pivot.quantity');
        }
        $last_orders = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $last_month)->whereYear('created_at', $last_year);
        $last_sale_quantity = 0;
        foreach ($last_orders->get() as $key => $value) {
            $last_sale_quantity += $value->products->sum('pivot.quantity');
        }
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "phone"=> $this->phone,
            "email"=> $this->email,
            "user_id"=> $this->user_id,
            "document"=> $this->document,
            "comment"=> $this->comment,
            "type_document_id"=> $this->type_document_id,
            "current_commission" => $current_sale_quantity * 500.00,
            "last_commission" => $last_sale_quantity * 500.00,
            "current_quantity_sale" => $current_sale_quantity,
            "last_quantity_sale" => $last_sale_quantity,
            "type_document"=> $this->type_document,
            "status"=> $this->status
        ];
    }
}
