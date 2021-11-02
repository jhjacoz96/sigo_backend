<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use App\Services\UserService;
use App\Http\Requests\OrganizationStoreRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Utils\Enums\EnumResponse;

class OrganizationController extends Controller
{
    function __construct(OrganizationService $_OrganizationService)
    {
        $this->service = $_OrganizationService;
    }

    public function index()
    {
        try {
            $model = $this->service->index();
            $data = OrganizationResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store(OrganizationStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $organization = $this->service->store($data);
            $data = new OrganizationResource($organization);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
          }
    }

    public function update(OrganizationUpdateRequest $request, Organization $organization)
    {
        try {                             
            $data = $request->validated();    
            if(!$organization){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {              
                $data = new OrganizationResource($organization);          
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {                                   
            return $e;             
          }                        
    }

    public function show(Organization $organization)
    {
        try {
            $data = $request->validated();
            if(!$organization){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $data = new OrganizationResource($organization);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }


    public function destroy($id)
    {
        try {
            $organization = $this->service->find($id);
            if(!$organization){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $organization = $this->service->delete($id);
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