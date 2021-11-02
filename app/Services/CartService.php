<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;

class CartService {

    function __construct()
    {

    }

    public function indexClient () {
        try {
            $client = User::getModelAuth();
            $model = $client->cart;
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function find ($id) {
        try {
            $model = Cart::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findProduct ($data, $client) {
        try {
            $model = $client->cart()->where('product_id', $data['product_id'])->first();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }
 
    /* public function add ($data) {
        try {
            DB::beginTransaction();
            if (!empty($model)) {
                $model = $this->update($data, $model);
            } else {
                $model = $this->store($data, $client);
            }
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
*/
    public function store ($data, $client) {
        try {
            DB::beginTransaction();
            $client->cartProducts()->attach($data['product_id'], [ 'quantity' => $data['quantity']]);
            DB::commit();
            return  true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function increment ($data) {
        try {
            DB::beginTransaction();
            $client = \Auth::user()->client;
            $client->cartProducts()->where('product_id', $data['product_id'])->increment('quantity', $data['quantity']);
            DB::commit();
            return  true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $client) {
        try {
            DB::beginTransaction();
            $client->cartProducts()->updateExistingPivot($data['product_id'], [
                'quantity' => $data['quantity']
            ]);
            DB::commit();
            return  true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function show ($id) {
        try {
            DB::beginTransaction();
            $model = Cart::find($id);
            if(!$model) return null;
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function destroy ($cart) {
        try {
            DB::beginTransaction();
            $cart->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

      public function destroyAll ($client) {
        try {
            DB::beginTransaction();
            $client->cartProducts()->detach();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }


}