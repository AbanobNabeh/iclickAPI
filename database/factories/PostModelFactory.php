<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostModel>
 */
class PostModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'iduser' =>  $this->faker->numberBetween(1, 100),
            'image' => "1713957391.jpg",
            'likes' => $this->faker->numberBetween(0, 1000), 
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        
        ];
    }
}
