<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\SetProductInCartRequest;
use App\Http\Resources\CartProductResource;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Models\Cart;

class SetCartProductQuantityController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function __invoke(SetProductInCartRequest $request): Response|CartProductResource|ResponseFactory
    {
        $availableQuantity = $this->productService->calculateAvailableForSale($request->product_id, $request->quantity);

        if ($availableQuantity <= 0) {
            return response(['message' => 'Not Enough Quantity'], 422);
        }

        $cartItem = Cart::updateOrCreate(
            ['buyer_id' => $request->buyer_id, 'product_id' => $request->product_id],
            ['quantity' => $availableQuantity]
        );

        $this->productService->updateQuantity($request->product_id, $availableQuantity);

        return CartProductResource::make($cartItem);
    }
}
