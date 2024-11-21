<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Category $category, Request $request)
    {
        // Load relationships
        $category->load('products', 'children.products');

        // Check if a child category filter is provided
        $childCategoryId = $request->get('child_category_id');

        if ($childCategoryId) {
            // Filter products for the selected child category
            $products = Product::whereHas('categories', function ($query) use ($childCategoryId) {
                $query->where('id', $childCategoryId);
            })->paginate(12);
        } else {
            // Fetch all products for the category and its children
            $products = Product::whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category->id)
                      ->orWhereIn('id', $category->children->pluck('id'));
            })->paginate(12);
        }

        return view('category', [
            'category' => $category,
            'products' => $products,
            'childCategoryId' => $childCategoryId,
        ]);
    }


}
