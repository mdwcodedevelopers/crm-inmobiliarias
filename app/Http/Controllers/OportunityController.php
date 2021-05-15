<?php

namespace App\Http\Controllers;

use App\User;
use App\Oportunity;
use App\Note_oportunity;
use App\Property;
use App\Contact;
use App\StatusOportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OportunityController extends Controller
{

    

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $status = StatusOportunity::get();
        foreach ($status as $key => $value) {
            $value->count = Oportunity::whereStatus_id($value->id)->count();
        }
        return response()->json([
            'status' => $status,
    ]);
    }
    public function view(Request $request)
    {           
        $rol=User::find(auth()->id())->role_id;
        $users = User::selectRaw('id, name')->whereIn('role_id', [1,3])->get();
        return view('oportunities', compact('users', 'rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
       
        $oportunity = new Oportunity();
        $oportunity->user_id = auth()->id();
        $oportunity->name = $request->name;
        $oportunity->description = $request->description;
        $oportunity->contact_id = $request->contact_id;
        $oportunity->vigency = $request->vigency;
        $oportunity->status_id = $request->status_id;
        $oportunity->property_id = $request->property_id;

        $oportunity->save();

        return response()->json("success", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_user)
    {
        $oportunities = Oportunity::selectRaw('oportunities.*, status_oportunities.name AS status, status_oportunities.color AS status_color, users.name AS user' )
        ->join('users', 'oportunities.user_id', '=', 'users.id')
        ->join('status_oportunities', 'oportunities.status_id', '=', 'status_oportunities.id')
        ->where('oportunities.user_id', $id_user)->get();
        foreach ($oportunities as $key => $value) {
            $value->contact = ($value->contact_id == null) ? null : Contact::find($value->contact_id );
            $value->property = ($value->property_id == null) ? null : Property::selectRaw('title')->find($value->property_id)->title;
        }

        return compact('oportunities');
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
        $oportunity = Oportunity::find($id);
        $oportunity->status_id = $request->status_id;
        $oportunity->user_id = $request->user_id;
        $oportunity->save();
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
        $oportunity = Oportunity::find($id)->delete();

        return response()->json("success", 200);
    }
    public function closeOportunity(Request $request, $id)
    {
        $oportunity = Oportunity::find($id);
        $oportunity->closed_reason = $request->reason;
        $oportunity->closed_description = $request->description;
        $oportunity->closed = 1;
        $oportunity->save();
    }

    public function getContacts(){
        $contacts = Contact::get();
        return $contacts;
        
    }
    public function sendEmail(Request $request)
    {
        $data["text"]=$request->text;
        $data["oportunity"]=$request->oportunity;
        $data["contact_name"] = $request->name;
        // Mail::send('emails.contact_oportunity', $data, function($message) use ($request) {
        //     $message->to($request->email)->subject($request->subject);
        // });
        return response()->json("success", 200);
    }
}
