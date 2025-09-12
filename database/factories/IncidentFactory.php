<?php

namespace Database\Factories;

use App\Models\Entitie;
use App\Models\Incident_source;
use App\Models\Incident_type;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => Entitie::inRandomOrder()->value('id'),
            'governorate_id' => Governorate::inRandomOrder()->value('id'),
            'incident_type_id' => Incident_type::inRandomOrder()->value('id'),
            'incident_source_id' => Incident_source::inRandomOrder()->value('id'),
            'is_case' => fake()->boolean(30), // 30% من الوقائع تعتبر قضايا
            'description' => fake()->sentence(),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'location_lat' => fake()->latitude(),
            'location_lng' => fake()->longitude(),
        ];
    }
}
