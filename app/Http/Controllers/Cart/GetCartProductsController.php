<?php

namespace App\Http\Controllers\Cart;

use App\Http\Resources\AllProductsInCartResource;
use App\Services\ProductGroupService;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;

class GetCartProductsController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected ProductGroupService $productGroupService
    ) {
    }

    public function __invoke(Request $request): AllProductsInCartResource
    {
        $buyerId = $request->buyer_id;
        $cartProducts = Cart::with('product')->where('buyer_id', $buyerId)->get();

        $productGroup = $this->productGroupService->getProductGroup(1);
        $groupItems = $this->productGroupService->getProductGroupItems(1);
        $priceData = $this->cartService->calculatePrice($cartProducts, $productGroup, $groupItems);

        return new AllProductsInCartResource($cartProducts, $priceData);
    }
}
