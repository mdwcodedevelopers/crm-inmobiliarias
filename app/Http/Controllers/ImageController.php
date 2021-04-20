<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Property;
use Illuminate\Http\Request;

class ImageController extends Controller
{


    public function index(Request $request)
    {
        $images = Image::where('property_id', $request->id)->get();

        return response()->json(['images'=> $images]);
    }

    public function store(Request $request)
    {

        try
        {
          $extension = mb_strtolower($request->file('image')->getClientOriginalExtension());
          $fileName = uniqid().'.'.$extension;
          $path = "images/properties/";

          if (\Request::file('image')->isValid()){
            $request->file('image')->move($path, $fileName);
          }
        }
        catch (Exception $e) {
          \File::delete($path."/".$fileName);
          return redirect()->back()->withErrors($e->getMessage())->withInput($request->input());
        }


        $image = new Image();
        $image->url = $path . $fileName;
        $image->property_id = $request->property_id;
        $image->save();


        return response()->json("success", 200);
    }


    public function setImage(Request $request, $id)
    {
        $property = Property::find($id);

        $property->update([
            'image' => $request['image']
        ]);

        return response()->json("success");
    }


    public function getImage(Request $request, $id)
    {
        $property = Property::find($id);

        return response()->json(
            'image' => $property->Images->first(),
        );
    }

    public function update(Request $request, $id)
    {

        try
        {
          $extension = mb_strtolower($request->file('image')->getClientOriginalExtension());
          $fileName = uniqid().'.'.$extension;
          $path = "images/properties/";

          if (\Request::file('image')->isValid()){
            $request->file('image')->move($path, $fileName);
          }
        }
        catch (Exception $e) {
          \File::delete($path."/".$fileName);
          return redirect()->back()->withErrors($e->getMessage())->withInput($request->input());
        }


        $image = Image::find($id);
        $image->url = $path . $fileName;
        $image->property_id = $request->property_id;
        $image->save();

        return response()->json("success", 200);
    }


    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();

        return response()->json("success", 200);
    }


    public function Images($id)
    {
        $images = Image::where('property_id', $request->id)->get();

        return view('images_property', ['images'=> $images]);
    }
}
