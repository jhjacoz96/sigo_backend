<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductPaginateResource;
use App\Services\ProductService;
use App\Services\UserService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Utils\Enums\EnumResponse;

class ProductController extends Controller
{
    function __construct(ProductService $_ProductService)
    {
        $this->service = $_ProductService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new ProductPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }



    public function store(ProductStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $product = $this->service->store($data);
            $data = new ProductResource($product);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $product = $this->service->find($id);
            if(!$product){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $model = $this->service->update($data, $product['id']);
                $data = new ProductResource($model);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Product $product)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $product = $this->service->find($id);
            if(!$product){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $product = $this->service->delete($id);
                $data = [
                    'message' => __('response.successfully_deleted')
                ];
                return bodyResponseRequest(EnumResponse::SUCCESS, $data);
            }
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }


    // MODULE STORE

    public function search(Request $request)
    {
        try {
            $model = $this->service->search($request);
            $data = new ProductPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.search');
        }
    }

}