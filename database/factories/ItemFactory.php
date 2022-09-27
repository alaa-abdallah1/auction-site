<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'details' => $this->faker->realText(1000),
            'min_bid' => $this->faker->numberBetween($min = 15, $max = 50),
            'max_bid' => $this->faker->numberBetween($min = 51, $max = 100),
            'user_id' =>  $this->faker->randomElement($array = \App\Models\User::pluck('id')),
            'available_untill' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '10 years'),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
        ];
    }
}
