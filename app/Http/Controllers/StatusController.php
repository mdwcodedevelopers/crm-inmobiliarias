<?php

namespace App\Http\Controllers;

use App\Report;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $status = Status::get();
        return response()->json([
            'status' => $status,
    ]);
    }
    public function store(Request $request)
    {

        Status::create([
            'status'=>$request['name']
        ]);
        Report::create([
            'type'=>'Creación',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se creo el estatus de propiedad: '.$request['status']
        ]);
    }
    public function update(Request $request, $id)
    {
        $statu = Status::where('id','=',"$id")->first();
        $status = Status::find($id);
        $status->update([
            'status'=>$request['name']
        ]);
        Report::create([
            'type'=>'Actualización',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se actualizó el estatus de propiedad: '.$statu->status.' a: '.$request['name']
        ]);
        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        $statu = Status::where('id','=',"$id")->first();
        $status = Status::find($id);
        $status->delete();
        Report::create([
            'type'=>'Eliminación',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se eliminó el estatus de propiedad: '.$statu->status
        ]);
        return response()->json("success", 200);
    }
}
