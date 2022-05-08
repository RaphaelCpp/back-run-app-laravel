<?php

namespace App\Http\Controllers;

use App\Models\UserRunM;
use Illuminate\Http\Request;
use Datatables;

class UserRun extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $runList = UserRunM::paginate(8);
        return response()->json($runList, 200);
    }

    public function getAllRun(Request $request)
    {
        return UserRunM::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userrun = UserRunM::create($request->all());
        return response()->json($userrun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $runList = UserRunM::paginate(8);
        $runList = UserRunM::where('user_id', $id);
        return response()->json($runList->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    //     $userrun = UserRunM::findOrFail($id);
    //     $userrun->update($request->all());
    //     return response()->json($userrun, 200);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        UserRunM::findOrFail($id)->delete();
        return response(['message' => 'Deleted'], 200);
    }
}
