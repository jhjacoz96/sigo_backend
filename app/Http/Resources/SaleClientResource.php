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
    public function toArray($request) {
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
        $current_quantity_sale = 0;
        $current_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $month)->whereYear('created_at', $year);
        foreach ($current_sale->get() as $key => $value) {
            $current_quantity_sale += $value->products->sum('pivot.quantity');
        }
        $current_total_sale = $current_sale->sum('total');
        $last_quantity_sale = 0;
        $last_sale = $this->orders()->where('status', 'enviado')->whereMonth('created_at', $last_month)->whereYear('created_at', $last_year);
        foreach ($last_sale->get() as $key => $value) {
            $last_quantity_sale += $value->products->sum('pivot.quantity');
        }
        $last_total_sale = $last_sale->sum('total');

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
