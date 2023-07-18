<?php

namespace Database\Factories;

use App\Business;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
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
            'business_id' => Business::inRandomOrder()->first()->id,
            'comment' => $this->faker->text(200),
            'status' => 'PUBLISHED',
            'overall_score' => $this->faker->randomFloat(1, 1, 5),
            'inclusive_score' => $this->faker->randomFloat(1, 1, 5),
            'welcomed' => $this->faker->boolean(),
            'respectfully' => $this->faker->boolean(),
            'recommended' => $this->faker->boolean(),
            'treated_differently' => $this->faker->boolean(),
            'treated_differently_reason' => $this->faker->text(40),
            'similarity' => $this->faker->boolean(),
            'similarity_reason' => $this->faker->text(40),
        ];
    }
}