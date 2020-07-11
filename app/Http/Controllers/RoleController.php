<?php

namespace App\Http\Controllers;

use Validator;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Role::select(['id', 'access_name', 'permission'])
            ->orderBy($request->sort_by ?? 'created_at', $request->sort_type ?? 'asc')
            ->paginate();
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
            'access_name' => 'required',
            'permission' => 'required'
        ]);

        $request->merge(['permission' => implode(',', $request->permission)]);

        if ($validator->fails())
            return response([
                'error_type' => 'validator',
                'messages' => $validator->messages()->all()
            ], 500);

        if (Role::create($request->only(['access_name', 'permission']))) return ['messages' => 'data created!'];
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
        if ($role = Role::find($id)) return $role;
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
        if ($role = Role::find($id)) {
            
            $validator = Validator::make($request->all(), [
                'access_name' => 'required',
                'permission' => 'required',
            ]);

            if ($validator->fails())
                return response([
                    'error_type' => 'validator',
                    'message' => $validator->messages()->all()
                ], 500);

            if ($role->update($request->only(['access_name', 'permission']))) return ['message' => 'data updated'];
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
        if ($role = Role::find($id)) {
            
            try {
                $role->delete();
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
