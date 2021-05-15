<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\StatusOportunity;
use App\GroupTag;
use App\Tag;
use App\Oportunity;
use App\Contact_tag;

use Auth;

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
    public function index(Request $request)
    {
        $contacts = Contact::get();
        $agents = User::selectRaw('name, id')->where('role_id','=',3)->orWhere('role_id','=',1)->get();
        $tags = Tag::selectRaw('tags.id, tags.name, group_tags.name AS group_name')
        ->join('group_tags', 'tags.group_tag_id', '=', 'group_tags.id')->get();
        $oportunities = StatusOportunity::selectRaw('name, id')->get();

        //HISTORIAL
        saveReport(5, 2, 1, "Se visualizo la lista de contactos con Agentes, Etiquetas y Oportunidades.");

        return response()->json([
            'contacts' => $contacts,
            // 'total' => count($contacts),
            'agents' => $agents,
            'oportunities' => $oportunities,
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
        $contact->user_id =  Auth::user()->id;
        $contact->save();

        if (count($request->tags) > 0) {
            foreach ($request->tags as $key => $value) {
                $tag = new Contact_tag();
                $tag->contact_id = $contact->id;
                $tag->tag_id = $value;
                $tag->save();
            }
        }

        //HISTORIAL
        saveReport(2, 2, 1, "Nombre: ".$contact->name.". Email: ".$contact->email.". Teléfono 1: ".$contact->phone_1.". Teléfono 2: ".$contact->phone_2.". Etiquetas: ".tagsToString($request->tags));

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

        //HISTORIAL
        saveReport(1, 2, 1, "Nombre: ".$contact->name.". Email: ".$contact->email.". Teléfono 1: ".$contact->phone_1.". Teléfono 2: ".$contact->phone_2.". Etiquetas: ".tagsToString($request->tags));

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
        $contact = Contact::find($id);

        saveReport(4, 2, 1, "Nombre: ".$contact->name.". Email: ".$contact->email.". Teléfono 1: ".$contact->phone_1.". Teléfono 2: ".$contact->phone_2);

        $contact->delete();

        return response()->json("success", 200);
    }

    public function view(Request $request)
    {
        $rol=User::find(auth()->id())->role_id;
        // dd($contacts);
        return view('contacts', compact('rol'));
    }

    public function search(Request $request)
    {
        $filtro = "";
        $query = Contact::selectRaw('contacts.*');

        ($request->agent == -2 ) ? $query = $query->whereNULL('contacts.user_id') : '';

        if($request->agent > 0):
            $query = $query->where('contacts.user_id',$request->agent);
            $filtro .= "Agente: ".userToString($request->agent).". ";
        endif;

        if($request->oportunity != null):
            $query = $query->join('oportunities', 'oportunities.contact_id', '=', 'contacts.id')->where('oportunities.status_id',$request->oportunity);
            $filtro .= "Oportunidad: ".oportunityToString($request->oportunity).". ";
        endif;

        if($request->tag != null):
            $query = $query->join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id')->where('contact_tag.tag_id',$request->tag);
            $filtro .= "Con la etiqueta: ".tagsToString($request->tag).". ";
        endif;

        if($request->noTag != null):
            $query = $query->join('contact_tag', 'contact_tag.contact_id', '=', 'contacts.id')->where('contact_tag.tag_id','!=',$request->noTag);
            $filtro .= "Sin la etiqueta: ".tagsToString($request->noTag).". ";
        endif;

        $contacts = $query->get();

        foreach ($contacts as $key => $value):
            $value->tags = Contact_tag::selectRaw('tag_id')->whereContact_id($value->id)->get();
        endforeach;

        //HISTORIAL
        saveReport(8, 2, 1, $filtro);

        return response()->json([
            'contacts' => $contacts,
            // 'total' => count($contacts),
    ]);
    }


}

