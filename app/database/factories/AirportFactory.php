<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city . ' Airport',
            'code' => $this->faker->unique()->regexify('[A-Z]{3}'),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'country_id' => rand(1, 3),
        ];
    }
}
