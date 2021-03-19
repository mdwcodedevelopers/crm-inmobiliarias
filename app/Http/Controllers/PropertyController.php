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
        $Properties = Property::orderBy('updated_at', 'desc')->join('status','status.id','properties.status_id')
        ->paginate(20);
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
    // queda por actualizar
    public function store(Request $request)
    {
        Property::create([
            'user_id'=>auth()->id(),
            'title'=>$request['title'],
            'information'=>$request['information'],
            'price'=>$request['price'],
            'dimension'=>$request['dimension'],
            'interested'=>[],
            'images'=>json_encode($request['images'])
        ]);
    }
    // queda por actualizar
    public function update(Request $request, $id)
    {
        $house = Property::find($id);
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
    // queda por actualizar
    public function addImages(Request $request)
    {
        $imageName = time().'.'.$request->file->getClientOriginalExtension();
        $path = 'images/'.$imageName;
        $request->file->move(public_path('images'), $imageName);

    	return response()->json(['success'=>$path]);
    }
    // queda por actualizar
    public function destroy($id)
    {
        $house = Property::find($id);
        $house->delete();

        return response()->json("success", 200);
    }
}
