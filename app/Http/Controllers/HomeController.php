<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $top_categories = Category::with('file')->get();
        $flash_sell = Product::Wherenotnull('discount')->limit(4)->get();
        $new_arrival = Product::latest()->limit(8)->get();
        $home_sliders = HomeSlider::get();
        return view('home', compact('top_categories', 'flash_sell', 'new_arrival', 'home_sliders'));
    }
}
