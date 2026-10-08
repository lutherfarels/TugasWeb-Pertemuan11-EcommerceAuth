<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::factory()
            ->count(50)
            ->create();

        $tags = Tag::all();

        foreach ($products as $product) {
            $randomTags = $tags
                ->random(rand(1, 3))
                ->pluck('id')
                ->toArray();

            $product->tags()->attach($randomTags);
        }
    }
}