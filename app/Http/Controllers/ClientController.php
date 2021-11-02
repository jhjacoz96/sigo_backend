<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use App\Services\UserService;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Utils\Enums\EnumResponse;

class ClientController extends Controller
{
    function __construct(ClientService $_ClientService, UserService $_UserService)
    {
        $this->service = $_ClientService;
        $this->serviceUser = $_UserService;
    }

    public function index()
    {
        try {
            $model = $this->service->index();
            $data = ClientResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store(ClientStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $this->serviceUser->store($data);
            $model = $this->service->store($data, $user);
            $data = new ClientResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
          }
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $Client = $this->service->find($id);
            if(!$Client){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $user = $this->serviceUser->update($data, $Client['user_id']);
                $model = $this->service->update($data, $Client['id']);
                $data = new ClientResource($model);
                return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
            }
          } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.update');
          }
    }

    public function show(Client $client)
    {
        try {
            $data = new ClientResource($client);
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.show');
        }
    }


    public function destroy($id)
    {
        try {
            $Client = $this->service->find($id);
            if(!$Client){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest( EnumResponse::NOT_FOUND, $data);  
            } else {
                $Client = $this->service->delete($id);
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
