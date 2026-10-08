<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laptop',
                'description' => 'Laptop untuk kebutuhan kuliah, kerja, dan gaming.',
            ],
            [
                'name' => 'Aksesoris',
                'description' => 'Berbagai aksesoris komputer dan laptop.',
            ],
            [
                'name' => 'Komponen PC',
                'description' => 'Komponen untuk merakit dan meningkatkan performa PC.',
            ],
            [
                'name' => 'Monitor',
                'description' => 'Monitor untuk kebutuhan kerja, belajar, dan gaming.',
            ],
            [
                'name' => 'Storage',
                'description' => 'Media penyimpanan seperti SSD dan flashdisk.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}