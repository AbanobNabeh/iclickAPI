<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentModel>
 */
class CommentModelFactory extends Factory
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
            'comment' =>$this->faker->sentence,
            'link' => $this->faker->numberBetween(1, 100),
            'like' => 0,
            'type'=> "post",
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
