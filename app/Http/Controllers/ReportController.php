<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $reports=Report::get();
        return response()->json([
            'reports' => $reports,
        ]);
    }
    public function view()
    {
        return view('reports');
    }
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();
        return response()->json("success", 200);
    }
}
