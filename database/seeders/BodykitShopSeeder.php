<?php

namespace Database\Seeders;

use App\Models\BodykitShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodykitShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BodykitShop::factory()->count(10)->create();
    }
}
