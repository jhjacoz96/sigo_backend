<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;

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
            // send email
            $users = User::role('Administrador')->get();
            $client = $model->client;
            $users->each(function (User $user) use($model, $client) {
                $data = [
                    "employee" => $user->employee,
                    "order" =>  $model,
                    "client" => $client,
                ];
                Mail::send('email.newOrder', $data,function($message) use($user){
                    $message->to($user["email"])->subject('Nueva orden - Sigo');
                });
            });
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
           $q = Order::where('client_id', $client->id)->orderBy('id', 'desc');
           !empty($params['search']) ? $model = $q->where('code', 'like','%'.$params['search'] .'%') : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function index ($params) {
        try {
            $q = Order::orderBy('id', 'desc');
            !empty($params['status']) ? $model = $q->where('status', $params['status']) : '';
            !empty($params['search']) ? $model = $q->where('code', 'like','%'.$params['search'] .'%')
                                                 ->orWhereHas('client', function($query) use($params) {
                                                    $query->where('name', 'like','%'.$params['search'] .'%')
                                                    ->orWhere('document', 'like','%'.$params['search'] .'%');
                                                 }) : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
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
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}