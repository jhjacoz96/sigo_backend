<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use App\Services\UserService;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Utils\Enums\EnumResponse;

class EmployeeController extends Controller
{
    function __construct(EmployeeService $_EmployeeService, UserService $_UserService)
    {
        $this->service = $_EmployeeService;
        $this->serviceUser = $_UserService;
    }

    public function index()
    {
        try {
            $model = $this->service->index();
            $data = EmployeeResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $this->serviceUser->store($data);
            $model = $this->service->store($data, $user);
            $data = new EmployeeResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
          }
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $employee = $this->service->find($id);
            if(!$employee){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $user = $this->serviceUser->update($data, $employee['user_id']);
                $model = $this->service->update($data, $employee['id']);
                $data = new EmployeeResource($model);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Employee $employee)
    {
        try {
            $data = new EmployeeResource($employee);
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.show');
        }
    }


    public function destroy($id)
    {
        try {
            $employee = $this->service->find($id);
            if(!$employee){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $employee = $this->service->delete($employee);
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
