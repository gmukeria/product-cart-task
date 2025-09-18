<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Product;

class GetProductsController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }
}
