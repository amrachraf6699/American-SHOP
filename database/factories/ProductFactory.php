<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(100, 1000),
        ];
    }

    /**
     * Indicate that the product has discount.
     *
     * @return \Database\Factories\ProductFactory
     */

    public function discount()
    {
        return $this->state(function (array $attributes) {
            return [
                'discount' => $this->faker->numberBetween(10, 50),
            ];
        });
    }

    /**
     * Indicate that the product to home slider
     *
     * @return \Database\Factories\ProductFactory
     */

    public function toHomeSlider()
    {
        return $this->state(function (array $attributes) {
            return [
                'home_slider' => 1,
            ];
        });
    }
}
