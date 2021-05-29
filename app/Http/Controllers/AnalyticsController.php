<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        // dd($analyticsData);
        return view('analytics');
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
