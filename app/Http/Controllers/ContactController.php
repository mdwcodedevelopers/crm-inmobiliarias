<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\GroupTag;
use App\Tag;
use App\Contact_tag;

class ContactController extends Controller
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
    public function index()
    {
        // $contacts = Contact::selectRaw('contacts.*, contact_tag.tag_id')->join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id')->get();
        $contacts = Contact::get();
        foreach ($contacts as $key => $value) {
            $value->tags = Contact_tag::selectRaw('tag_id')->whereContact_id($value->id)->get();
        }
        $agents = User::selectRaw('name, id')->where('role_id','=',3)->orWhere('role_id','=',1)->get();
        $tags = Tag::selectRaw('tags.id, tags.name, group_tags.name AS group_name')
        ->join('group_tags', 'tags.group_tag_id', '=', 'group_tags.id')->get();
        return response()->json([
            'contacts' => $contacts,
            'total' => count($contacts),
            'agents' => $agents,
            'tags' => $tags,
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
        
        $contact = new Contact();
        $contact->name = $request->name; 
        $contact->email = $request->email; 
        $contact->phone_1 = $request->phone_1; 
        $contact->phone_2 = $request->phone_2; 
        $contact->direction = $request->direction; 
        $contact->province = $request->province;
        $contact->user_id =  auth()->id(); 
        $contact->save(); 

        if (count($request->tags) > 0) {
            foreach ($request->tags as $key => $value) {
                $tag = new Contact_tag();
                $tag->contact_id = $contact->id;
                $tag->tag_id = $value;
                $tag->save();
            }
        }

        return response()->json("success");
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
        $contact = Contact::find($id);
        $contact->name = $request->name; 
        $contact->email = $request->email; 
        $contact->phone_1 = $request->phone_1; 
        $contact->phone_2 = $request->phone_2; 
        $contact->direction = $request->direction; 
        $contact->province = $request->province;
        $contact->user_id = $request->user_id; 
        $contact->save(); 

        if (count($request->tags) > 0) {
            $deleteTags= Contact_tag::where('contact_id', $id)->delete();

            foreach ($request->tags as $key => $value) {
                $tag = new Contact_tag();
                $tag->contact_id = $contact->id;
                $tag->tag_id = $value;
                $tag->save();
            }
        }

        return response()->json("success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id)->delete();

        return response()->json("success", 200);
    }

    public function view()
    {
        $rol=User::find(auth()->id())->role_id;
        // dd($contacts);
        return view('contacts', compact('rol'));
    }
}
