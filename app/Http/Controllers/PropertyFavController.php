<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fav_property;
use App\Property;
use App\Image;
use App\User;
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
        // $favorite= Fav_property::whereUser_id(Auth::user()->id)->whereProperty_id(1)->get();
        // $user = User::find(Auth::user()->id);
        $properties = Property::selectRaw('properties.*')->orderBy('properties.updated_at', 'desc')
        ->join('fav_properties', 'fav_properties.property_id', 'properties.id')
        ->where('fav_properties.user_id', Auth::user()->id)->get();
        foreach ($properties as $property) {
            if (Image::selectRaw('url')->whereProperty_id($property->id)->wherePrincipal(1)->first() != null) {
                $property->image = Image::selectRaw('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
            }else{
                $property->image = null;
            }
        }
        // $favs = Fav_property::whereUser_id(Auth::user()->id)->get();
        // $properties = Fav_property::whereUser_id(Auth::user()->id)->get();
        
        return view('properties-fav', ["properties" => $properties,'rol' => Auth::user()->role_id]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favorite($id)
    {
        // $user_id = Auth::user()->id;
        $favorite= Fav_property::whereUser_id(Auth::user()->id)->whereProperty_id($id)->get();
        if ($favorite->count() == 0) {
            $fav = new Fav_property();
            $fav->user_id = Auth::user()->id; 
            $fav->property_id = $id;
            $fav->save();
            return 1;
        }else{
            $favorite[0]->delete();
            return 0;
        }
        // return return response()->json("success", 200);
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
        return  response()->json("success", 200);
    }
}
