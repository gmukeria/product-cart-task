<?php

namespace App\Services;

use Illuminate\Support\Collection;

class CartService
{
    public function calculatePrice(Collection $cartItems, $productGroup, $groupItems): array
    {
        $total = 0;
        $productQuantities = [];

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;

            $productQuantities[$item->product_id] = [
                'quantity' => $item->quantity,
                'price'    => $item->product->price,
            ];
        }

        $discount = $this->checkForDiscount($productQuantities, $productGroup, $groupItems);

        return ['total' => $total, 'discount' => $discount, 'subtotal' => $total - $discount];
    }

    public function checkForDiscount(array $productQuantities, $productGroup, $groupItems): float
    {
        if (empty($productGroup)) {
            return 0;
        }

        foreach ($groupItems as $id) {
            if (!isset($productQuantities[$id])) {
                return 0;
            }
        }

        $maxSets = PHP_INT_MAX;
        $minPrice = PHP_INT_MAX;

        foreach ($groupItems as $id) {
            $qty = $productQuantities[$id]['quantity'];
            $price = $productQuantities[$id]['price'];

            $maxSets  = min($maxSets, $qty);
            $minPrice = min($minPrice, $price);
        }

        return ($minPrice * $productGroup->discount / 100) * $maxSets;
    }
}
