<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => fake()->sentence($nbWords = 10, $variableNbrWords = true),
            'description' => fake()->paragraph(),
            'url' => fake()->url(),
            'user_id' => fake()->randomElement(User::pluck('id'))
        ];
    }
}
