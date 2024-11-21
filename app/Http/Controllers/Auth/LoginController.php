<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials, true)) {
            if (auth()->user()->type === 'admin') {
                return redirect()->route('admin.home');
            }
        }

        return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.'])->withInput();
    }
}
