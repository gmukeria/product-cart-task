<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGroupItem;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\ProductGroup;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();

        $productGroup = ProductGroup::create(['user_id' => $faker->randomElement($userIds), 'discount' => 10]);

        $data = [
            ['product_group_id' => $productGroup->id, 'product_id' => 2],
            ['product_group_id' => $productGroup->id, 'product_id' => 5]
        ];

        ProductGroupItem::insert($data);
    }
}
