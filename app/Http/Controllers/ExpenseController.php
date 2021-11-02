<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpensePaginationResource;
use App\Services\ExpenseService;
use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Utils\Enums\EnumResponse;

class ExpenseController extends Controller
{
    function __construct(ExpenseService $_ExpenseService)
    {
        $this->service = $_ExpenseService;
    }

    public function index(Request $request)
    {
        try {
            $model = $this->service->index($request);
            $data = new ExpensePaginationResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function store (ExpenseStoreRequest $request) {
       try {
            $data = $request->validated();
            $model = $this->service->store($data);
            $data = new ExpenseResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.store');
        }
    }

    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        try {
            $data = $request->validated();
            $model = $this->service->update($data, $expense);
            $data = new ExpenseResource($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function show(Expense $expense)
    {
        try {
            $data = new ExpenseResource($expense);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
          } catch (\Exception $e) {
            return $e;
          }
    }

    public function indexClient () {
        try {
            $model = $this->service->indexClient();
            $data = ExpenseResource::collection($model);
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.index');
        }
    }

    public function destroy(Expense $Expense)
    {
        try {
            $model = $this->service->destroy($Expense);
            $data = [
                'message' => __('response.successfully_deleted')
            ];
            return bodyResponseRequest(EnumResponse::SUCCESS, $data);
        } catch (\Exception $e) {
            return bodyResponseRequest(EnumResponse::ERROR, $e, [], self::class . '.destroy');
        }
    }

}
