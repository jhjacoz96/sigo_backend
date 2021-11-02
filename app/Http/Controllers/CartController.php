<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;
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

    public function indexClient()
    {
       try {
            $model = $this->service->indexClient();
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
            $model = $this->service->findProduct($data, $client);
            if (empty($model)) {
                $this->service->store($data, $client);
                $customMessage = __('response.cart.create_success');
            } else {
                $this->service->update($data, $client);
                $customMessage = __('response.cart.update_success');
            }
            return bodyResponseRequest(EnumResponse::SUCCESS_OK, null, $customMessage);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update(CartUpdateRequest $request, Cart $cart)
    {
        try {
            $data = $request->validated();
            $client =  $this->serviceClient->find($data['client_id']);
            $this->service->update($data, $client);
            return bodyResponseRequest(EnumResponse::ACCEPTED_OK, null);
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