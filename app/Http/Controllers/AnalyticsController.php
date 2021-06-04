<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Analytics;
use Spatie\Analytics\Period;
use App\User;
use App\Fav_property;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $rol=User::find(auth()->id())->role_id;
        // $analytics = [];
        // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $users = User::count();
        $favs = Fav_property::count();
        // dd($analyticsData);
        return view('analytics', ['rol' => $rol, 'users' => $users, 'favs' => $favs]);
    }

    // public function prueba(){
    //     return view('emails.confirmation',
    // [
    //     'name' => 'gabo',
    //     'confirmation_code' => 1245124,
    //     'id' =>2
    // ]);
    // }

}
