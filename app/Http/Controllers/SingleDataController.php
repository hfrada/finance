<?php

namespace App\Http\Controllers;

use App\User;
use App\SuperUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleDataController extends Controller
{
	public function userNames()
	{
		return ['data' => User::pluck('name')];
	}

    public function selfData()
    {
    	return SuperUsers::select('super_users.name', 'role.access_name', 'role.permission')
			->join('role', 'super_users.role_id', '=', 'role.id')
			->where('super_users.id', '=', Auth::guard('super_user')->user()->id)
			->get();
    }
}
