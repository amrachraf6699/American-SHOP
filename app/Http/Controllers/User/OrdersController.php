<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoice;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\Rating;
use App\Models\WebsiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Str;



class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();

        return view('user.orders.index', compact('orders'));
    }

    public function place(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:255',
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
        ]);

        $address = Address::findOrFail($request->address_id);

        $cartItems = auth()->user()->cartItems()->with('product')->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->getPriceSum();
        });

        $coupon = session()->get('coupon');
        $totalPriceAfterDiscount = $totalPrice;
        $discount = 0;

        if ($coupon) {
            if ($coupon->type == 'fixed') {
                $totalPriceAfterDiscount = $totalPrice - $coupon->discount_amount;
                $discount = $coupon->discount_amount;
            } elseif ($coupon->type == 'percentage') {
                $totalPriceAfterDiscount = $totalPrice - ($totalPrice * $coupon->discount_percentage / 100);
                $discount = $totalPrice * $coupon->discount_percentage / 100;
            }
        }

        $shippingFee = WebsiteInfo::first()->shipping_fee * $totalPrice;

        $finalTotal = $totalPriceAfterDiscount + $shippingFee;

        $order = Order::create([
            'id' => Str::uuid(),
            'user_id' => auth()->id(),
            'address_line_1' => $address->address_line_1,
            'address_line_2' => $address->address_line_2,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'country' => $address->country,
            'phone' => $address->phone,
            'email' => $address->email,
            'payment_id' => null,
            'total' => $finalTotal,
            'fee' => $shippingFee,
            'discount' => $discount,
            'notes' => $request->notes,
        ]);


        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'name' => $cartItem->product->name,
                'cover' => $cartItem->product->cover,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'total' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }

        auth()->user()->cartItems()->delete();

        Mail::to($order->email)->queue(new OrderPlaced($order));

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }


    public function show(Order $order)
    {
        $order->load('items');

        return view('user.orders.show', compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load('items');

        Mail::to($order->email)->queue(new OrderInvoice($order));

        return back()->with('success', 'Invoice sent to your email!');
    }

    public function feedback(Order $order)
    {
        $order->load('items');

        return view('user.orders.feedback', compact('order'));
    }

    public function submitFeedback(Request $request , Order $order)
    {
        $validated = $request->validate([
            'feedback.*.rating' => 'required|integer|min:1|max:5',
            'feedback.*.comment' => 'nullable|string|max:1000',
        ]);

        foreach ($order->items as $item) {
            if (isset($validated['feedback'][$item->id])) {
                Rating::updateOrCreate(
                    [
                        'product_id' => $item->product_id,
                        'user_id' => auth()->id()
                    ],
                    [
                        'rating' => $validated['feedback'][$item->id]['rating'],
                        'review' => $validated['feedback'][$item->id]['comment'] ?? null,
                    ]
                );
            }
        }

        return redirect()->route('home')->with('success' , 'Thanks For Your Feedback!!');
    }


}
