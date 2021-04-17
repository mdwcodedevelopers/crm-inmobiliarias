<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($user=User::find(auth()->id())){
            if($user->role_id==3){
                return view('welcome',['rol'=>$user->role_id]);
            }else{
                return view('home',['rol'=>$user->role_id]);
            }
        }
        else{
            return view('welcome');
        }
    }
}
