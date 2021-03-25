<?php

namespace App\Http\Controllers;

use App\Property;
use App\Status;
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
        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('user_id',auth()->id())->join('properties','properties.status_id','status.id')->get();
        $total = Property::count();
        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'status'=>$status,

        ]);
    }
    // queda por actualizar
    public function store(Request $request)
    {
        Property::create([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'status_id'=>1,
            'categorie_id'=>1,
            'city'=>1
            // 'interested'=>[],
            // 'images'=>json_encode($request['images'])
        ]);
    }
    public function update(Request $request,$id)
    {
        // $property = Property::find($id);
        // $property->update([
        //     'user_id'=>auth()->id(),
        //     'title'=>$request['title'],
        //     'information'=>$request['information'],
        //     'price'=>$request['price'],
        //     'dimension'=>$request['dimension'],
        //     'status_id'=>1,
        //     'categorie_id'=>1,
        //     'city'=>1
        // ]);
        $property = Property::find($id);
        $property->update([
            'user_id'=>auth()->id(),
            'title'=>$request->title,
            'information'=>$request->information,
            'price'=>$request->price,
            'dimension'=>$request->dimension,
            'status_id'=>1,
            'categorie_id'=>1,
            'city'=>1
        ]);
        return response()->json("success");
    }
    public function property($id)
    {
        $property= Status::orderBy('updated_at', 'desc')->where('properties.id','=',"$id")
        ->join('properties','properties.status_id','status.id')->first();
        return view('property',['property'=>$property]);
    }
    public function destroy($id)
    {
        $property = Property::find($id);
        $property->delete();

        return response()->json("success", 200);
    }
}
