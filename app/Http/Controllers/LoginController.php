<?php

namespace App\Http\Controllers;
Use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authSeller(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/login/seller/login');
        } else {
			Session::flash('error', 'Account not found.');
			return redirect()->intended('login/seller/login');
			
		}
    }
}