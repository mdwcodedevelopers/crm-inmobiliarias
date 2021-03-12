<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $status = Status::orderBy('updated_at', 'desc')->where('user_id', '=', "auth()->id")->paginate(5);
        $total = Status::count();
        return response()->json([
            'notes' => $status,
            'total' => $total,
            'pagination' => [
                'total'=> $status->total(),
                'current_page'  => $status->currentPage(),
                'per_page'      => $status->perPage(),
                'last_page'     => $status->lastPage(),
                'from'          => $status->firstItem(),
                'to'            => $status->lastItem(),
            ],
            'search' => $search
        ]);
    }
    public function store(Request $request)
    {
        Status::create([
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
        $status = Status::find($id);
        $status->update([
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
        $status = Status::find($id);
        $status->delete();

        return response()->json("success", 200);
    }
}
