<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $userIds   = User::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            Product::create([
                'title'   => $faker->word,
                'price'   => $faker->randomFloat(2, 10, 500),
                'user_id' => $faker->randomElement($userIds),
                'quantity'   => $faker->numberBetween(1, 5)
            ]);
        }
    }
}
