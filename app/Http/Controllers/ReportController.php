<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use App\Contact_tag;
use App\Report;
use App\Tag;
use App\User;

use Auth;

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

}
