<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::put('update-password/{id}', [AuthController::class, 'updatePassword']);
    });
});

Route::group([
    'middleware' => 'auth:api'
  ], function() {
    
    Route::prefix('admin')->group(function () {
        Route::prefix('organization')->group(function () {
            Route::post('', [Controller::class, 'updateOrganization']);
            Route::get('', [Controller::class, 'showOrganization']);
        });
        Route::ApiResource('employee', EmployeeController::class);
        Route::prefix('role')->group(function() {
             Route::get('', [RoleController::class, 'index']);
             Route::post('', [RoleController::class, 'store']);
             Route::put('{role}', [RoleController::class, 'update']);
             Route::delete('{role}', [RoleController::class, 'delete']);
             Route::get('permission', [RoleController::class, 'indexPermission']);
        });
        Route::ApiResource('client', ClientController::class);
        Route::ApiResource('provider', ProviderController::class);
        Route::ApiResource('category', CategoryController::class);
        Route::ApiResource('product', ProductController::class);
        Route::prefix('cart')->group(function () {
            Route::post('add', [CartController::class, 'add']);
            Route::put('{cart}', [CartController::class, 'update']);
            Route::delete('{cart}', [CartController::class, 'destroy']);
        });
        Route::prefix('favorite')->group(function () {
            Route::get('', [FavoriteController::class, 'index']);
            Route::post('add', [FavoriteController::class, 'add']);
            Route::delete('{favorite}', [FavoriteController::class, 'destroy']);
        });
        Route::prefix('order')->group(function () {
            Route::post('', [OrderController::class, 'store']);
            Route::get('', [OrderController::class, 'index']);
            Route::get('index-code', [OrderController::class, 'indexCode']);
            Route::get('{order}', [OrderController::class, 'show']);
            Route::put('{order}', [OrderController::class, 'update']);
            Route::put('{order}/status', [OrderController::class, 'updateStatus']);
            Route::delete('{order}', [OrderController::class, 'destroy']);
        });
        Route::prefix('expense')->group(function () {
            Route::post('', [ExpenseController::class, 'store']);
            Route::get('', [ExpenseController::class, 'index']);
            Route::get('{expense}', [ExpenseController::class, 'show']);
            Route::put('{expense}', [ExpenseController::class, 'update']);
            Route::delete('{expense}', [ExpenseController::class, 'destroy']);
        });
    });
    Route::prefix('store')->group(function () {
        Route::ApiResource('category', CategoryController::class);
        Route::ApiResource('organization', OrganizationController::class);
        Route::prefix('order')->group(function () {
            Route::post('', [OrderController::class, 'store']);
            Route::get('', [OrderController::class, 'indexClient']);
        });
        Route::prefix('product')->group(function () {
            Route::get('', [ProductController::class, 'search']);
        });
        Route::prefix('cart')->group(function () {
            Route::get('', [CartController::class, 'indexClient']);
            Route::post('', [CartController::class, 'add']);
            Route::post('masive', [CartController::class, 'addMasive']);
            Route::put('{cart}', [CartController::class, 'update']);
            Route::delete('{cart}', [CartController::class, 'destroy']);
        });
        Route::prefix('favorite')->group(function () {
            Route::get('', [FavoriteController::class, 'index']);
            Route::post('', [FavoriteController::class, 'add']);
            Route::delete('{favorite}', [FavoriteController::class, 'destroy']);
        });
    });
});
