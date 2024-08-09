<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence($nbWords = 6, $variableNbrWords = true),
            'description' => fake()->paragraph(),
            'note' => fake()->numberBetween(1, 5),
            'user_id' => fake()->randomElement(User::pluck('id')),
            'topic_id' => fake()->randomElement(Topic::pluck('id'))
        ];
    }
}
