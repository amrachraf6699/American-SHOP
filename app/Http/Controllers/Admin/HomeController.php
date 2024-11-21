<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        // Stats
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalSubscribers = Newsletter::count();

        // Orders Today
        $ordersToday = Order::whereDate('created_at', today())->count();

        //Orders This Month
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)->count();

        //Orders This Year
        $ordersThisYear = Order::whereYear('created_at', now()->year)->count();


        // Total Revenue (sum of all orders)
        $totalRevenue = Order::sum('total');

        // Revenue This Month
        $revenueThisMonth = Order::whereMonth('created_at', now()->month)->sum('total');

        //Revenue Today
        $revenueToday = Order::whereDate('created_at', today())->sum('total');

        return view('manage.home', compact(
            'totalUsers',
            'totalCategories',
            'totalProducts',
            'totalOrders',
            'ordersToday',
            'totalRevenue',
            'revenueThisMonth',
            'revenueToday',
            'ordersThisMonth',
            'ordersThisYear',
            'totalSubscribers'
        ));
    }

}
