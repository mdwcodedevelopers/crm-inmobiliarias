<?php

namespace App\Http\Controllers;

use App\Currency;
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

    }
    public function update(Request $request, $id)
    {
        $currency = Currency::find($id);
        $currency->update([
            'currency'=>$request['name']
        ]);
        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();

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
