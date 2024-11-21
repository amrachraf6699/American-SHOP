<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // Get filter values from the request
        $code = request('code');
        $type = request('type');
        $limitType = request('limit_type');

        // Start building the query
        $query = Coupon::query();

        // Apply filters if they are set
        if ($code) {
            $query->where('code', 'like', '%' . $code . '%');
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($limitType) {
            $query->where('limit_type', $limitType);
        }

        // Get paginated results
        $coupons = $query->paginate(10);

        return view('manage.coupons.index', compact('coupons'));
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('manage.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreCouponRequest $request)
    {
        $coupon = Coupon::create([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'limit_type' => $request->input('limit_type'),
            'discount_amount' => $request->input('discount_amount'),
            'discount_percentage' => $request->input('discount_percentage'),
            'max_usage' => $request->input('max_usage'),
            'expires_at' => $request->input('expires_at'),
            'usage_count' => $request->input('usage_count', 0),
            'is_active' => $request->input('is_active', true),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('manage.coupons.edit' , compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(StoreCouponRequest $request, $id)
    {
        // Find the coupon by ID or fail
        $coupon = Coupon::findOrFail($id);

        // Update the coupon with validated data
        $coupon->update([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'limit_type' => $request->input('limit_type'),
            'discount_amount' => $request->input('discount_amount'),
            'discount_percentage' => $request->input('discount_percentage'),
            'max_usage' => $request->input('max_usage'),
            'expires_at' => $request->input('expires_at'),
            'is_active' => $request->input('is_active', true),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
