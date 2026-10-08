<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Gaming',
            'Mahasiswa',
            'Office',
            'Budget',
            'Premium',
            'Wireless',
            'RGB',
            'Portable',
            'Best Seller',
            'Promo',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}