<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('user.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('user.addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $user = auth()->user();

        $isDefault = $request->has('is_default');
        if ($isDefault) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address = $user->addresses()->create(array_merge($validated , ['is_default' => $isDefault]));

        return redirect()->route('addresses.index')->with('success', 'Address added successfully');
    }

    public function edit($address)
    {
        $address = auth()->user()->addresses()->findOrFail($address);
        return view('user.addresses.edit', compact('address'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $address = auth()->user()->addresses()->findOrFail($id);

        $isDefault = $request->has('is_default');

        if ($isDefault) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        $address->update(array_merge($validated, ['is_default' => $isDefault]));

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully');
    }


    public function destroy($address)
    {
        $address = auth()->user()->addresses()->findOrFail($address);

        if ($address->is_default) {
            return back()->with('error', 'Default address can not be deleted');
        }

        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully');
    }

    public function default($address)
    {
        $address = auth()->user()->addresses()->findOrFail($address);
        auth()->user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);
        return redirect()->route('addresses.index')->with('success', 'Default address updated successfully');
    }
}
