<?php

namespace Database\Factories;

use App\Models\Incident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arrest>
 */
class ArrestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'incident_id' => Incident::inRandomOrder()->first()->id,
        'person_name' => fake()->name(),
        'category' => fake()->randomElement(['مصنف', 'غير مصنف']),
        'date' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
