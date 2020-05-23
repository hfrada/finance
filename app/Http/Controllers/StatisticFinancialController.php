<?php

namespace App\Http\Controllers;

use DB;
use App\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

	public function periodChart(Request $request)
	{
		$date = function($strdate, $format='Y-m-d H:i:s'){ return date($format, strtotime($strdate)); };

		$formatDate = [
			'today' => [
				'period' => '%H',
				'startDate' => $date('today midnight'),
				'endDate' => $date('tomorrow -1 seconds'),
				'startKey' => $date('today midnight', 'H'),
				'endKey' => $date('tomorrow -1 seconds', 'H')
			],
			'weekday' => [
				'period' => '%W',
				'startDate' => $date('monday this week'),
				'endDate' => $date('monday this week +6 days'),
				'startKey' => $date('monday this week', 'l'),
				'endKey' => $date('monday this week +6 days', 'l')
			],
			'monthday' => [
				'period' => '%d',
				'startDate' => $date('first day of this month midnight'),
				'endDate' => $date('last day of this month midnight +86399 seconds'),
				'startKey' => $date('first day of this month midnight', 'd'),
				'endKey' => $date('last day of this month midnight +86399 seconds', 'd')
			],
			'yearmonth' => [
				'period' => '%M',
				'startDate' => $date('1st january this year midnight'),
				'endDate' => $date('last day of december this year midnight +86399 seconds'),
				'startKey' => $date('1st january this year midnight', 'F'),
				'endKey' => $date('last day of december this year midnight +86399 seconds', 'F')
			],
			'yeardecade' => [
				'period' => '%Y',
				'startDate' => $date('1st january this year -10 years midnight'),
				'endDate' => $date('last day of december this year midnight +86399 seconds'),
				'startKey' => $date('1st january this year -10 years midnight', 'Y'),
				'endKey' => $date('last day of december this year midnight +86399 seconds', 'Y')
			],
		];
		$resTime = function($type) use ($formatDate) { return (object)array_merge([ 'type' => $type ], $formatDate[$type]); };

		$timeFormat = $resTime($request->tFormat);

		$result = Financial::whereBetween('created_at', Arr::flatten(Arr::only((array)$timeFormat, ['startDate', 'endDate'])))
		->addSelect(DB::raw("DATE_FORMAT(created_at, \"$timeFormat->period\") as date"))
		->addSelect(DB::raw("COUNT(created_at) as data"))
		->groupBy('date')
		->orderBy('created_at')
		->get()
		->toArray();

		if (count($result) < 1) {
			array_push($result, ['date' => $timeFormat->startKey, 'data' => 0]);
			array_push($result, ['date' => $timeFormat->endKey, 'data' => 0]);
		}else{
			if ($result[0]['date'] != $timeFormat->startKey) {
				array_unshift($result, ['date' => $timeFormat->startKey, 'data' => 0]);
			}
			if ($result[count($result)-1]['date'] != $timeFormat->endKey) {
				array_push($result, ['date' => $timeFormat->endKey, 'data' => 0]);
			}
		}

		return $result;
	}
}
