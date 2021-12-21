<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleService {

    function __construct()
    {

    }

    public function index ($params) {
        try {
            $q = Role::orderBy('id', 'desc');
            !empty($params['search']) ? $model = $q->where('name', 'like','%'.$params['search'] .'%') : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function indexAll () {
        try {
            $model = Role::All();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function indexPermission () {
        try {
            $model = Permission::All()->pluck("name")->toArray();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $model = Role::create([
                'name' => $data['name'],
            ]);
            $model->syncPermissions($data["permissions"]);
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $role) {
        try {
            DB::beginTransaction();
            $role->update(
                [
                    'name' => $data['name'],
                ]
            );
            $role->syncPermissions($data["permissions"]);
            DB::commit();
            return  $role;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function delete ($role) {
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}