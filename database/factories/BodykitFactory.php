<?php

namespace Database\Factories;

use App\Models\BodykitShop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bodykit>
 */
class BodykitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $versions = ['RoketBunny', 'Buddy Club', ' Top-Tuning'];
        $shop = BodykitShop::all()->random();

        return [
            'version' => $versions[array_rand($versions)],
            'name' => $this->faker->unique()->text(10),
            'manufacture_year' => $this->faker->year(),
            'bodykit_shop_id' => $shop->id,
        ];
    }
}
