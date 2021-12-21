<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\User;

class CategoryService {

    function __construct()
    {

    }

    public function index ($params) {
        try {
            $q = Category::orderBy('id', 'desc');
            !empty($params['search']) ? $model = $q->where('name', 'like','%'.$params['search'] .'%')
                                                 ->orWhere('slug', 'like','%'.$params['search'] .'%') : '';
            $model = $q->paginate($params['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function indexAll () {
        try {
            $model = Category::All();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function find ($id) {
        try {
            $model = Category::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $model = Category::create([
                'name' => $data['name'],
                'slug' => \Str::slug($data['name']),
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
            $model = Category::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'slug' => \Str::slug($data['name'])
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
            $model = Category::find($id);
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
            $model = Category::find($id);
            $model->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}