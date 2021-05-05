<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupTag;
use App\Tag;
use App\User;
use App\Contact_tag;
use App\Contact;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index(){
        $groups = GroupTag::selectRaw('id, name')->get();
        $tags = Tag::selectRaw('id, name, group_tag_id')->get();
        foreach ($tags as $key => $value) {
            $value->count = Contact_tag::whereTag_id($value->id)->count();
        }
        return response()->json([
            'groups' => $groups,
            'tags' => $tags,
    ]);
    }
    
    public function view(){
        // $groups = GroupTag::selectRaw('group_tags.id As group_id, group_tags.name As groupName, tags.id, tags.name As tagName')
        // ->join('tags', 'tags.group_id', 'group_tags.id')->get();
        $rol=User::find(auth()->id())->role_id;

        // foreach ($tags as $key => $value) {
        //     $value->count = Contact::whereTagId($value->id)->count();
        // }

        return view('tags',compact('rol'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $tag = new Tag();
        $tag->name = $request->name; 
        $tag->group_tag_id = $request->group_tag_id; 
        $tag->save(); 

        return response()->json("success");
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
        $tag = Tag::find($id);
        $tag->name = $request->name; 
        $tag->group_tag_id = $request->group_tag_id; 
        $tag->save(); 

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
        $tag = Tag::find($id)->delete();

        return response()->json("success", 200);
    }

}
