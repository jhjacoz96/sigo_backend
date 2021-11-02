<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Product;

class FavoriteService {

    function __construct(User $_user)
    {
    }

    public function index () {
        try {
            $client = \Auth::user()->client;
            $model = $client->favorite;
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findProduct ($data) {
        try {
            $client = \Auth::user()->client;
            $model = $client->favorite()->where('product_id', $data['product_id'])->first();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add ($data) {
        try {
            DB::beginTransaction();
            $client = \Auth::user()->client;
            $model = $client->favorite()->where('product_id', $data['product_id'])->first();
            if (!empty($model)) {
                $this->destroy($data);
            } else {
                $this->store($data);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $client = \Auth::user()->client;
            $client->favoriteProducts()->attach($data['product_id']);
            DB::commit();
            return  true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function destroy ($data) {
        try {
            DB::beginTransaction();
            $client = \Auth::user()->client;
            $client->favoriteProducts()->detach($data['product_id']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}