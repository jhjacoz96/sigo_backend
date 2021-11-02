<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\User;

class UserService {

    function __construct()
    {

    }

    public function find ($id) {
        try {
            $model = User::find($id);
            return  $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $model = User::create(
                [
                    'email' => $data['email'],
                    'password' => bcrypt($data['password'])
                ]);
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $id) {
        try {
            DB::beginTransaction();
            $model = User::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'email' => $data['email'],
                ]
            );
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function updatePassword ($data, $id) {
        try {
            DB::beginTransaction();
            $model = User::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'password' => bcrypt($data['password']),
                ]
            );
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}