<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Arrangement;

class ArrangementSeeder extends Seeder
{
    public function run(): void
    {
        // Heart-shaped arrangements
        Arrangement::create([
            'name' => 'Romantic Rose Heart',
            'description' => 'A stunning heart-shaped arrangement with 100 red roses, perfect for anniversaries.',
            'price' => 8500,
            'image' => 'images/arrangement/rose_heart.jpeg'
        ]);

        Arrangement::create([
            'name' => 'Pink Carnation Heart',
            'description' => 'Delicate pink carnations arranged in a beautiful heart shape with baby\'s breath.',
            'price' => 6500,
            'image' => 'images/arrangement/carnation_heart.jpg'
        ]);

        Arrangement::create([
            'name' => 'Mixed Flower Heart',
            'description' => 'Colorful mixed flowers in a heart-shaped foam base, wrapped with satin ribbon.',
            'price' => 7200,
            'image' => 'images/arrangement/mix_heart.jpeg'
        ]);

        // Bouquet arrangements
        Arrangement::create([
            'name' => 'Classic Red Rose Bouquet',
            'description' => 'Two dozen long-stemmed red roses hand-tied with elegant ribbon.',
            'price' => 5500,
            'image' => 'images/arrangement/red_roseboq.jpg'
        ]);

        Arrangement::create([
            'name' => 'Spring Garden Bouquet',
            'description' => 'Mixed seasonal flowers including peonies, hydrangeas, and ranunculus.',
            'price' => 4800,
            'image' => 'images/arrangement/spring_boq.jpeg'
        ]);

        Arrangement::create([
            'name' => 'Tulip Fantasy Bouquet',
            'description' => 'Vibrant mix of colorful tulips arranged in a hand-tied bouquet.',
            'price' => 4500,
            'image' => 'images/arrangement/tulip_boq.jpg'
        ]);

        // Basket arrangements
        Arrangement::create([
            'name' => 'Sunflower Basket Delight',
            'description' => 'Cheerful basket filled with sunflowers, daisies, and seasonal greens.',
            'price' => 4200,
            'image' => 'images/arrangement/sunflower_basket.jpeg'
        ]);

        Arrangement::create([
            'name' => 'Orchid Elegance Basket',
            'description' => 'Luxurious basket with purple orchids and tropical foliage.',
            'price' => 7800,
            'image' => 'images/arrangement/orchid_basket.jpeg'
        ]);

        Arrangement::create([
            'name' => 'Get Well Soon Basket',
            'description' => 'Bright mixed flowers in a wicker basket with a get well balloon.',
            'price' => 3800,
            'image' => 'images/arrangement/getwell_basket.jpeg'
        ]);
    }
}