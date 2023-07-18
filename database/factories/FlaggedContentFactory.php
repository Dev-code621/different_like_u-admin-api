<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlaggedContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['Pending','Resolved','Dismiss', 'User banned', 'Post deleted']),
            'user_id' => 1,
            'business_id' => 1,
            'type' => $this->faker->randomElement(['Review','Merchant reply','Consumer reply']),
            'review_id' => 1,
            'reason' => $this->faker->randomElement(['Racist language', 'Spam', 'Hate speech or symbols']),

        ];
    }
}
