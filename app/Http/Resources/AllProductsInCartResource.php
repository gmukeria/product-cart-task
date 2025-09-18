<?php
namespace App\Http\Resources;

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
        return [
            'items'    => CartProductResource::collection($this->collection),
            'total'    => $this->priceData['total'],
            'discount' => $this->priceData['discount'],
            'subtotal' => $this->priceData['subtotal']
        ];
    }
}
