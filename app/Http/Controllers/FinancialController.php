<?php

namespace App\Http\Controllers;

use Validator;
use App\Financial;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Financial::paginate();
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
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

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
                'user_id' => 'required',
                'category_id' => 'required'
            ]);

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
