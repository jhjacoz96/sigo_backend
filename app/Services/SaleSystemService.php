<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\SaleSystem;
use App\Models\Client;
use App\Models\Order;

class SaleSystemService {

    function __construct()
    {
        $this->months = collect(['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre']);
    }

    public function dashboard ($params) {
        try {
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
            // $year = $params['mes'] === 'actual' ? $year : $last_year;
            // $month = $params['mes'] === 'actual' ? $month : $last_month;
            //datos a mostrar
            $current_orders = Order::where('status', 'enviado')->whereMonth('created_at',  $month)->whereYear('created_at', $year);
            $last_orders = Order::where('status', 'enviado')->whereMonth('created_at',  $last_month)->whereYear('created_at', $last_year);
            $current_count_sale = 0;
            foreach ($current_orders->get() as $key => $value) {
                $current_count_sale += $value->products->sum('pivot.quantity');
            }
            $current_amount_sale = $current_orders->sum('total');
            $current_commission_sale = $current_count_sale * 200.00;
            $last_count_sale = 0;
            foreach ($last_orders->get() as $key => $value) {
                $last_count_sale += $value->products->sum('pivot.quantity');
            }
            $last_amount_sale = $last_orders->sum('total');
            $last_commission_sale = $last_count_sale * 200.00;
            // data the chart
            $last_day = Carbon::now()->startOfMonth()->endOfMonth()->format('d');
            $labels = [];
            $data = [];
            for ($i=0; $i <= intval($last_day) - 1 ; $i++) {
                $day = $i + 1;
                $labels[$i] = $day;
                $orders = Order::where('status', 'enviado')->whereDay('created_at', $day)->whereMonth('created_at',  $month)->whereYear('created_at', $year)->get();
                $total = 0;
                foreach ($orders as $key => $value) {
                    $total += $value->products->sum('pivot.quantity');
                }
                $data[$i] = $total;
            }
            $chart_sale = [
                'labels' => $labels,
                'data' => $data,
            ];
            $data =  [
                'current_count_sale' => $current_count_sale,
                'current_amount_sale' => $current_amount_sale,
                'current_commission_sale' => $current_commission_sale,
                'last_count_sale' => $last_count_sale,
                'last_amount_sale' => $last_amount_sale,
                'last_commission_sale' => $last_commission_sale,
                'chart_sale' => $chart_sale
            ];
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

}