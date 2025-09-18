
<?php

use App\Http\Controllers\Cart\AddProductInCartController;
use App\Http\Controllers\Cart\GetCartProductsController;
use App\Http\Controllers\Cart\RemoveProductFromCartController;
use App\Http\Controllers\Cart\SetCartProductQuantityController;
use App\Http\Controllers\Product\GetProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::get('/products',    GetProductsController::class);

    Route::get('/cart-products',    GetCartProductsController::class);
    Route::post('/cart-products',   AddProductInCartController::class);
    Route::put('/cart-products',    SetCartProductQuantityController::class);
    Route::delete('/cart-products', RemoveProductFromCartController::class);
});

