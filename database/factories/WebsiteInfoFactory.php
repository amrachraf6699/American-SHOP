<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebsiteInfo>
 */
class WebsiteInfoFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => 'https://maps.google.com/maps?q=21.028511,105.804817',
            'phone' => '0123456789',
            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'https://twitter.com/',
            'instagram' => 'https://www.instagram.com/',
            'whatsapp' => 'https://www.whatsapp.com/',
            'youtube' => 'https://www.youtube.com/',
            'shipping_fee' => 0.1,
        ];
    }
}
