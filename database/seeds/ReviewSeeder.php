<?php

namespace Database\Seeders;

use App\Review;
use App\Reply;
use Illuminate\Database\Seeder; 


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::factory()
            ->count(500)
            ->has(Reply::factory()->count(10))
            ->create();
    }
}
