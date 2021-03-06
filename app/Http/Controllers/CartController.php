<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartPaginateResource;
use App\Services\CartService;
use App\Services\ClientService;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartAddMasiveRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Utils\Enums\EnumResponse;

class CartController extends Controller
{
    function __construct(CartService $_CartService, ClientService $_ClientService)
    {
        $this->service = $_CartService;
        $this->serviceClient = $_ClientService;
    }

    public function indexClient(Request $request)
    {
       try {
            $model = $this->service->indexClient($request);
            $data = new CartPaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }
    public function indexClientAll ()
    {
       try {
            $model = $this->service->indexClientAll();
            $data = CartResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function add(CartAddRequest $request)
    {
        try {
            $data = $request->validated();
            $client =  $this->serviceClient->find($data['client_id']);
            $product = $this->service->findProduct($data, $client);
            if (empty($product)) {
                $model = $this->service->store($data, $client);
                $customMessage = __('response.cart.create_success');
            } else {
                $model = $this->service->update($data, $client);
                $customMessage = __('response.cart.update_success');
            }
            $data = new CartResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data, $customMessage);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update(CartUpdateRequest $request, Cart $cart)
    {
        try {
            $data = $request->validated();
            $client =  $this->serviceClient->find($data['client_id']);
            $model = $this->service->update($data, $client);
            $customMessage = __('response.cart.update_success');
            return $model;
            $data = new CartResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data, $customMessage);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy(Cart $cart)
    {
        try {
            $cart = $this->service->destroy($cart);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }

    public function destroyAll(Client $client)
    {
        try {
            $cart = $this->service->destroyAll($client);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroyAll');
        }
    }

}