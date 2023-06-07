<?php

namespace Database\Seeders;

use App\Models\Bodykit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodykitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bodykit::factory()->count(10)->create();
    }
}
