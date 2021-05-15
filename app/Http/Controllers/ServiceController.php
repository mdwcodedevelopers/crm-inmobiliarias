<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Service_property;
use App\User;

use Auth;

class ServiceController extends Controller
{

    public function init(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return view( 'services', [ 'role' => $user->role_id ] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';

        $services = Service::where('name', 'LIKE', "%$search%")->get();

        return response()->json(['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::create(['name' => $request['name']]);

        return response()->json("success", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Service_property::selectRaw('proservices.*, services.name')
        ->join('services', 'proservices.service_id', '=', 'services.id')
        ->where('property_id',$id)->get();

        return compact('services');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);

        return response()->json(["success" => 200, 'service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $service->update(['name' => $request['name']]);

        return response()->json(["success" => 200, 'service' => $service]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id)->delete();

        return response()->json("success", 200);
    }
}
