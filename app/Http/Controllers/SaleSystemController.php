<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleSystemService;
use App\Utils\Enums\EnumResponse;

class SaleSystemController extends Controller
{

    function __construct(SaleSystemService $_SaleSystemService)
    {
        $this->service = $_SaleSystemService;
    }

    public function dashboard (Request $request)
    {
        try {
            $data = $this->service->dashboard($request);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

}
