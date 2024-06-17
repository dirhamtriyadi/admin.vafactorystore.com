<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RawMaterial>
 */
class RawMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'unit' => $this->faker->randomElement(['kg', 'g', 'm', 'cm', 'mm', 'l', 'ml', 'pcs']),
            'qty' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->text,
            'created_by' => ['1', '2'][rand(0, 1)],
            'updated_by' => ['1', '2'][rand(0, 1)],
        ];
    }
}
