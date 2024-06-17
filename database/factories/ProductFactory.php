<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'VA' . $this->faker->unique()->randomNumber(5), // 'code' => 'RM' . $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(75000, 500000),
            'description' => $this->faker->text,
            'created_by' => ['1', '2'][rand(0, 1)],
            'updated_by' => ['1', '2'][rand(0, 1)],
        ];
    }
}
