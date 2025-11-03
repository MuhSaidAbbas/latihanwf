<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Sneakers
            ['name' => 'Air Street Classic', 'price' => '1.200.000', 'category' => 'sneakers', 'image' => '/img/sneaker1.jpg'],
            ['name' => 'Urban Flex', 'price' => '1.100.000', 'category' => 'sneakers', 'image' => '/img/sneaker2.jpg'],

            // Basket
            ['name' => 'DunkForce Pro', 'price' => '1.800.000', 'category' => 'basket', 'image' => '/img/basket1.jpg'],
            ['name' => 'GripMaster Elite', 'price' => '1.950.000', 'category' => 'basket', 'image' => '/img/basket2.jpg'],

            // Running
            ['name' => 'SwiftRun 3.0', 'price' => '990.000', 'category' => 'running', 'image' => '/img/run1.jpg'],
            ['name' => 'Velocity Edge', 'price' => '1.050.000', 'category' => 'running', 'image' => '/img/run2.jpg'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
