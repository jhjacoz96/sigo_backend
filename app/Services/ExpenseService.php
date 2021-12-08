<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Expense;

class ExpenseService {

    function __construct()
    {

    }

    public function find ($id) {
        try {
            $model = Expense::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $model = Expense::create([
                'type_payment' => $data['type_payment'],
                'provider_id' => $data['provider_id'],
                'total' => $data['total']
            ]);
            $model->syncProducts($data['products']);
            $model->refresh();
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $expense) {
        try {
            DB::beginTransaction();
            $expense->update([
                'type_payment' => $data['type_payment'],
                'total' => $data['total']
            ]);
            $expense->syncProducts($data['products']);
            $expense->refresh();
            DB::commit();
            return  $expense;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function indexClient ($params) {
        try {
            $client = \Auth::user()->client;
            $model = Expense::where('client_id', $client->id)->orderBy('id', 'desc')->paginate($params['sizePage']);
            return  $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function index ($params) {
        try {
            $model = Expense::orderBy('id', 'desc')->paginate($params['sizePage']);
            return  $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy ($expense) {
        try {
            DB::beginTransaction();
            $expense->delete();
            $expense->refresh();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}