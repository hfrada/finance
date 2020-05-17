<?php

namespace App\Http\Controllers;

use DB;
use App\Financial;
use Illuminate\Http\Request;

class StatisticFinancialController extends Controller
{
	public function index()
	{
		return Financial::select(['users.name as username', 'financial.type', 'financial.amount', DB::raw('COUNT(user_id) as item_count')])
			->join('users', 'financial.user_id', '=', 'users.id')
			->groupBy('username')
			->havingRaw('COUNT(user_id) >= 1')
			->get();
	}
}
