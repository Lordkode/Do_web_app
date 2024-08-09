<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_like' => fake()-> boolean(),
            'comment_id'=> fake()->randomElement(Comment::pluck('id')),
            'user_id' => fake()->randomElement(User::pluck('id')),
        ];
    }
}
