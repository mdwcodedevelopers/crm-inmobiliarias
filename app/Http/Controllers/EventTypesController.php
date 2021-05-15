<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event_types;

class EventTypesController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $events = Event_types::get();
        return compact('events');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $status = new Event_types();
        $status->name = $request->name;
        $status->min_agents = $request->min_agents;
        $status->description = $request->description;
        $status->min_clients = $request->min_clients;
        $status->notify_after = ($request->notify_after) ? '1' : '0' ;
        $status->notify_after_agent = ($request->notify_after_agent) ? '1' : '0' ;
        $status->notify_before = ($request->notify_before) ? '1' : '0' ;
        $status->notify_before_agent = ($request->notify_before_agent) ? '1' : '0' ;
        $status->message_after = $request->message_after;
        $status->message_before = $request->message_before;
        $status->color = $request->color;
        $status->save();
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
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $status = Event_types::whereId($id)->first();
        $status->name = $request->name;
        $status->min_agents = $request->min_agents;
        $status->description = $request->description;
        $status->min_clients = $request->min_clients;
        $status->notify_after = ($request->notify_after) ? '1' : '0' ;
        $status->notify_after_agent = ($request->notify_after_agent) ? '1' : '0' ;
        $status->notify_before = ($request->notify_before) ? '1' : '0' ;
        $status->notify_before_agent = ($request->notify_before_agent) ? '1' : '0' ;
        $status->message_after = $request->message_after;
        $status->message_before = $request->message_before;
        $status->color = $request->color;
        $status->save();
        return response()->json("success", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Event_types::whereId($id)->first();
        $status->delete();
        return response()->json("success", 200);
    }
}
