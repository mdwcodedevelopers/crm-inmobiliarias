<?php

namespace App\Http\Controllers;

use App\Oportunity;
use App\StatusOportunity;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {   
        // $search = isset($request->search) ? $request->search : "";

        
        $oportunities = Oportunity::selectRaw('oportunities.id, oportunities.name, oportunities.vigency, oportunities.updated_at,  contacts.name AS contact, contacts.tel_1 AS tel_1,
          contacts.tel_2 AS tel_2, contacts.email AS email, contacts.img_path AS img_contact, status_oportunities.name AS status, users.name AS user' )
        ->join('contacts', 'oportunities.contact_id', '=', 'contacts.id')
        ->join('users', 'oportunities.user_id', '=', 'users.id')
        ->join('status_oportunities', 'oportunities.status_id', '=', 'status_oportunities.id')->get();
        // ->where('traceabilities.status', '1')->whereNotNull('traceabilities.warehouse_return');

        // if( $search!= "" ):
        //     $employees = $employees->where('position', $search);
        // endif;

        // $oportunities = Oportunity::get();
        // return view('oportunities', compact('oportunities','search'));;
        return view('oportunities', compact('oportunities'));;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
