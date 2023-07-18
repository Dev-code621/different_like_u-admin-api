<?php

namespace Database\Factories;

use App\Review;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'review_id' => Review::inRandomOrder()->first()->id,
            'comment' => $this->faker->text(200),
            'status' => 'PUBLISHED',
            'type' => $this->faker->randomElement(['MERCHANT_REPLY', 'CONSUMER_REPLY']),
        ];
    }
}