<?php
namespace App\Http\Resources;

use App\Services\CartService;
use App\Services\ProductGroupService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllProductsInCartResource extends ResourceCollection
{
    protected $priceData;

    public function __construct($resource, $priceData)
    {
        parent::__construct($resource);
        $this->priceData = $priceData;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
//        $cartService = new CartService();
//        $productGroupService = new ProductGroupService();

//        $productGroup = $productGroupService->getProductGroup(1);
//        $groupItems = $productGroupService->getProductGroupItems(1);
//
//        $priceData = $cartService->calculatePrice($this->collection, $productGroup, $groupItems);

        return [
            'products' => CartProductResource::collection($this->collection),
            'total'    => $this->priceData['total'],
            'discount' => $this->priceData['discount'],
            'subtotal' => $this->priceData['subtotal']
        ];
    }
}
