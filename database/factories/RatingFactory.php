<?php

namespace Database\Factories;

use App;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => App\Models\User::get()->random()->id,
            'product_id' => App\Models\Product::get()->random()->id,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }

    public function withReview()
    {
        return $this->state(function (array $attributes) {
            return [
                'review' => $this->faker->sentence,
            ];
        });
    }
}
