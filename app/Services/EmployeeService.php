<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\User;

class EmployeeService {

    function __construct()
    {

    }

    public function index () {
        try {
            $model = Employee::All();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function find ($id) {
        try {
            $model = Employee::has('user')->find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data, $user) {
        try {
            DB::beginTransaction();
            $model = Employee::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'document' => $data['document'],
                'comment' => $data['comment'] ?? null,
                'user_id' =>  $user['id'],
                'type_document_id' => $data['type_document_id'],
                'status' => 'A'
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
            $model = Employee::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'document' => $data['document'],
                'comment' => $data['comment'] ?? null,
                'user_id' =>  $data['user_id'],
                'type_document_id' => $data['type_document_id'],
                'status' => 'A'
            ]);
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function show ($id) {
        try {
            DB::beginTransaction();
            $model = Employee::find($id);
            if(!$model) return null;
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function delete ($employee) {
        try {
            DB::beginTransaction();
            $employee->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}