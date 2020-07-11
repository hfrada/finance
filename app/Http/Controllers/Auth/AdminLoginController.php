<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'super_user';

    protected $redirectTo = '/admin';

    public function __construct()
    {
    	$this->middleware('guest')->except('logout');
    }

    public function guard()
    {
    	return Auth::guard('super_user');
    }

    public function loginForm()
    {
        return view('auth.adminLogin');
    }

    public function login(Request $request)
    {
    	if (Auth::guard('super_user')->attempt(['email' => $request->email, 'password' => $request->password])) return redirect()->route('adminPage');
    	
    	return back()->withErrors(['email' => 'Email or password are wrong!']);
    }

    public function logout()
    {
        return Auth::guard('super_user')->logout();
    }
}
