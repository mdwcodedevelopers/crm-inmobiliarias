<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use Auth;

class ReportController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $role = Auth::user()->role_id;

    return view('reports', compact('role'));
    //return response()->json(['reports' => $reports]);
  }

  public function list()
  {
    $role = Auth::user()->role_id;

    return view('reports', compact('role'));
  }

}
