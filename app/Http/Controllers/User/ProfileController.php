<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        return view('user.index' , compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('user.edit' , compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:15|unique:users,phone,' . auth()->id(),
        ]);

        auth()->user()->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]
        );

        return redirect()->back()->with('success' , 'Personal information updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                function ($attribute, $value, $fail) use ($request) {
                    if (Hash::check($value, $request->user()->password)) {
                        $fail('The new password must not be the same as the current password.');
                    }
                }
            ],
        ]);


        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        auth()->user()->update(['password' => $validated['password']]);

        auth()->logout();

        return redirect()->route('login')->with('success', 'Password updated successfully.');
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with('success', 'You have been logged out successfully');
    }
}
