<?php

namespace App\Http\Controllers\Cart;

use App\Http\Requests\RemoveProductFromCartRequest;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Models\Cart;

class RemoveProductFromCartController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function __invoke(RemoveProductFromCartRequest $request): Response
    {
        $cartProduct = Cart::where('buyer_id', $request->buyer_id)
            ->where('product_id', $request->product_id)
            ->first();

        if (empty($cartProduct)) {
            return response(['message' => 'Product not found'], 404);
        }

        $this->productService->updateQuantity($request->product_id, $cartProduct->quantity, 'increase');

        $cartProduct->delete();
        return response()->noContent();
    }
}
