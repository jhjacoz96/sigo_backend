<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleClient;
use App\Models\Client;
use App\Http\Resources\SaleClientResource;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SaleClientPaginateResource;
use App\Http\Resources\SalePaginateResource;
use App\Services\SaleClientService;
use App\Http\Requests\SaleClientStoreRequest;
use App\Utils\Enums\EnumResponse;

class SaleClientController extends Controller
{

    function __construct(SaleClientService $_SaleClientService)
    {
        $this->service = $_SaleClientService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new SaleClientPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function getHistorialPay (Request $request, Client $client) {
        try {
            $model = $this->service->getHistorialPay($request, $client);
            $data = new SalePaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function store(SaleClientStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $model = $this->service->store($data);
            $data = new SaleResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }


    public function amouthAvailable(Request $request, Client $client)
    {
        try {
            $model = $this->service->amouthAvailable($request, $client);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $model);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
