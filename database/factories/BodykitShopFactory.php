<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BodykitShop>
 */
class BodykitShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->text(10),
            'address' => $this->faker->unique()->address(),
            'bodykit_capacity' => $this->faker->randomDigit() + 10,
        ];
    }
}
