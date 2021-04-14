<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NoteOportunity;

class NoteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $note = new NoteOportunity;
        $note->title = $request->title;
        $note->description = $request->description;
        $note->oportunity_id = $request->oportunity_id;

        $note->save();

        return $note;
    }

    /**
     * Display the specified notes of users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes = NoteOportunity::where('oportunity_id', $id)->orderByRaw('created_at ASC')->get();
        return $notes;
    }


}
