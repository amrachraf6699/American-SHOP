<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters'
        ]);

        Newsletter::create($request->only('email'));

        return back()->with('success', 'You have been subscribed successfully.');
    }
}
