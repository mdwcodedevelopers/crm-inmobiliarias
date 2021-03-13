<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function index(Request $request){
        $status = Status::get();
        return response()->json([
            'status' => $status,
        ]);
    }
    public function store(Request $request)
    {
        Status::create([
            'name'=>$request['name']
        ]);
    }
    public function update(Request $request, $id)
    {
        $status = Status::find($id);
        $status->update([
            'name'=>$request['name']
        ]);
        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();

        return response()->json("success", 200);
    }
}
