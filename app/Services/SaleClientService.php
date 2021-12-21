<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\SaleClient;
use App\Models\Client;

class SaleClientService {

    function __construct()
    {
        $this->months = collect(['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre']);
    }

    public function index ($params) {
        try {
            $q = Client::where('status', 'A')->orderBy('id', 'desc');
            !empty($params['search']) ? $model = $q->where('name', 'like','%'.$params['search'] .'%')
                                                 ->orWhere('email', 'like','%'.$params['search'] .'%')
                                                 ->orWhere('document', 'like','%'.$params['search'] .'%') : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getHistorialPay ($params, $client) {
        try {
             $pay = $client->saleClients()->orderBy('year', 'desc')->paginate($params['sizePage']);
            return $pay;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function amouthAvailable ($data, $client) {
        try {
            $nowYear = isset($data['year']) ? strval($data['year']) : Carbon::now()->format('Y');
            $monthsAvailable = $this->months->filter(function ($month) use($nowYear, $client) {
                $e = $client->saleClients()->where('year', $nowYear)->where('month', $month)->first();
                return empty($e);
            })->map(function ($month) use($nowYear, $client) {
                $nowMouth = strval(array_search($month, $this->months->toArray()) + 1);
                $orders = $client->orders()->where('status', 'enviado')->whereMonth('created_at',  $nowMouth)->whereYear('created_at', $nowYear);
                $sale_amount = $orders->sum('total');
                $sale_quantity = $orders->count();
                $sale_commission = $sale_quantity * 500.00;
                return [
                    'month' => $month,
                    'sale_amount' => $sale_amount,
                    'sale_quantity' =>  $sale_quantity,
                    'sale_commission' => $sale_commission
                ];
            });
            $data = [];
            foreach ($monthsAvailable as $key => $month) {
                array_push($data, $month);
            }
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $client = Client::find($data['client_id']);
            $nowYear = Carbon::now()->format('Y');
            $year = isset($data['year']) ? $data['year'] : $nowYear;
            $nowMouth = array_search($data['month'], $this->months->toArray()) + 1;
            $quantity_sale = $client->orders()->where('status', 'enviado')->whereMonth('created_at', $nowMouth)->whereYear('created_at', $year)->count();
            $model = SaleClient::create([
                'month' => $data['month'],
                'quantity' => $quantity_sale,
                'year' => $year,
                'amount' => $quantity_sale * 500.00,
                'client_id' => $data['client_id'],
            ]);
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}