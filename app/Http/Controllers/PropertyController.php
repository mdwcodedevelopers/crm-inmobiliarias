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
use App\Fav_property;

use Auth;
use Datetime;

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
        //HISTÓRICO
        if (!is_null(Auth::user())) {
            saveReport(9, 1, 1, "Se visualizo la lista de Propiedades.");
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
        //HISTÓRICO
        saveReport(9, 1, 1, "Se visualizo la lista de Propiedades.");

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
        $property->currency_id = $request->currency_id;
        $property->title = $request->title;
        $property->information = $request->information;
        $property->province = $request->province;
        $property->type = $request->type;
        $property->price = $request->price;
        $property->save();

        //HISTÓRICO
        saveReport(10, 1, 1, "Estatus: ".statusToString($property->status_id).". Moneda: ".currenciesToString($property->currency_id).". Título: ".$property->title.". Tipo de Propiedad: ".types()[$property->type-1]["name"].". Precio: ".$property->price, $property->id);
    }

    public function edit($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images')->first();

        $reports = Report::where('property_id', $id)->with('User')->get();

        foreach ($reports as $key => $report):
          $date1 = new DateTime( date('Y-m-d H:i', strtotime($report->created_at)) );
          $date2 = new DateTime( date("Y-m-d H:i") );
          $diff = $date1->diff($date2);
          $report->created = date('d/m/Y H:i', strtotime($report->created_at));
          $report->diff = 'hace ' . ($diff->d > 0 ? $diff->d.' días ' : '' ) . ($diff->h > 0 ? $diff->h.' horas ' : '') . ($diff->i > 0 ? $diff->i.' minutos ' : '');
        endforeach;

        //HISTÓRICO
        saveReport(11, 1, 1, "Se vizualizo formulario de editar propiedad", $property->id);

        return response()->json([
            'property' => $property,
            'reports' => $reports,
            'envs' => Environment::where('type','1')->get(),
            'env' => $property->EnvsOne(),
            'services' => Service::get(),
            'service' => $property->Services->pluck("service_id"),
            'extras' => Environment::where('type','2')->get(),
            'extra' => $property->EnvsTwo(),
            'imagen' => $property->ImagePrincipal(),
        ]);

    }
   public function show($id){
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images','Environments','Services')->first();

        //HISTÓRICO
        saveReport(11, 1, 1, "Se vizualizo formulario de editar propiedad", $property->id);

        return response()->json([
            'property' => $property,
        ]);
    }
    public function update(Request $request, $id)
    {
        $property = Property::find($request->id);
        $property->status_id = $request->prop["status_id"];
        $property->currency_id = $request->prop["currency_id"];
        $property->title = $request->prop["title"];
        $property->information = $request->prop["information"];
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
        //SERVICIOS
        $services = $request->services;
        //ADICIONALES
        $extras = $request->extras;


        Environment_property::where('property_id',$property->id)->whereNotIn("environment_id",array_merge($environments,$services))->delete();

        foreach( $environments as $env_id ):
            $environment = Environment_property::where('property_id',$property->id)->where('environment_id',$env_id)->first();

            if( !isset($environment->id) ):
                $environment = new Environment_property();
                $environment->property_id = $property->id;
                $environment->environment_id = $env_id;
                $environment->save();
            endif;
        endforeach;


        Service_property::where('property_id',$property->id)->whereNotIn("service_id",$services)->delete();

        foreach( $services as $service_id ):
            $service = Service_property::where('property_id',$property->id)->where('service_id',$service_id)->first();

            if( !isset($service->id) ):
                $service = new Service_property();
                $service->property_id = $property->id;
                $service->service_id = $service_id;
                $service->save();
            endif;
        endforeach;


        foreach( $extras as $env_id ):
            $environment = Environment_property::where('property_id',$property->id)->where('environment_id',$env_id)->first();

            if( !isset($environment->id) ):
                $environment = new Environment_property();
                $environment->property_id = $property->id;
                $environment->environment_id = $env_id;
                $environment->save();
            endif;
        endforeach;

        //HISTÓRICO
        saveReport(12, 1, 1, "Estatus: ".statusToString($property->status_id).". Moneda: ".currenciesToString($property->currency_id).". Título: ".$property->title.". Tipo de Propiedad: ".types()[$property->type-1]["name"].". Precio: ".$property->price.". Provincia: ".$property->province.". Ubicación: ".$property->location.". Dimensión: ".$property->dimension.". Cantidad de Ambientes: ".$property->environments.". Plantas: ".$property->plants.". Baños: ".$property->bedrooms.". Toilettes: ".$property->toilettes.". Tocadores: ".$property->dresser.". Chocheras: ".$property->chocheras.". Ambientes: ".envsToString($environments).". Servicios: ".servicesToString($services).". Extras: ".envsToString($extras), $property->id);

        return response()->json("success");
    }

    public function property($id)
    {
        $property = Property::where('id',$id)->with('Status','Currency','Categories','Images','Environments','Services')->first();
        $property->price = number_format($property->price, 2, ',', '.');
        $property->dimension = number_format($property->dimension, 2, ',', '.');
   
        if (!is_null(Auth::user())) {
            $user = User::find(Auth::user()->id);
            $property->favorite =  Fav_property::whereUser_id(Auth::user()->id)->whereProperty_id($property->id)->get()->count();
            return view('property', ['property' => $property, 'rol' => $user->role_id]);
        } else {
            $property->favorite =  0;
            return view('property', ['property' => $property, 'rol' => 0]);
        }

    }

    public function destroy($id)
    {
        $property = Property::where('id', $id)->first();

        //HISTÓRICO
        saveReport(13, 1, 1, "Estatus: ".statusToString($property->status_id).". Moneda: ".currenciesToString($property->currency_id).". Título: ".$property->title.". Tipo de Propiedad: ".types()[$property->type]["name"].". Precio: ".$property->price.". Provincia: ".$property->province.". Ubicación: ".$property->location.". Dimensión: ".$property->dimension.". Cantidad de Ambientes: ".$property->environments.". Plantas: ".$property->plants.". Baños: ".$property->bedrooms.". Toilettes: ".$property->toilettes.". Tocadores: ".$property->dresser.". Chocheras: ".$property->chocheras, $property->id);

        $property->delete();


        return response()->json("success", 200);
    }

    public function web(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';
    
        if (!is_null(Auth::user())) {
            $user = User::find(Auth::user()->id);
            return view('properties-web', ['rol' => $user->role_id]);
        } else {
            return view('properties-web', ['rol' => 0]);
        }
    }

    public function recomended(Request $request)
    {
        $properties = Property::where('id',"!=",$request->not)->get()->random(1);
        foreach ($properties as $property) {
            if (Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first() != null) {
                $property->image = Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
            }else{
                $property->image = null;
            }
        }
        return response()->json([
            'properties' => $properties,
        ]);
    }

  
}
