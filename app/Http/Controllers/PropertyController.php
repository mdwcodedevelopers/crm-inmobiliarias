<?php

namespace App\Http\Controllers;

use App\User;
use App\Currency;
use App\Property;
use App\Report;
use App\Status;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('title', 'LIKE', "%$search%")
            // ->where('information','LIKE',"%$search%")
            ->join('properties', 'properties.status_id', 'status.id')->paginate(9);
        $total = Property::count();

        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
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
        $status = Status::get();
        $currency = Currency::get();
        $Properties = Status::orderBy('properties.updated_at', 'desc')->where('user_id', auth()->id())->join('properties', 'properties.status_id', 'status.id')
            ->select('properties.id', 'properties.information', 'properties.title', 'properties.price', 'properties.dimension', 'status.status', 'users.name', 'currency.currency')
            ->get();
        $total = Property::count();
        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'status' => $status,
            'currency' => $currency
        ]);
    }
    public function propertiesAdmin(Request $request)
    {
        $status = Status::get();
        $currency = Currency::get();
        $Properties = Property::join('status', 'properties.status_id', 'status.id')
            ->join('users', 'properties.user_id', 'users.id')
            ->join('currency', 'currency.id', 'properties.currency_id')
            // ->join('images','images.property_id','properties.currency_id')
            ->select('properties.id', 'properties.information', 'properties.title', 'properties.price', 'properties.dimension', 'status.status', 'users.name', 'currency.currency', 'properties.image')->get();
        $total = Property::count();
        return response()->json([
            'Properties' => $Properties,
            'total' => $total,
            'status' => $status,
            'currency' => $currency
        ]);
    }
    public function store(Request $request)
    {
        Property::create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'information' => $request['information'],
            'price' => $request['price'],
            'dimension' => $request['dimension'],
            'status_id' => $request['status'],
            'city' => 1,
            'currency_id' => $request['currency_id'],
            'image' => ''
        ]);
        Report::create([
            'type' => 'Creación',
            'table' => 'Propiedad',
            'information' => 'Se creo la propiedad: ' . $request['title'] . ' con la información' . $request['information'] . ' dimensiones: ' . $request['dimension'] . ' precio: ' . $request['price']
        ]);
    }
    public function update(Request $request, $id)
    {
        $prop = Property::where('id', '=', "$id")->first();
        $property = Property::find($id);
        $property->update([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'information' => $request['information'],
            'price' => $request['price'],
            'dimension' => $request['dimension'],
            'status_id' => $request['status'],
            'city' => 1,
            'currency_id' => $request['currency_id']
        ]);
        Report::create([
            'type' => 'Actualización',
            'table' => 'Propiedad',
            'information' => 'Se actualizó la propiedad: ' . $prop->title . ' a ' . $request['title'] . ' con la información ' . $prop->information . ' a ' . $request['information'] . ' dimensiones anteriores:' . $prop->dimension . ' dimensiones nuevas: ' . $request['dimension'] . ' precio anterior: ' . $prop->precio . ' precio nuevo: ' . $request['price']
        ]);
        return response()->json("success");
    }
    public function property($id)
    {
 
        $property = Status::orderBy('properties.updated_at', 'desc')->where('properties.id', '=', "$id")
            ->join('properties', 'properties.status_id', 'status.id')->first();
        if ($user = User::find(auth()->id())) {
            return view('property', ['property' => $property, 'rol' => $user->rol_id]);
        } else {
            return view('property', ['property' => $property, 'rol' => 0]);
        }
        $property->image= Image::select('url_image')->whereProperty_id($property->id)->get();
        return view('property',['property'=>$property,'rol'=>$user->rol_id]);
    }
    public function destroy($id)
    {
        $prop = Property::where('id', '=', "$id")->first();
        $property = Property::find($id);

        $property->delete();
        Report::create([
            'type' => 'Eliminación',
            'table' => 'Propiedad',
            'information' => 'Se eliminó la propiedad: ' . $prop->title . ' con la información ' . $prop->information . ' dimensiones:' . $prop->dimension . '  precio: ' . $prop->precio
        ]);
        return response()->json("success", 200);
    }
}
