<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function wish(Request $request, Product $product)
    {
        $wishlistItem = $request->user()->wishList()->where('product_id', $product->id)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from wishlist');
        }

        $request->user()->wishList()->create([
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Product added to wishlist');
    }

    public function clear(Request $request)
    {
        $request->user()->wishList()->delete();

        return back()->with('success', 'Wishlist cleared');
    }
}
