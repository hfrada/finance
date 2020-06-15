<?php

namespace App\Http\Controllers\Auth;

use App\SuperUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'super_user';

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
    	$this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
    	return view('auth.adminLogin');
    }

    public function guard()
    {
    	return auth()->guard('super_user');
    }

    public function registerForm()
    {
    	return view('auth.adminRegister');
    }

    public function register(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required'
    	]);

    	SuperUsers::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

    	return redirect()->route('admin-login')->with('success', 'Registration success!');
    }

    public function login(Request $request)
    {
    	if (auth()->guard('super_user')->attempt(['email' => $request->email, 'password' => $request->password])) return redirect()->route('adminPage');
    	
    	return back()->withErrors(['email' => 'Email or password are wrong!']);

    	// if (Auth::guard('super_user')->check() == true) return redirect()->route('adminPage');
    }
}
