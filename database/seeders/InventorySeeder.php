<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Inventory::create(['product' => 'Red Roses', 'stock' => 50, 'price' => 1500]);
    Inventory::create(['product' => 'Tulip Bouquet', 'stock' => 20, 'price' => 2500]);
    Inventory::create(['product' => 'Sunflower Bunch', 'stock' => 30, 'price' => 1800]);
    }
}
