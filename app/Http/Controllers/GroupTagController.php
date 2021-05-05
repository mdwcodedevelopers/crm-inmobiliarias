<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupTag;
use App\Tag;

class GroupTagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new GroupTag();
        $group->name = $request->name; 
        $group->save(); 

        return response()->json("success");
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
        $group = GroupTag::find($id);
        $group->name = $request->name; 
        $group->save(); 

        return response()->json("success");
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = GroupTag::find($id)->delete();

        return response()->json("success", 200);
    }

}
