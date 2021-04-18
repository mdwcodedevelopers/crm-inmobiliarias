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
        return compact('currency');
    }
    public function store(Request $request)
    {
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->save();
        Report::create([
            'type'=>'Creación',
            'table'=>'Moneda',
            'information'=>'Se creo la moneda: '.$request['name']
            ]);
            return response()->json("success", 200);
    }
    public function update(Request $request, $id)
    {
        $currency = Currency::whereId($id)->first();
        $name = $currency->name;
        $currency->name = $request->name;
        $currency->save();
        Report::create([
            'type'=>'Actualizacion',
            'table'=>'Moneda',
            'information'=>'Se cambio el de '.$name .' nombre a: '. $request->name
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
        $currency = Currency::whereId($id)->first();
        $name = $currency->name;
        $currency->delete();
        
        Report::create([
            'type'=>'Eliminación',
            'table'=>'Moneda',
            'information'=>'Se eliminó '.$name
            ]);
        return response()->json("success", 200);
    }
    public function view()
    {

        // if(User::find(auth()->id())){
        //     $user=User::find(auth()->id());
        //     if($user==1){
        //         return view('currency',['rol'=>$user->role_id]);

        //     }
        //     else{
        //         return view('welcome');
        //     }
        // }
        // else{
        //     return view('welcome');
        // }
        if($user=User::find(auth()->id())){
            return view('currency',['rol'=>$user->role_id]);
        }
        else{
            return view('welcome');
        }
    }
}
