<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(Request $request){
        $categorie = Categorie::get();
        return response()->json([
            'categorie' => $categorie,
        ]);
    }
    public function store(Request $request)
    {
        Categorie::create([
            'name'=>$request['name']
        ]);
    }
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->update([
            'name'=>$request['name']
        ]);
        return response()->json("success", 200);
    }
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        return response()->json("success", 200);
    }
    public function categories(){
        return view('categories');
    }
}
