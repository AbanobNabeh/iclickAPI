<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReelsModel>
 */
class ReelsModelFactory extends Factory
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
            'video' => $this->faker->url,
            'caption' => $this->faker->sentence,
            'like' => $this->faker->numberBetween(0),
            'comment' => $this->faker->numberBetween(0), 
            'share' => 0,
        ];
    }
}
