<?php

namespace App\Http\Controllers\Cart;

use App\Http\Requests\AddProductInCartRequest;
use App\Http\Resources\CartProductResource;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Models\Cart;

class AddProductInCartController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }


    public function __invoke(AddProductInCartRequest $request): JsonResponse
    {
        $cartProduct = Cart::firstOrCreate(
            ['buyer_id'   => $request->buyer_id, 'product_id' => $request->product_id,],
            ['quantity' => 1]
        );

        if (! $cartProduct->wasRecentlyCreated) {
            return response()->json([
                'message' => 'Product already added in cart',
            ], 422);
        }

        $this->productService->updateQuantity($request->product_id, 1);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'item'    => CartProductResource::make($cartProduct),
        ]);
    }
}
