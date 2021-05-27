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
       
    public function viewMyEvents(Request $request){
        $user = User::find(Auth::user()->id);
        $events_types = Event_types::get();
        foreach ($events_types as $key => $value) {
            $value->count = Event::whereEvent_types_id($value->id)->count();
        }
        return view( 'events', [ 
            'role' => $user->role_id,  
            'events_types' => $events_types ] );
    }
   
    public function viewEvents(Request $request){
        $user = User::find(Auth::user()->id);
        // $eventsRef = User_event::whereUser_id(Auth::user()->id)->get();
        $events = Event::selectRaw('events.id, events.date AS start, events.completed, events.postponed,events.event_types_id, events.property_id, events.report, 
        event_types.name, event_types.color AS color')
        ->join('event_types', 'events.event_types_id', '=', 'event_types.id')
        ->join('usersevents', 'events.id', '=', 'usersevents.event_id')
        ->where('usersevents.user_id', $user->id)
        ->where('usersevents.role_id', $user->role_id)->get();
        // $events = Event::get();
        // foreach ($events as $key => $value) {
            //     $value->agents = User_event::whereEvent_id($value->id)->whereRole_id(3)->get();
            //     $value->clients = User_event::whereEvent_id($value->id)->whereRole_id(2)->get();
            // }
            
            $event_types = Event_types::get();
            
        foreach ($event_types as $key => $value) {
            $value->count = 0;
        }
        // foreach ($event_types as $key => $value) {
        //     $value->count = User_event::whereUser_id($user->id)->whereRole_id('role_id')
        //     ->join('usersevents', 'events.id', '=', 'usersevents.event_id')
        //     ->join('event_types', 'events.event_types_id', '=', 'event_types.id')
        //     ->where('event_types.')->count();
        // }
        // dd($event_types);
        return view( 'events-invite', [ 
            'role' => $user->role_id,  
            'events' => $events,  
            'events_types' => $event_types ] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $event_types = Event_types::get();
        $events = Event::selectRaw('events.id, events.date AS start, events.completed, events.postponed,events.event_types_id, events.property_id, events.report, 
        event_types.name, event_types.color AS color')
        ->join('event_types', 'events.event_types_id', '=', 'event_types.id')
        ->where('user_id', Auth::user()->id)->get();
        // $events = Event::get();
        foreach ($events as $key => $value) {
            $value->agents = User_event::whereEvent_id($value->id)->whereRole_id(3)->get();
            $value->clients = User_event::whereEvent_id($value->id)->whereRole_id(2)->get();
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
        saveReport(15, 3, 1, "El agente ". Auth::user()->name ." ha creado un evento", $request->property_id);

        foreach ($request->contacts as $key => $value) {
            $contact = new User_event();
            $contact->event_id = $event->id;
            $contact->user_id = $value;
            $contact->role_id = 2;
            $contact->save();
            saveReport(16, 3, 1, "El agente ". Auth::user()->name ." ha invitado a un evento a " . Contact::find($value)->name, $request->property_id, $value);
            (!is_null(Contact::find($value)->user_id)) ? saveNotification(Contact::find($value)->user_id, 16,"El agente ". Auth::user()->name ." te ha invitado a un evento el " . $request->date) : '';
        }
        foreach ($request->agents as $key => $value) {
            $contact = new User_event();
            $contact->event_id = $event->id;
            $contact->user_id = $value;
            $contact->role_id = 3;
            $contact->save();
            saveReport(16, 3, 1, "El agente ". Auth::user()->name ." ha invitado a un evento a " . User::find($value)->name, $request->property_id, $value);
            saveNotification($value, 16,"El agente ". Auth::user()->name ." te ha invitado a un evento el " . $request->date);
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
        $event = Event::find($id);
        
       
        if ($request->completed != '0') {
            $event->completed = $request->completed;
            $event->report = $request->report;
        }else{
            if ($request->postponed ) {
                if ( $event->postponed == "3") {
                    return response()->json("No puede posponer el evento más de 3 veces, debe marcarlo como fallido", 500);
                }
                $event->date = $request->start;
                $event->postponed = (string)(((int)$event->postponed) +1);
                saveReport(18, 3, 1, "El agente ". Auth::user()->name ." ha pospuesto un evento para el " . $request->start, $request->property_id);
            }
        }
        
        $event->save();

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
        $event = Event::find($id);

        saveReport(17, 3, 1, "El agente: ". Auth::user()->name."ha eliminado un evento ");

        $event->delete();

        return response()->json("success", 200);
    }
}
