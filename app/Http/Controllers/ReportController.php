<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Contact;
use App\Contact_tag;
use App\Property;
use App\Report;

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

    return response()->json(['tags' => $tags]);
  }

  public function view()
  {
    $role = Auth::user()->role_id;

    return view('historical', compact('role'));
  }

  public function historical(Request $request)
  {
    $reports = Report::with('User')->get();

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
      $contacts = '';
    endif;

    return response()->json(['contacts' => $contacts]);
  }

  public function propertyPDF(Request $request, $id)
  {
    $property = Property::where('id',$id)->with('Status','Currency','Categories','Images')->first();

    $pdf = PDF::loadView('reports.property', compact('property'));

    return $pdf->download("Pripiedad-".$property->id.".pdf");
  }
  public function NotifyUser()
  {
    // $notifications = Report::where([['user_id',Auth::user()->id], ['table','Preguntas'] ])->orderByRaw('updated_at - created_at DESC')->get();
    $notifications = Report::where('user_id',Auth::user()->id)->where(function($query) {$query->where('table','Preguntas')->orWhere('table','Eventos');})->orderByRaw('updated_at - created_at ASC')->get();
    // $notifications = Report::where('user_id',Auth::user()->id)->orderByRaw('updated_at - created_at DESC')->get();
    // $notifications->count =Report::where('user_id',Auth::user()->id)->where(function($query) {$query->where('table','Preguntas')->orWhere('table','Eventos');})->where->get()
    return response()->json(['notifications' => $notifications]);
  }

}
