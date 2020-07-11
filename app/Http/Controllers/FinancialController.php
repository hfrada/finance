<?php

namespace App\Http\Controllers;

use Validator;
use App\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $sortType = $request->input('sort_type', 'asc');

        $res = Financial::join('users', 'financial.user_id', '=', 'users.id')
            ->join('category', 'financial.category_id', '=', 'category.id')
            ->select(['financial.id', 'financial.type', 'financial.amount', 'financial.created_at', 'users.name as username', 'category.category']);

        $filter = [
            'username' => 'users.name',
            'category' => 'category.id',
            'type' => 'financial.type',
            'amount_min' => 'financial.amount|>=',
            'amount_max' => 'financial.amount|<=',
            'date_min' => 'financial.created_at|>=',
            'date_max' => 'financial.created_at|<=',
        ];

        foreach ($filter as $param => $opt) {
            if ($request->{$param}) {
                $opt = explode('|', $opt);
                count($opt) > 1 ? 
                $res->where($opt[0], $opt[1], $request->{$param}) :
                $res->where($opt[0], $request->{$param});
            }
        }

        return $res->orderBy($sortBy, $sortType)->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.   
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'amount' => 'required',
            'category_id' => 'required'
        ]);

        $request->merge(['user_id' => Auth::guard('super_user')->user()->id]);

        if ($validator->fails())
            return response([
                'error_type' => 'validator',
                'messages' => $validator->messages()->all()
            ], 500);

        if (Financial::create($request->only(['type', 'amount', 'user_id', 'category_id']))) return ['messages' => 'data created!'];
        else return response(['messages' => 'failed created!'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($financial = Financial::find($id)) return $financial;
        else return response(['message' => 'id not found!'], 500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($financial = Financial::find($id)) {
            
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'amount' => 'required',
                'category_id' => 'required'
            ]);

            $request->merge(['user_id' => Auth::guard('super_user')->user()->id]);

            if ($validator->fails())
                return response([
                    'error_type' => 'validator',
                    'message' => $validator->messages()->all()
                ], 500);

            if ($financial->update($request->only(['type', 'amount', 'user_id', 'category_id']))) return ['message' => 'data updated'];
            else return response(['message' => 'failed update!'], 500);

        }
        else return response(['message' => 'id not found!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($financial = Financial::find($id)) {
            
            try {
                $financial->delete();
                return ['message' => 'data deleted!'];
            } catch (\Exception $e) {
                return response([
                    'message' => 'failed delete!',
                    'exception_error' => $e->getMessage() 
                ], 500);
            }

        }
        else return response(['message' => 'id not found!'], 500);
    }
}
