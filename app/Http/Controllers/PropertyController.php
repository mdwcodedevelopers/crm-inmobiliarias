<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Environment;
use App\Environment_property;
use App\Service_property;
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
            if (Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first() != null) {
                $property->image = Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
            }else{
                $property->image = null;
            }
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
        foreach ($properties as $property) {
            if (Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first() != null) {
                $property->image = Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
            }else{
                $property->image = null;
            }
        }
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

        $property = new Property();
        $property->user_id = Auth::user()->id;
        $property->status_id = $request->status_id;
        $property->currency_id = $request->currency;
        $property->title = $request->title;
        $property->province = $request->province;
        $property->type = $request->type;
        $property->price = $request->price;
        $property->save();

        Report::create([
            'type' => 'Creación',
            'table' => 'Propiedad',
            'information' => 'Se creo la propiedad: ID#' . $property->id . " " . $request->title,
        ]);
    }

    public function edit($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images')->first();

        return response()->json([
            'property' => $property,
            'envs' => Environment::where('type','1')->get(),
            'env' => $property->EnvsOne(),
            'services' => Service::get(),
            'service' => $property->Services->pluck("service_id"),
            'extras' => Environment::where('type','2')->get(),
            'extra' => $property->EnvsTwo(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $property = Property::find($request->id);
        $property->status_id = $request->prop["status_id"];
        $property->currency_id = $request->prop["currency_id"];
        $property->title = $request->prop["title"];
        $property->province = $request->prop["province"];
        $property->location = $request->prop["location"];
        $property->subdivision_1 = $request->prop["subdivision_1"];
        $property->subdivision_2 = $request->prop["subdivision_2"];
        $property->show_web = isset($request->prop["show_web"]) ? "1" : "0";
        $property->type = $request->prop["type"];
        $property->situation = $request->prop["situation"];
        $property->antiquity = $request->prop["antiquity"];
        $property->condition = $request->prop["condition"];
        $property->keys = $request->prop["keys"];
        $property->price = $request->prop["price"];
        $property->dimension = $request->prop["dimension"];
        $property->environments = $request->prop["environments"];
        $property->plants = $request->prop["plants"];
        $property->bedrooms = $request->prop["bedrooms"];
        $property->toilettes = $request->prop["toilettes"];
        $property->dresser = $request->prop["dresser"];
        $property->chocheras = $request->prop["chocheras"];
        $property->save();

        //AMBIENTES
        $environments = $request->envs;

        Environment_property::where('property_id',$property->id)->whereNotIn("environment_id",$environments)->delete();

        foreach( $environments as $env_id ):
            $environment = Environment_property::where('property_id',$property->id)->where('environment_id',$env_id);

            if( !isset($environment->id) ):
                $environment = new Environment_property();
                $environment->property_id = $property->id;
                $environment->environment_id = $env_id;
                $environment->save();
            endif;
        endforeach;

        //SERVICIOS
        $services = $request->services;

        Service_property::where('property_id',$property->id)->whereNotIn("service_id",$services)->delete();

        foreach( $services as $service_id ):
            $service = Service_property::where('property_id',$property->id)->where('service_id',$service_id);

            if( !isset($service->id) ):
                $service = new Service_property();
                $service->property_id = $property->id;
                $service->service_id = $service_id;
                $service->save();
            endif;
        endforeach;

        //ADICIONALES
        $environments = $request->extras;

        foreach( $environments as $env_id ):
            $environment = Environment_property::where('property_id',$property->id)->where('environment_id',$env_id);

            if( !isset($environment->id) ):
                $environment = new Environment_property();
                $environment->property_id = $property->id;
                $environment->environment_id = $env_id;
                $environment->save();
            endif;
        endforeach;

        Report::create([
            'type' => 'Actualización',
            'table' => 'Propiedad',
            'information' => 'Se actualizó la propiedad a: ' . $property->title . ' dimensiones nuevas: ' . $property->dimension . ' precio nuevo: ' . $property->price
        ]);

        return response()->json("success");
    }

    public function property($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images','Environments','Services')->first();
        
        if (!is_null(Auth::user())) {
            $user = User::find(Auth::user()->id);
            return view('property', ['property' => $property, 'rol' => $user->role_id]);
        } else {
            return view('property', ['property' => $property, 'rol' => 0]);
        }

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
