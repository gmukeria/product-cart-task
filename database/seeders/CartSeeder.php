<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Buyer;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $productIds = Product::pluck('id')->toArray();
        $buyerIds   = Buyer::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            Cart::create([
                'product_id' => $faker->randomElement($productIds),
                'buyer_id'   => $faker->randomElement($buyerIds),
                'quantity'   => $faker->numberBetween(1, 5),
            ]);
        }
    }
}
