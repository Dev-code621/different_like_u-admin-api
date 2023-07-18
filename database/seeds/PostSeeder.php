<?php

namespace Database\Seeders;

use App\Post;
use App\TrainingResource;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory()->count(12)->firstOrCreate();
        $training = TrainingResource::factory()->count(12)->firstOrCreate();
    }
}
