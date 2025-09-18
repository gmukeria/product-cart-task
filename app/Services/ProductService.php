<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function calculateAvailableForSale(int $id, int $requestedQuantity)
    {
        $product = Product::findOrFail($id);
        return min($requestedQuantity, $product->quantity);
    }

    public function updateQuantity(int $id, int $quantity, string $type = 'decrease'): void
    {
        $query = Product::whereKey($id);

        if ($type === 'decrease') {
            $query->decrement('quantity', $quantity);
        }

        if ($type === 'increase') {
            $query->increment('quantity', $quantity);
        }
    }
}
