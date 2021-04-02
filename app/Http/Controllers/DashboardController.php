<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $property = Property::count();
        $users=User::count();
        return response()->json([
            'property' => $property,
            'users'=>$users
    ]);
    }
}
