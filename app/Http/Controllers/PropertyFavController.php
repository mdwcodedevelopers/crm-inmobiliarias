<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fav_property;
use Auth;

class PropertyFavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Fav_property::whereUser_id(Auth::user()->id)->get();
        return view('name', ["properties" => $properties]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fav = new Fav_property();
        $fav->user_id = Auth::user()->id; 
        $fav->property_id = $request->property_id;
        $fav->save();
        return return response()->json("success", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fav = Fav_property::where("user_id", Auth::user()->id)->where("property_id", $request->property_id)->first();
        $fav->delete();
        return return response()->json("success", 200);
    }
}
