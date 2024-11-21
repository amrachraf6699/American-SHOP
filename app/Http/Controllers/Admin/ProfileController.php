<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('manage.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        $user->update(['name' => $request->name]);

        if($request->filled('password'))
        {
            $user->update(['password' => $request->password]);
        }

        if($request->hasFile('profile_image'))
        {
            $user->file()->updateOrCreate(
                [],
                [
                    'name' => $user->name . 'Profile Picture',
                    'path' => $this->uploadImage($request->file('profile_image'),'profile')
                ]
            );
        }

        return redirect()->route('admin.home')->with('success' , 'Profile Updated Successfully');
    }


    public function logout()
    {
        auth()->logout();

        return redirect()->route('home')->with('success', "You've been signed out successfully");
    }
}
