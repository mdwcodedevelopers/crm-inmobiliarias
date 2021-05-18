<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event_types;
use App\Event;
use App\Contact;
use App\User;
use App\User_event;
use Auth;

class EventController extends Controller
{
       
    public function view(Request $request){
        $user = User::find(Auth::user()->id);
        $events_types = Event_types::get();
        foreach ($events_types as $key => $value) {
            $value->count = Event::whereEvent_types_id($value->id)->count();
        }
        return view( 'events', [ 
            'role' => $user->role_id,  
            'events_types' => $events_types ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $event_types = Event_types::get();
        $events = Event::get();
        foreach ($events as $key => $value) {
            $value->event_type = Event_types::find($value->event_types_id)->name;
        }
        return response()->json([
            'event_types' => $event_types,
            'events'=>$events,
        ]);
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
        $event = new Event();
        $event->date = $request->date;
        $event->user_id = Auth::user()->id;
        $event->event_types_id = $request->event_types_id;
        $event->property_id = $request->property_id;
        $event->save();
        saveReport(15, 3, 1, "El agente <strong>". Auth::user()->name ."</strong> ha creado un evento", $request->property_id);

        foreach ($request->contacts as $key => $value) {
            $contact = new User_event();
            $contact->event_id = $event->id;
            $contact->user_id = $value;
            $contact->role_id = 2;
            $contact->save();
            saveReport(16, 3, 1, "El agente <strong>". Auth::user()->name ."</strong> ha invitado a un evento a " . Contact::find($value)->name, $request->property_id, $value);

        }
        foreach ($request->agents as $key => $value) {
            $contact = new User_event();
            $contact->event_id = $event->id;
            $contact->user_id = $value;
            $contact->role_id = 3;
            $contact->save();
            saveReport(16, 3, 1, "El agente <strong>". Auth::user()->name ."</strong> ha invitado a un evento a " . User::find($value)->name, $request->property_id, $value);

        }
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
