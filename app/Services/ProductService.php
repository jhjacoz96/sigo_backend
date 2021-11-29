<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductService {

    function __construct()
    {

    }

    public function index () {
        try {
            $model = Product::where('status', 'A')->where('stock', '>', 0)->orderBy('id', 'desc')->get();
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function find ($id) {
        try {
            $model = Product::find($id);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store ($data) {
        try {
            DB::beginTransaction();
            $product = Product::create([
                'slug' => \Str::slug($data['name']),
                'code' => $data['code'],
                'name' => $data['name'],
                'price_sale' => $data['price_sale'],
                'price_purchase' => $data['price_purchase'],
                'stock' => $data['stock'],
                'status' => 'A',
                'comment' => $data['comment'],
                'category_id' => $data['category_id']
            ]);
            if ($data['image'] != 'null' && $data['image'] != "object") {
                $file = Cloudinary::upload($data['image']->getRealPath(),
                [
                    "folder" => "sigo/product",
                ]
                );
                $product->image()->create([
                    'url' => $file->getSecurePath(),
                    'public_id' => $file->getPublicId()
                ]);
            }
            DB::commit();
            return  $product;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function update ($data, $id) {
        try {
            DB::beginTransaction();
            $model = Product::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'slug' => \Str::slug($data['name']),
                    'code' => $data['code'],
                    'stock' => $data['stock'],
                    'name' => $data['name'],
                    'price_sale' => $data['price_sale'],
                    'price_purchase' => $data['price_purchase'],
                    'status' => $data['status'],
                    'comment' => $data['comment'],
                    'category_id' => $data['category_id']
                ]
            );
            if (gettype($data['image'] != 'null' && $data['image']) == 'object') {
                $file = Cloudinary::upload($data['image']->getRealPath(),
                    [
                        "folder" => "sigo/product",
                    ]
                );
                if (!empty($model->image)) {
                    Cloudinary::destroy($model->image->public_id);
                    $model->image->url = $file->getSecurePath();
                    $model->image->public_id = $file->getPublicId();
                    $model->push();
                } else {
                    $model->image()->create([
                        'url' => $file->getSecurePath(),
                        'public_id' => $file->getPublicId()
                    ]);
                    $model->refresh();
                }
            };
            DB::commit();
            return  $model;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function decrement ($data, $id) {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->decrementQuantity($data['quantity']);
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
            $model = Product::find($id);
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
            $model = Product::find($id);
            if (!empty($model->image)) {
                Cloudinary::destroy($model->image->public_id);
                $model->image()->delete();
            }
            $model->delete();  
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    // MODULE STORE

    public function search ($data) {
        try {
            $q = Product::where('status', 'A')->where('stock', '>', 0);
             !empty($data['category']) ? $model = $q ->whereHas('category', function ($query) use($data) {
                                                        $query->where('slug', $data['category']);
                                                    }) : '';
               !empty($data['search'])   ? $model = $q->where(function($query) use($data) {
                                                        $query->where('name', 'like','%'.$data['search'] .'%')
                                                         ->orWhere('slug', 'like','%'.$data['search'] .'%')
                                                         ->orWhere('code', 'like','%'.$data['search'] .'%');
                                                   }) : '';
                $model = $q->orderBy('id', 'desc')->paginate($data['sizePage']);
            return $model;
        } catch (\Exception $e) {
            return $e;
        }
    }


}