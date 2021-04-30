<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupTag;
use App\Tag;
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
    
    public function view(){
        // $groups = GroupTag::selectRaw('group_tags.id As group_id, group_tags.name As groupName, tags.id, tags.name As tagName')
        // ->join('tags', 'tags.group_id', 'group_tags.id')->get();
        $groups = GroupTag::selectRaw('id, name')->get();
        $tags = Tag::selectRaw('id, name, group_tag_id')->get();

        foreach ($tags as $key => $value) {
            $value->count = Contact::whereTagId($value->id)->count();
        }

        return view('tags',compact('groups','tags'));
    }
}
