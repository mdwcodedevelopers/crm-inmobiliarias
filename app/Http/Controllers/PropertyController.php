<?php

namespace App\Http\Controllers;

use App\User;
use App\Currency;
use App\Property;
use App\Status;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PropertyController extends Controller
{

    public function index(Request $request){
        $search = $request->search;
        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('title','LIKE',"%$search%")
        // ->where('information','LIKE',"%$search%")
        ->join('properties','properties.status_id','status.id')->paginate(9);
        $total = Property::count();

        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'pagination' => [
                'total'         => $Properties->total(),
                'current_page'  => $Properties->currentPage(),
                'per_page'      => $Properties->perPage(),
                'last_page'     => $Properties->lastPage(),
                'from'          => $Properties->firstItem(),
                'to'            => $Properties->lastItem(),
            ],
            'search' => $search
        ]);
    }
    public function properties(Request $request){
        $status=Status::get();
        $currency=Currency::get();
        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('user_id',auth()->id())->join('properties','properties.status_id','status.id')
        ->select('properties.id','properties.information','properties.title','properties.price','properties.dimension','status.status','users.name','currency.currency')
        ->get();
        $total = Property::count();
        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'status'=>$status,
            'currency'=>$currency
        ]);
    }
    public function propertiesAdmin(Request $request){
        $status=Status::get();
        $currency=Currency::get();
        $Properties = Property::
        join('status','properties.status_id','status.id')
        ->join('users','properties.user_id','users.id')
        ->join('currency','currency.id','properties.currency_id')
        // ->join('images','images.property_id','properties.currency_id')
        ->select('properties.id','properties.information','properties.title','properties.price','properties.dimension','status.status','users.name','currency.currency','properties.image')->
        get();
        $total = Property::count();
        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'status'=>$status,
            'currency'=>$currency
        ]);
    }
    public function store(Request $request)
    {
        Property::create([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'status_id'=>$request['status'],
            'categorie_id'=>1,
            'city'=>1,
            'currency_id'=>$request['currency_id'],
            'image'=>''
        ]);
    }
    public function update(Request $request,$id)
    {
        $property = Property::find($id);
        $property->update([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'status_id'=>$request['status'],
            'categorie_id'=>1,
            'city'=>1,
            'currency_id'=>$request['currency_id']
        ]);
        return response()->json("success");
    }
    public function property($id)
    {
        $rol=User::find(auth()->id())->rol_id;
        $property= Status::orderBy('properties.updated_at', 'desc')->where('properties.id','=',"$id")
        ->join('properties','properties.status_id','status.id')->first();
        $property->image= Image::select('url_image')->whereProperty_id($property->id)->get();
        // dd($images);
        return view('property',['property'=>$property,'rol'=>$rol]);
    }
    public function destroy($id)
    {
        $property = Property::find($id);
        
        $property->delete();

        return response()->json("success", 200);
    }
}
