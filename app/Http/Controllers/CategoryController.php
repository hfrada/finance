<?php

namespace App\Http\Controllers;

use Validator;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::paginate();
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
        $validator = Validator::make($request->all(), ['category' => 'required']);
        if ($validator->fails()) {
            return response([
                'error_type' => 'validator',
                'message' => $validator->messages()->all()
            ],500);
        }

        if (Category::create($request->only('category'))) {
            return ['message' => 'data created!'];
        }else{
            return response(['message' => 'failed create!'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($category = Category::find($id)) {
            return $category;
        }else{
            return response(['message' => 'id not found!'],500);
        }
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
        if ($category = Category::find($id)) {
            $validator = Validator::make($request->all(), ['category' => 'required']);
            if ($validator->fails()) {
                return response([
                    'error_type' => 'validator',
                    'message' => $validator->messages()->all()
                ],500);
            }

            if ($category->update($request->only('category'))) {
                return ['message' => 'data updated!'];
            }else{
                return response(['message' => 'failed update!'], 500);
            }
        }else{
            return response(['message' => 'id not found!'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($category = Category::find($id)) {
            try {
                $category->delete();
                return ['message' => 'data deleted!'];
            } catch (\Exception $e) {
                return response([
                    'message' => 'failed delete!',
                    'exception_message' => $e->getMessage()
                ], 500);
            }
        }else{
            return response(['message' => 'id not found!']);
        }
    }
}
