<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Order;

class OrderService {

    function __construct()
    {

    }

    public function find ($id) {
        try {
            $model = Order::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $code = "P000" . $this->indexCode();
            $model = Order::create([
                'type_payment' => $data['type_payment'],
                'client_id' => $data['client_id'],
                'total' => $data['total'],
                'code' => $code,
                'status' => 'verificar',
                'name_delivery' => $data['name_delivery'],
                'phone_delivery' => $data['phone_delivery'],
                'cost_delivery' => $data['cost_delivery'],
                'address_delivery' => $data['address_delivery'],
                'comment_delivery' => $data['comment_delivery'] ?? null,
            ]);
            $model->syncProducts($data['products']);
            DB::commit();
            $model->refresh();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $order) {
        try {
            DB::beginTransaction();
            $order->update([
                'type_payment' => $data['type_payment'],
                'total' => $data['total'],
                'status' => $data['status'],
                'name_delivery' => $data['name_delivery'],
                'phone_delivery' => $data['phone_delivery'],
                'cost_delivery' => $data['cost_delivery'],
                'address_delivery' => $data['address_delivery'],
                'comment_delivery' => $data['comment_delivery'] ?? null,
            ]);
            $validate = $data['products'] ?? null;
            if (!is_null($validate))
                $order->syncProducts($data['products']);
            $order->refresh();
            DB::commit();
            return  $order;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function updateStatus ($data, $order) {
        try {
            DB::beginTransaction();
            $order->update([
                'status' => $data['status']
            ]);
            DB::commit();
            return  true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function indexClient ($params) {
        try {
            $client = \Auth::user()->client;
            $model = Order::where('client_id', $client->id)->orderBy('id', 'desc')->paginate($params['sizePage']);
            return  $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function index ($params) {
        try {
            $model = Order::where('status', $params['status'])->orderBy('id', 'desc')->paginate($params['sizePage']);
            return  $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function indexCode () {
        try {
            $data = Order::all();
            if ($data->count() > 0)
                return $data->last()->id + 1;
            else
                return 1;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy ($order) {
        try {
            DB::beginTransaction();
            $order->delete();
            $order->refresh();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}