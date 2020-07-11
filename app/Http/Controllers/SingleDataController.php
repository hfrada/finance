<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\SuperUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleDataController extends Controller
{
	public function roleData()
    {
    	$data = SuperUsers::join('role', 'super_users.role_id', '=', 'role.id')
			->where('super_users.id', '=', Auth::guard('super_user')->user()->id);

		return [
			'name' => $data->pluck('super_users.name')->first(),
			'access_name' => $data->pluck('role.access_name')->first(),
			'permission' => explode(',', $data->pluck('role.permission')->first()),
		];
    }

	public function userNames()
	{
		return ['data' => User::pluck('name')];
	}

	public function getPermission()
	{
		return explode(',', Auth::guard('super_user')->user()->role->permission);
	}

    public function getCategory()
    {
        return Category::select(['id', 'category'])->get();
    }


}
