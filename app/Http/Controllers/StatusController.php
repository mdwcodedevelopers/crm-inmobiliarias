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
        $status = new Status();
        $status->name = $request->name;
        $status->save();
      
        Report::create([
            'type'=>'Creación',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se creo el estatus de propiedad: '. $request->same
        ]);
    }
    public function update(Request $request, $id)
    {
    
        $status = Status::whereId($id)->first();
        $name = $status->name;
        $status->name = $request->name;
        $status->save();
    
        Report::create([
            'type'=>'Actualización',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se actualizó el estatus de propiedad: '.$name.' a: '.$request->name
        ]);
        return compact('status');
    }
    public function destroy($id)
    {
        $status = Status::whereId($id)->first();
        $name = $status->name;
        $status->delete();
        
        Report::create([
            'type'=>'Eliminación',
            'table'=>'Estatus de Propiedad',
            'information'=>'Se eliminó el estatus de propiedad: '.$name
        ]);
        return response()->json("success", 200);
    }
}
