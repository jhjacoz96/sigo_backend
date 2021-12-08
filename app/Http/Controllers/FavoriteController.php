<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoritePaginateResource;
use App\Services\FavoriteService;
use App\Services\ClientService;
use App\Http\Requests\FavoriteAddRequest;
use App\Http\Requests\FavoriteUpdateRequest;
use App\Utils\Enums\EnumResponse;

class FavoriteController extends Controller
{
    function __construct(FavoriteService $_FavoriteService, ClientService $_ClientService)
    {
        $this->service = $_FavoriteService;
        $this->serviceClient = $_ClientService;
    }

    public function index(Request $request)
    {
       try {
            $model = $this->service->index($request);
            $data = new FavoritePaginateResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function add(FavoriteAddRequest $request)
    {
        try {
            $data = $request->validated();
            $model = $this->service->findProduct($data);
            if (empty($model)) {
                $this->service->store($data);
                $customMessage = __('response.favorite.create_success');
            } else {
                $this->service->destroy($data);
                $customMessage = __('response.favorite.removed');
            }
            return bodyResponseRequest(EnumResponse::SUCCESS_OK,$data = null, $customMessage);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update(FavoriteUpdateRequest $request, Favorite $favorite)
    {
        try {
            $data = $request->validated();
            $model = $this->service->update($data, $favorite);
            $data = new FavoriteResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy(Favorite $favorite)
    {
        try {
            $model = $this->service->destroy($favorite);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }

}