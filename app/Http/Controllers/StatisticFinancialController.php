<?php

namespace App\Http\Controllers;

use DB;
use App\Financial;
use Illuminate\Http\Request;

class StatisticFinancialController extends Controller
{
	public function index()
	{
		return Financial::join('users', 'financial.user_id', '=', 'users.id')
		->select(['users.name as username', 'financial.type', 'financial.amount'])
		->addSelect(DB::raw('SUM(financial.amount) as total_amount'))
		->addSelect(DB::raw('SUM(IF(financial.type = "pay", financial.amount, 0)) as pay'))
		->addSelect(DB::raw('SUM(IF(financial.type = "wallet", financial.amount, 0)) as wallet'))
		->groupBy('username')
		->get();
	}
}
