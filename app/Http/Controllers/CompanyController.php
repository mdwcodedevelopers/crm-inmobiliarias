<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Company;
use App\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $company = Company::where('id', '=', '1')->first();
        return response()->json([
            'company' => $company,
        ]);
    }
    // public function store(Request $request)
    // {
    //     if($request['imagen']!=null){
    //         $file = $request->file('imagen');
    //         $extension = $file->getClientOriginalExtension();
    //         Storage::put('public/images/'.$file->getFilename().'.'.$extension,  File::get($file));
    //         $image_path='./storage'.'/images/'.$file->getFilename().'.'.$extension;
    //         Company::create([
    //             'name'=>$request['name'],
    //             'information'=>$request['information'],
    //             'image-url'=>$image_path
    //         ]);
    //     }else{
    //     }
    // }
    public function update(Request $request, $id)
    {
        $company = Company::find(1);
        $company->update([
            'name' => $request['name'],
            'information' => $request['information']
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

        }
    }
    public function view()
    {
        if ($user = User::find(auth()->id())) {
            return view('company', ['rol' => $user->rol_id]);
        } else {
            return view('welcome');
        }
    }
}
