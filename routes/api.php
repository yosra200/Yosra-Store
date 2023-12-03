
<?php

use App\Http\Controllers\Api\AccessTokenscontrorller;
use App\Http\Controllers\Api\DeliveryControrller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('prodcts',productsController::class);

Route::post('auth/access-tokens',[AccessTokenscontrorller::class,'store'])
->middleware('guest:sanctum');



Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::get('Deliveries/{delivery}',[DeliveryControrller::class,'show']);

Route::put('Deliveries/{delivery}',[DeliveryControrller::class,'update']);
     