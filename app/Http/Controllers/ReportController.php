<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Contact;
use App\Contact_tag;
use App\Event;
use App\Event_types;
use App\Oportunity;
use App\Property;
use App\Report;
use App\Tag;
use App\User;

use Auth;
use Datetime;
use PDF;

class ReportController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $role = Auth::user()->role_id;

    return view('reports', compact('role'));
  }

  public function created()
  {
    $tags = Tag::selectRaw('tags.id, tags.name, group_tags.name AS group_name')
        ->join('group_tags', 'tags.group_tag_id', '=', 'group_tags.id')->get();

    $agents = User::where('role_id',3)->get();

    $statuss = array(
      [ "id" => 0, "name" => "En espera"],
      [ "id" => 1, "name" => "Completado"],
      [ "id" => 2, "name" => "Fallido"]
    );

    return response()->json(['tags' => $tags, 'agents' => $agents, 'statuss' => $statuss]);
  }

  public function view()
  {
    $role = Auth::user()->role_id;

    return view('historical', compact('role'));
  }

  public function historical(Request $request)
  {
    $reports = Report::where('table', '!=', 'Notificaciones')->with('User')->orderByDesc('created_at')->get();

    foreach ($reports as $key => $report):
      $date1 = new DateTime( date('Y-m-d H:i', strtotime($report->created_at)) );
      $date2 = new DateTime( date("Y-m-d H:i") );
      $diff = $date1->diff($date2);
      $report->created = date('d/m/Y H:i', strtotime($report->created_at));
      $report->diff = 'hace ' . ($diff->d > 0 ? $diff->d.' días ' : '' ) . ($diff->h > 0 ? $diff->h.' horas ' : '') . ($diff->i > 0 ? $diff->i.' minutos ' : '');
    endforeach;

    return response()->json([ 'reports' => $reports ]);
  }

  public function contactsPDF(Request $request)
  {
    $tags = isset($request->tag) ? explode(",",$request->tag) : '';
    $init = isset($request->date_init) ? $request->date_init : '';
    $end = isset($request->date_end) ? $request->date_end : '';
    $agent = isset($request->agent) ? $request->agent : '';
    $status = isset($request->status) ? $request->status : '';

    if( $request->report == 1 ):
      $contacts = Contact::join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id');

      if($tags != ''):
        $contacts = $contacts->whereIn('contact_tag.tag_id', $tags);
      endif;

      if($init != '' && $end != '' && $init > $end):
        $contacts = $contacts->whereDateBetween('created_at',[$init, $end]);
      endif;

      $contacts = $contacts->get();

      foreach ($contacts as $key => $value):
        $value->tags = Contact_tag::selectRaw('tag_id')->where('contact_id',$value->id)->first();
      endforeach;

    elseif( $request->report == 2 ):

      $contacts = User::selectRaw("users.name, COUNT(contacts.id) AS quantity")->join('contacts', 'contacts.user_id','users.id')->groupBy('users.name')->get();

    elseif( $request->report == 3 ):

      $contacts = Oportunity::selectRaw("status.name AS status, oportunities.vigency AS vigency, users.name AS user, oportunities.name AS o_name, oportunities.description AS o_descr")->join('status','status.id','oportunities.status_id')->join('users','users.id','oportunities.user_id');

      if($init != '' && $end != '' && $init > $end):
        $contacts = $contacts->whereDateBetween('vigency',[$init, $end]);
      endif;
      if($agent != ''):
        $contacts = $contacts->where('oportunities.user_id', $agent);
      endif;
      $contacts = $contacts->get();

    elseif( $request->report == 4 ):

      $contacts = Event::selectRaw("users.name AS user, event_types.name AS event, properties.title AS property, CASE WHEN completed = 1 THEN 'Completado con Éxito' WHEN completed = 2 THEN 'Fallido' ELSE 'En Espera' END AS status")->join('users','users.id','events.user_id')->join('event_types','event_types.id','events.event_types_id')->join('properties','properties.id','events.property_id');

      if($status != ''):
        $contacts = $contacts->where('events.completed', "$status");
      endif;
      $contacts = $contacts->get();

    endif;

    return response()->json(['contacts' => $contacts]);
  }

  public function propertyPDF(Request $request, $id)
  {
    $property = Property::where('id',$id)->with('Status','Currency','Categories','Images')->first();

    $pdf = PDF::loadView('reports.property', compact('property'));

    return $pdf->download("Propiedad-".$property->id.".pdf");
  }
  public function NotifyUser()
  {
    $notifications = Report::where('user_id',Auth::user()->id)->where(function($query) {$query->where('table','Notificaciones');})->orderByRaw('created_at DESC')->get();
    foreach ($notifications as $key => $notify):
      $date1 = new DateTime( date('Y-m-d H:i', strtotime($notify->created_at)) );
      $date2 = new DateTime( date("Y-m-d H:i") );
      $diff = $date1->diff($date2);
      $notify->created = date('d/m/Y H:i', strtotime($notify->created_at));
      $notify->diff = 'hace ' . ($diff->d > 0 ? $diff->d.' días ' : '' ) . ($diff->h > 0 ? $diff->h.' horas ' : '') . ($diff->i > 0 ? $diff->i.' minutos ' : '');
    endforeach;
    
    return response()->json(['notifications' => $notifications]);
  }

  public function NotifyRead($id){
    $notify = Report::find($id);
    $notify->status = "0";
    $notify->save();

    return response()->json("success", 200);

  }

}
