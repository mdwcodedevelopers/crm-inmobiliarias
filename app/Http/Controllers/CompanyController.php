<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Company;
use App\Report;
use App\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $company = Company::where('id', '=', '1')->first();
        return response()->json([
            'company' => $company,
        ]);
    }
    public function update(Request $request, $id)
    {
        $compan = Company::where('id','=','1')->first();
        $company = Company::find(1);
        $company->update([
            'name' => $request['name'],
            'information' => $request['information']
        ]);
        Report::create([
            'type'=>'Actualizacion',
            'table'=>'Compañia',
            'information'=>'Se cambio el nombre de '.$compan->name.' a: '.$request['name'].' y la información de: '.$compan->information.' a: '.$request['information']
        ]);
        return response()->json("success", 200);
    }
    public function setimage(Request $request)
    {
        $company = Company::find(1);
        if ($request['imagen'] != null) {
            $file = $request->file('imagen');
            $extension = $file->getClientOriginalExtension();
            Storage::put('public/images/' . $file->getFilename() . '.' . $extension,  File::get($file));
            $image_path = './storage' . '/images/' . $file->getFilename() . '.' . $extension;

            $company->update([
                'image_url' => $image_path
            ]);
            Report::create([
                'type'=>'Actualizacion',
                'table'=>'Compañia',
                'information'=>'Se cambio la imagen de la empresa'
            ]);
        }
    }
    public function view()
    {
        if ($user = User::find(auth()->id())) {
            return view('company', ['rol' => $user->role_id]);
        } else {
            return view('welcome');
        }
    }
}
