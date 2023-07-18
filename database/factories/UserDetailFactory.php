<?php

namespace Database\Factories;

use App\User; 
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
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
            'user_name' => $this->faker->userName(),
            'race_id' => $this->faker->numberBetween(1, 10),
            'age_range_id' => $this->faker->numberBetween(1, 8),
            'age_range_last_modified' => $this->faker->dateTime(),
            'income_range_id' => $this->faker->numberBetween(1, 10),
            'income_range_last_modified' => $this->faker->dateTime(),
            'ethnicity_id' => $this->faker->numberBetween(1, 2),
            'ethnicity_last_modified' => $this->faker->dateTime(),
            'appearance_id' => $this->faker->numberBetween(1, 7),
            'appearance_last_modified' => $this->faker->dateTime(),
            'language_proficiency_id' => $this->faker->numberBetween(1, 3),
            'language_proficiency_last_modified' => $this->faker->dateTime()
        ];
    }
}
