<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use App\Models\WebsiteInfo;
use App\Models\WishList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@website.com',
        //     'phone' => '1234567890',
        //     'password' => 'Admin3@1',
        //     'type' => 'admin',
        // ]);
        User::factory(10)->create();
        Address::factory(34)->create();
        Category::factory(5)->create();

        Product::factory(40)->create();
        Product::factory(8)->discount()->create();
        Product::factory(4)->toHomeSlider()->create();

        $this->call(ProductCategorySeeder::class);

        Rating::factory(rand(1,800))->create();

        WishList::factory(rand(20,400))->create();
        WebsiteInfo::factory(1)->create();


    }
}
