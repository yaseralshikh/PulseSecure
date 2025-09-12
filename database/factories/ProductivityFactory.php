<?php

namespace Database\Factories;

use App\Models\Entitie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productivity>
 */
class ProductivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => Entitie::inRandomOrder()->first()->id,
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'value' => fake()->numberBetween(10, 200),
        ];
    }
}
