<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = Order::with('user')->withCount('items')->latest();

        if ($request->has('order_id') && $request->order_id) {
            $query->where('id', 'like', '%' . $request->order_id . '%');
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('order_start') && $request->has('order_end') && $request->order_start && $request->order_end) {
            $query->whereBetween('created_at', [
                $request->order_start . ' 00:00:00',
                $request->order_end . ' 23:59:59'
            ]);
        }

        $orders = $query->paginate(10);

        return view('manage.orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->load('items.product', 'user' , 'items');

        return view('manage.orders.show', compact('order'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:awaiting_payment,paid,shipped,delivered,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->only('status'));

        Mail::to($order->email)->queue(new OrderStatusUpdated($order));

        return back()->with('success', 'Order status updated successfully and email has been sent to customer.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
