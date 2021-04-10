<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Report;
use App\User;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(Request $request){
        $currency = Currency::get();
        return response()->json([
            'currency' => $currency,
    ]);
    }
    public function store(Request $request)
    {
        Currency::create([
            'currency'=>$request['name']
        ]);
        Report::create([
            'type'=>'Creación',
            'table'=>'Moneda',
            'information'=>'Se creo la moneda: '.$request['name']
        ]);
    }
    public function update(Request $request, $id)
    {
        $name = Currency::where('id','=',"$id")->first();
        $currency = Currency::find($id);
        $currency->update([
            'currency'=>$request['name']
        ]);
        Report::create([
            'type'=>'Actualizacion',
            'table'=>'Moneda',
            'information'=>'Se cambio el de '.$name->currency.' nombre a: '.$request['name']
        ]);
        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        // Report::create([
        //     'type'=>'Actualizacion',
        //     'table'=>'Moneda',
        //     'information'=>'Se cambio el nombre a: '.$request['name']
        // ]);
        $name = Currency::where('id','=',"$id")->first();
        $currency = Currency::find($id);
        $currency->delete();
        Report::create([
            'type'=>'Eliminación',
            'table'=>'Moneda',
            'information'=>'Se eliminó '.$name->currency
        ]);
        return response()->json("success", 200);
    }
    public function view()
    {

        // if(User::find(auth()->id())){
        //     $user=User::find(auth()->id());
        //     if($user==1){
        //         return view('currency',['rol'=>$user->rol_id]);

        //     }
        //     else{
        //         return view('welcome');
        //     }
        // }
        // else{
        //     return view('welcome');
        // }
        if($user=User::find(auth()->id())){
            return view('currency',['rol'=>$user->rol_id]);
        }
        else{
            return view('welcome');
        }
    }
}
