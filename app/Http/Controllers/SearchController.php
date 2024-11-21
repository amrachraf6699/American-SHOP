<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $query = Product::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Category filter
        if ($request->filled('categories')) {
            $categoryIds = $request->categories; // this will be an array
            $query->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            });
        }

        // Min price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Max price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        //Discount filter
        if ($request->filled('discount')) {
            $query->wherenotnull('discount');
        }

        // Execute the query and paginate results
        $products = $query->withCount('ratings')->paginate(12);

        // Retrieve categories for the filter dropdown
        $categories = Category::with('children')->whereNull('parent_id')->withcount('products', 'children')->get();

        return view('search', compact('products', 'categories'));
    }

}
