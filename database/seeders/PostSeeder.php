<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            $post = new Post;

            $post->title = fake()->jobTitle();
            $post->description = fake()->realText();
            $post->user_id = $user->id;

            $post->save();
        }
    }
}
