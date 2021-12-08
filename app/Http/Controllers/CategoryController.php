<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryPaginateResource;
use App\Services\CategoryService;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Utils\Enums\EnumResponse;

class CategoryController extends Controller
{
    function __construct(CategoryService $_CategoryService)
    {
        $this->service = $_CategoryService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new CategoryPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function indexAll()
    {
        try {
            $model = $this->service->indexAll();
            $data = CategoryResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->service->store($data);
            $data = new CategoryResource($category);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
          }
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $category = $this->service->find($id);
            if(!$category){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $model = $this->service->update($data, $category['id']);
                $data = new CategoryResource($model);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Category $category)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $category = $this->service->find($id);
            if(!$category){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $category = $this->service->delete($id);
                $data = [
                    'message' => __('response.successfully_deleted')
                ];
                return bodyResponseRequest(EnumResponse::SUCCESS, $data);
            }
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }
}