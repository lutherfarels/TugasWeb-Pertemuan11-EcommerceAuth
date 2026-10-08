<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $products = [
            [
                'name' => 'Laptop ASUS VivoBook',
                'description' => 'Laptop untuk kebutuhan kuliah dan pekerjaan sehari-hari.',
                'price' => 8500000,
            ],
            [
                'name' => 'Laptop Lenovo IdeaPad',
                'description' => 'Laptop ringan dengan performa yang cocok untuk mahasiswa.',
                'price' => 7200000,
            ],
            [
                'name' => 'Mouse Wireless Logitech',
                'description' => 'Mouse wireless nyaman digunakan untuk bekerja dan belajar.',
                'price' => 250000,
            ],
            [
                'name' => 'Keyboard Mechanical RGB',
                'description' => 'Keyboard mechanical dengan lampu RGB untuk gaming dan mengetik.',
                'price' => 650000,
            ],
            [
                'name' => 'Headset Gaming',
                'description' => 'Headset dengan microphone untuk bermain game dan meeting.',
                'price' => 450000,
            ],
            [
                'name' => 'Monitor 24 Inch',
                'description' => 'Monitor Full HD dengan ukuran 24 inch.',
                'price' => 1800000,
            ],
            [
                'name' => 'Webcam Full HD',
                'description' => 'Webcam Full HD untuk meeting dan pembelajaran online.',
                'price' => 550000,
            ],
            [
                'name' => 'USB Flashdisk 64GB',
                'description' => 'Flashdisk berkapasitas 64GB untuk menyimpan berbagai file.',
                'price' => 120000,
            ],
            [
                'name' => 'SSD NVMe 512GB',
                'description' => 'SSD NVMe dengan kecepatan tinggi untuk meningkatkan performa komputer.',
                'price' => 750000,
            ],
            [
                'name' => 'RAM DDR4 16GB',
                'description' => 'RAM DDR4 16GB untuk meningkatkan kemampuan multitasking.',
                'price' => 600000,
            ],
        ];

        $product = fake()->randomElement($products);

        return [
            'category_id' => Category::inRandomOrder()->value('id'),

            'name' => $product['name'],

            'slug' => Str::slug($product['name']) . '-' . fake()->unique()->numberBetween(1000, 9999),

            'description' => $product['description'],

            'price' => $product['price'],

            'stock' => fake()->numberBetween(5, 100),

            'image' => 'products/default.jpg',
        ];
    }
}