<?php

namespace App\Http\Controllers;

use App\Property;
use App\Report;
use App\User;
use App\Oportunity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $property = Property::count();
        $users=User::count();
        $reports=Report::count();
        $oportunities=Oportunity::count();
        return response()->json([
            'property' => $property,
            'users'=>$users,
            'reports'=>$reports,
            'oportunities'=>$oportunities
    ]);
    }
}
