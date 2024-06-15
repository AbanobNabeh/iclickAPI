<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoriesModel>
 */
class StoriesModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'iduser' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(),
            'date' => $this->faker->dateTimeBetween('-1 day', 'now'),
        ];
    }
}
