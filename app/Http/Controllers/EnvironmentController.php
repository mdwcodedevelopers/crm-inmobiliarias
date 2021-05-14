<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Environment;
use App\Environment_property;
use App\User;

use Auth;

class EnvironmentController extends Controller
{

    public function init(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return view( 'environments', [ 'role' => $user->role_id ] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';

        $environments = Environment::where('name', 'LIKE', "%$search%")->get();

        return response()->json([
            'environments' => $environments
        ]);
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
        Environment::create([
            'name' => $request['name'],
            'type' => isset($request['type']) ? '2' : '1',
        ]);

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
        $environments = Environment_property::selectRaw('proenvironments.*, environments.name')
        ->join('environments', 'proenvironments.environment_id', '=', 'environments.id')
        ->where('property_id',$id)->get();

        return response()->json([
            'environments' => $environments,
            'situations' => situations(),
            'antiquitys' => antiquity(),
            'conditions' => conditions(),
            'locations' => locationsKeys(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $environment = Environment::find($id);

        return response()->json(["success" => 200, 'environment' => $environment]);
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
        $environment = Environment::find($id);

        $environment->update([
            'name' => $request['name'],
            'type' => isset($request['type']) ? '2' : '1',
        ]);

        return response()->json(["success" => 200, 'environment' => $environment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $environment = Environment::find($id)->delete();

        return response()->json("success", 200);
    }
}
