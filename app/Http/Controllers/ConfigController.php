<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $rol=auth()->user()->role_id ;
        return view('configuration', compact('rol'));
    }

}
