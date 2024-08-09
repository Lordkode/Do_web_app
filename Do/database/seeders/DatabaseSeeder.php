<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Topic::factory(50)->create();

        Comment::factory(100)->create();

        Like::factory(350)->create();

        User::factory()->create([
            'username' => 'admin',
            'fullname' => 'admin',
            'isAdmin' => true,
            'email' => 'admin@gmail.com',
            'password' => 'qwertyuiop',
            'birthdate' => '2000-12-12',
        ]);
    }
}
