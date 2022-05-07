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

    public function getRun(Request $request)
    {
        if ($request->ajax()) {
            $data = UserRunM::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a data-id="' . $row->id . '" href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a data-id="' . $row->id . '" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('run.run');
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
        return UserRunM::find($id);
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
        //
        $userrun = UserRunM::findOrFail($id);
        $userrun->update($request->all());
        return response()->json($userrun, 200);
    }

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
