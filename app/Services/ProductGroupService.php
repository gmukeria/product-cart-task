<?php

namespace App\Services;

use App\Models\ProductGroup;
use App\Models\ProductGroupItem;

class ProductGroupService
{
    public function getProductGroup(int $productGroupId)
    {
        return ProductGroup::find($productGroupId);
    }

    public function getProductGroupItems(int $productGroupId): array
    {
        return ProductGroupItem::where('product_group_id', $productGroupId)
            ->pluck('product_id')
            ->toArray();
    }
}
