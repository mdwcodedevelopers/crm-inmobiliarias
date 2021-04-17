<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PropertiesUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user=User::find(auth()->id());
        return view('properties',['rol'=>$user->role_id]);
    }
}
