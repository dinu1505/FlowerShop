<?php

namespace Database\Seeders;

use App\Models\Flower;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FlowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure directory exists
        $imagePath = public_path('images/flower');
        if (!File::exists($imagePath)) {
            File::makeDirectory($imagePath, 0755, true);
        }

        $flowers = [
            [
                'name' => 'Red Roses',
                'category' => 'rose',
                'description' => 'Elegant red roses.',
                'price' => 1000,
                'image' => 'images/flower/red_rose.jpeg',
            ],
            [
                'name' => 'White Roses',
                'category' => 'rose',
                'description' => 'Pure and graceful white roses.',
                'price' => 1100,
                'image' => 'images/flower/white_rose.jpg',
            ],
            [
                'name' => 'Pink Roses',
                'category' => 'rose',
                'description' => 'Soft pink roses, perfect for love and friendship.',
                'price' => 1200,
                'image' => 'images/flower/pink_rose.jpeg',
            ],
            [
                'name' => 'Pink Lotus',
                'category' => 'lotus',
                'description' => 'Delicate pink lotus flowers.',
                'price' => 1300,
                'image' => 'images/flower/pink_lotus.jpg',
            ],
            [
                'name' => 'White Lotus',
                'category' => 'lotus',
                'description' => 'Serene white lotus blooms.',
                'price' => 1400,
                'image' => 'images/flower/white_lotus.jpg',
            ],
            [
                'name' => 'Blue Lotus',
                'category' => 'lotus',
                'description' => 'Rare blue lotus flowers with a calming aura.',
                'price' => 1500,
                'image' => 'images/flower/blue_lotus.jpg',
            ],
            [
                'name' => 'Sunflower',
                'category' => 'other',
                'description' => 'Bright and cheerful sunflowers.',
                'price' => 900,
                'image' => 'images/flower/sunflower.jpeg',
            ],
            [
                'name' => 'Tulip',
                'category' => 'other',
                'description' => 'Vibrant tulips in various colors.',
                'price' => 1000,
                'image' => 'images/flower/tulip.jpeg',
            ],
            [
                'name' => 'Daisy',
                'category' => 'other',
                'description' => 'Simple and sweet daisies.',
                'price' => 800,
                'image' => 'images/flower/daisy.jpeg',
            ],
        ];

        foreach ($flowers as $flower) {
            Flower::create($flower);
        }
    }
}