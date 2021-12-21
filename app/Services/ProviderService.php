<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Provider;
use App\Models\User;

class ProviderService {

    function __construct()
    {

    }

    public function index ($params) {
        try {
            $q = Provider::orderBy('id', 'desc');
            !empty($params['search']) ? $model = $q->where('name', 'like','%'.$params['search'] .'%')
                                                 ->orWhere('email', 'like','%'.$params['search'] .'%')
                                                 ->orWhere('document', 'like','%'.$params['search'] .'%') : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function indexAll () {
        try {
            $model = Provider::All();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function find ($id) {
        try {
            $model = Provider::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $model = Provider::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'document' => $data['document'],
                'comment' => $data['comment'] ?? null,
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
            $model = Provider::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'document' => $data['document'],
                'comment' => $data['comment'] ?? null,
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
            $model = Provider::find($id);
            if(!$model) return null;
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function delete ($id) {
        try {
            DB::beginTransaction();
            $model = Provider::find($id);
            $model->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}