<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\WebsiteInfo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $coupon = session()->get('coupon');

        // Get the cart items for the authenticated user
        $cartItems = auth()->user()->cartItems()->with('product')->get();

        // Calculate the total price of the cart items
        $totalPrice = $cartItems->sum(function($item) {
            return $item->getPriceSum(); // Assuming getPriceSum() exists on CartItem model
        });

        // Initialize the discount and total price after discount
        $totalPriceAfterDiscount = $totalPrice; // Default total price is without any discount
        $discount = 0; // Default discount is zero

        // Apply the coupon if it exists and is valid
        if ($coupon) {
            if ($coupon->type == 'fixed') {
                // Fixed discount: subtract the discount amount
                $totalPriceAfterDiscount = $totalPrice - $coupon->discount_amount;
                $discount = $coupon->discount_amount; // Store the discount for display
            } elseif ($coupon->type == 'percentage') {
                // Percentage discount: subtract the percentage of the total price
                $totalPriceAfterDiscount = $totalPrice - ($totalPrice * $coupon->discount_percentage / 100);
                $discount = $totalPrice * $coupon->discount_percentage / 100; // Store the discount for display
            }
        }

        // Calculate the shipping fee (assumed logic)
        $shippingFee = WebsiteInfo::first()->shipping_fee * $totalPrice;

        // Calculate the final total after adding the shipping fee
        $finalTotal = $totalPriceAfterDiscount + $shippingFee;

        $addresses = auth()->user()->addresses;

        return view('cart.index', compact('cartItems', 'totalPrice', 'discount', 'totalPriceAfterDiscount', 'shippingFee', 'finalTotal', 'addresses'));
    }


    public function add(Request $request)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $user = auth()->user();

        $cartItem = $user->cartItems()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + ($request->quantity ?? 1),
            ]);
        } else {
            $user->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }


    public function remove($cartItem)
    {
        auth()->user()->cartItems()->findOrFail($cartItem)->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = auth()->user()->cartItems()->findOrFail($request->cart_item_id);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|exists:coupons,code',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon->isValid()) {
            return redirect()->back()->with('error', 'Coupon is not valid!');
        }

        $coupon->increment('usage_count');

        session()->put('coupon', $coupon);

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }
}
