<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderPaginateResource;
use App\Services\ProviderService;
use App\Services\UserService;
use App\Http\Requests\ProviderStoreRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Utils\Enums\EnumResponse;

class ProviderController extends Controller
{
    function __construct(ProviderService $_ProviderService)
    {
        $this->service = $_ProviderService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new ProviderPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function indexAll()
    {
        try {
            $model = $this->service->indexAll();
            $data = ProviderResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store(ProviderStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $provider = $this->service->store($data);
            $data = new ProviderResource($provider);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
          }
    }

    public function update(ProviderUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $provider = $this->service->find($id);
            if(!$provider){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $model = $this->service->update($data, $provider['id']);
                $data = new ProviderResource($model);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Provider $provider)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $provider = $this->service->find($id);
            if(!$provider){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $provider = $this->service->delete($id);
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