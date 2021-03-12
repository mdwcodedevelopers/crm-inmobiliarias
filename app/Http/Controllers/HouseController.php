<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HouseController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $houses = House::orderBy('updated_at', 'desc')->where('user_id', '=', "auth()->id")->paginate(5);
        $total = House::count();
        return response()->json([
            'notes' => $houses,
            'total' => $total,
            'pagination' => [
                'total'         => $houses->total(),
                'current_page'  => $houses->currentPage(),
                'per_page'      => $houses->perPage(),
                'last_page'     => $houses->lastPage(),
                'from'          => $houses->firstItem(),
                'to'            => $houses->lastItem(),
            ],
            'search' => $search
        ]);
    }
    public function store(Request $request)
    {
        House::create([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'interested'=>[],
            'images'=>json_encode($request['images'])
        ]);
    }
    public function update(Request $request, $id)
    {
        $house = House::find($id);
        $house->update([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'interested'=>[],
            'images'=>json_encode($request['images'])
        ]);
        return response()->json("success", 200);
    }
    public function addImages(Request $request)
    {
        $imageName = time().'.'.$request->file->getClientOriginalExtension();
        $path = 'images/'.$imageName;
        $request->file->move(public_path('images'), $imageName);

    	return response()->json(['success'=>$path]);
    }
    public function destroy($id)
    {
        $house = House::find($id);
        $house->delete();

        return response()->json("success", 200);
    }
}
