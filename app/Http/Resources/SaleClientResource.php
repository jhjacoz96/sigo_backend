<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class SaleClientResource extends JsonResource
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
        $current_total_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('total');
        $last_total_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $last_month)->whereYear('created_at', $last_year)->sum('total');
        $current_quantity_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $last_quantity_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $last_month)->whereYear('created_at', $last_year)->count();

        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "document"=> $this->document,
            "type_document"=> $this->type_document,
            "current_total_sale" => $current_total_sale,
            "last_total_sale" => $last_total_sale,
            "current_quantity_sale" => $current_quantity_sale,
            "last_quantity_sale" => $last_quantity_sale,
            "current_commission_sale" => round(floatval($current_quantity_sale * 500.00), 2),
            "last_commission_sale" => round(floatval($last_quantity_sale * 500.00), 2),
        ];
    }
}
