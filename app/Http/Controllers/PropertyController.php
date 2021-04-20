<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Environment;
use App\Image;
use App\Currency;
use App\Property;
use App\Report;
use App\Service;
use App\Status;
use App\User;

use Auth;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('show_web',1)->where('title', 'LIKE', "%$search%")->join('properties', 'properties.status_id', 'status.id')->paginate(9);
        foreach ($Properties as $property) {
            $property->image = Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
        }
        return response()->json([
            'properties' => $Properties,
            'total' => count($Properties),
            'pagination' => [
                'total'         => $Properties->total(),
                'current_page'  => $Properties->currentPage(),
                'per_page'      => $Properties->perPage(),
                'last_page'     => $Properties->lastPage(),
                'from'          => $Properties->firstItem(),
                'to'            => $Properties->lastItem(),
            ],
            'search' => $search
        ]);
    }

    public function properties(Request $request)
    {
        $properties = Property::selectRaw('properties.*, status.name status, users.name user, currencies.name currency')
        ->join('status', 'properties.status_id', 'status.id')
        ->join('users', 'properties.user_id', 'users.id')
        ->join('currencies', 'properties.currency_id', 'currencies.id')
        ->where('properties.user_id', Auth::user()->id)
        ->get();

        return response()->json([
            'properties' => $properties,
            'total' => count($properties),
            'status' => Status::get(),
            'currencies' => Currency::get(),
            'types' => types(),
            'situations' => situations(),
            'antiquitys' => antiquity(),
            'conditions' => conditions(),
            'locations' => locationsKeys()
        ]);
    }

    public function propertiesAdmin(Request $request)
    {
        $properties = Property::selectRaw('properties.*, status.name status, users.name user, currencies.name currency')
        ->join('status', 'properties.status_id', 'status.id')
        ->join('users', 'properties.user_id', 'users.id')
        ->join('currencies', 'properties.currency_id', 'currencies.id')
        ->where('images.principal', 1)
        ->get();

        return response()->json([
            'Properties' => $properties,
            'total' => count($properties),
            'status' => Status::get(),
            'currencies' => Currency::get(),
            'types' => types(),
            'situations' => situations(),
            'antiquitys' => antiquity(),
            'conditions' => conditions(),
            'locations' => locationsKeys()
        ]);
    }

    public function store(Request $request)
    {

        $property = Property::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'type' => $request->type,
            'province' => $request->province,
            'price' => $request->price,
            'currency_id' => $request->currency,
            'status_id' => $request->status_id,
        ]);

        Report::create([
            'type' => 'Creación',
            'table' => 'Propiedad',
            'information' => 'Se creo la propiedad: ID#' . $property->id . " " . $request->title,
        ]);
    }

    public function edit($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images','Environments','Services')->first();

        return response()->json([
            'property' => $property,
            'envs' => Environment::where('type','1')->get(),
            'services' => Service::get(),
            'extras' => Environment::where('type','2')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        /*
array:33 [

  "environments" => array:2 [
    0 => 2
    1 => 6
  ]
  "services" => array:2 [
    0 => 2
    1 => 6
  ]
  "extras" => 24
]

         */

        $property = Property::find($request->id);
        $property->status_id = $request->status_id;
        $property->currency_id = $request->currency;
        $property->title = $request->title;
        $property->province = $request->province;
        $property->location = $request->location;
        $property->subdivision_1 = $request->subdivision_1;
        $property->subdivision_2 = $request->subdivision_2;
        $property->show_web = $request->show_web;
        $property->type = $request->type;
        $property->situation = $request->situation;
        $property->antiquity = $request->antiquity;
        $property->condition = $request->condition;
        $property->keys = $request->key;
        $property->price = $request->price;
        $property->dimension = $request->dimension;
        $property->environments = $request->environments;
        $property->plants = $request->plants;
        $property->bedrooms = $request->bedrooms;
        $property->toilettes = $request->toilettes;
        $property->dresser = $request->dresser;
        $property->chocheras = $request->chocheras;
        $property->save();


        Environment_property::where('property_id',$property->id)->whereNotIn("environment_id",$environments)->delete();

        $envs = Environment_property::where('property_id',$property->id)->whereIn("environment_id",$environments)->get();

        for ( $i = 0; $i < count($request->environments); $i++ ):
        endfor;

        Report::create([
            'type' => 'Actualización',
            'table' => 'Propiedad',
            'information' => 'Se actualizó la propiedad: ' . $prop->title . ' a ' . $request['title'] . ' con la información ' . $prop->information . ' a ' . $request['information'] . ' dimensiones anteriores:' . $prop->dimension . ' dimensiones nuevas: ' . $request['dimension'] . ' precio anterior: ' . $prop->precio . ' precio nuevo: ' . $request['price']
        ]);

        return response()->json("success");
    }

    public function property($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images','Environments','Services')->first();
        
        // $property = Status::orderBy('properties.updated_at', 'desc')->where('properties.id', '=', "$id")
        //     ->join('properties', 'properties.status_id', 'status.id')->first();
        //     $property->image= Image::select('url')->whereProperty_id($property->id)->get();
        if (!is_null(Auth::user())) {
            $user = User::find(Auth::user()->id);
            return view('property', ['property' => $property, 'rol' => $user->role_id, 'types' => types()]);
        } else {
            return view('property', ['property' => $property, 'rol' => 0, 'types' => types(),]);
        }
        return view('property',['property'=>$property,'rol'=>$user->role_id, 'types' => types(),]);

    }

    public function destroy($id)
    {
        $prop = Property::where('id', '=', "$id")->first();

        $property = Property::find($id)->delete();

        Report::create([
            'type' => 'Eliminación',
            'table' => 'Propiedad',
            'information' => 'Se eliminó la propiedad: ID#' . $id . " " . $prop->title . ' con la información ' . $prop->information . ' dimensiones:' . $prop->dimension . '  precio: ' . $prop->precio
        ]);

        return response()->json("success", 200);
    }
}
