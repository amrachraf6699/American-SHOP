<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $all_categories = Category::where('parent_id', null)->get();
        $website_info = WebsiteInfo::first();


        View::share(
            [
                'all_categories' => $all_categories,
                'website_info' => $website_info
            ]
        );
    }

}
