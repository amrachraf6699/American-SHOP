<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Product $product)
    {

        $product->load('categories', 'ratings' , 'files');

        $similarProducts = Product::whereHas('categories', function($query) use ($product) {
            $query->whereIn('category_id', $product->categories->pluck('id'));
        })->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        return view('product', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    }
}
