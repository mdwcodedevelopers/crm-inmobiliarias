<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PropertiesUserController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $search = isset($request->search) ? $request->search : '';

    $user = User::find(auth()->id());

    return view('properties', ['rol' => $user->role_id] );
  }


}
