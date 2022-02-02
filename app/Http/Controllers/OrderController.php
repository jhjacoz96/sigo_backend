<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderPaginationResource;
use App\Services\OrderService;
use App\Services\CartService;
use App\Services\ClientService;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\OrderUpdateStatusRequest;
use App\Utils\Enums\EnumResponse;

class OrderController extends Controller
{
    function __construct(OrderService $_OrderService, CartService $_CartService, ClientService $_ClientService)
    {
        $this->service = $_OrderService;
        $this->serviceCart = $_CartService;
        $this->serviceClient = $_ClientService;
    }

    public function indexCode()
    {
        try {
            $data = $this->service->indexCode();
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.indexCode');
        }
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new OrderPaginationResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store (OrderStoreRequest $request) {
       try {
            $data = $request->validated();
            $message = [
                'message' => 'Accíón no permitida',
            ];
            return bodyResponseRequest( EnumResponse::NOT_FOUND, $message);
            $model = $this->service->store($data);
            $client = $this->serviceClient->find($model->client_id);
            $this->serviceCart->destroyAll($client);
            $data = new OrderResource($model);
            $message =  __('response.order.create_success');
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data, $message);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        try {
            $data = $request->validated();
            $model = $this->service->update($data, $order);
            $data = new OrderResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Order $order)
    {
        try {
            $model = $order;
            $data = new OrderResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function updateStatus(OrderUpdateStatusRequest $request, Order $order)
    {
        try {
            $data = $request->validated();
            $model = $this->service->updateStatus($data, $order);
            return bodyResponseRequest(EnumResponse::SUCCESS_OK);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function indexClient (Request $request) {
        try {
            $model = $this->service->indexClient($request);
            $data = new OrderPaginationResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function destroy(Order $order)
    {
        try {
            $model = $this->service->destroy($order);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }

}
