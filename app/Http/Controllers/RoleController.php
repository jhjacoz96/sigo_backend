<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleHasPermissionsResource;
use App\Http\Resources\RolePaginateResource;
use App\Services\RoleService;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Utils\Enums\EnumResponse;

class RoleController extends Controller
{
    function __construct(RoleService $_RoleService)
    {
        $this->service = $_RoleService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new RolePaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function indexAll()
    {
        try {
            $model = $this->service->indexAll();
            $data = RoleHasPermissionsResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function indexPermission()
    {
        try {
            $data = $this->service->indexPermission();
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.indexPermission');
        }
    }

    public function store(RoleStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $model = $this->service->store($data);
            $data = new RoleHasPermissionsResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        try {
            $data = $request->validated();
            $model = $this->service->update($data, $role);
            $data = new RoleHasPermissionsResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function destroy(Role $role)
    {
        try {
            $data = $this->service->delete($role);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }
}
