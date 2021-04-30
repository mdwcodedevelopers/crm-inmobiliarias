<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Property;
use Illuminate\Http\Request;
use Auth;

class ImageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request){
        $id=$request->id;
        $images= Image::where('property_id','=',$id)->get();
        return response()->json(['images'=>$images]);
    }
    public function store(Request $request)
    {

        if($request->imagen != null){
            $file = $request->file('imagen');
            $path = 'images/properties/user_'. auth()->id() . '/';
            $file->move( $path, $file->getClientOriginalName());
            
            $image = new Image();
            
            $image->url =$path.$file->getClientOriginalName();
            $image->property_id = $request->property_id;
            $image->save();
            // $file = $request->file('imagen');
            // $extension = $file->getClientOriginalExtension();
            // Storage::put('public/images/'.$file->getFilename().'.'.$extension,  File::get($file));
            // $image_path='./storage'.'/images/'.$file->getFilename().'.'.$extension;
            // Image::create([
            //     'property_id'=>$request['property_id'],
            //     'url_image'=>$image_path
            // ]);
        }
    }
    public function setimage(Request $request,$id){
        $image = Image::find($id);
        if(Image::whereProperty_id($image->property_id)->wherePrincipal(1)->first()!=null){
            $oldImage =Image::whereProperty_id($image->property_id)->wherePrincipal(1)->first();
            $oldImage->principal = 0;
            $oldImage->save();
        }
        $image->principal = $request->principal;
        $image->save();

        return response()->json("success");
    }
    public function update(Request $request, $id)
    {

        if($request['image']!=null){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            Storage::put('clients/'.$file->getFilename().'.'.$extension,  File::get($file));
            $image_path=env('APP_URL').'storage'.'/images/'.$file->getFilename().'.'.$extension;
        }
        $image = Image::find($id);
        $image->update([
            'property_id'=>$request['property_id'],
            'url_image'=>$image_path
        ]);
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
        // $property= Property::where('id','=',$id)->first();
        $properties = Property::selectRaw('properties.*, status.name status, users.name user, currencies.name currency')
        ->join('status', 'properties.status_id', 'status.id')
        ->join('users', 'properties.user_id', 'users.id')
        ->join('currencies', 'properties.currency_id', 'currencies.id')
        ->where('properties.user_id', Auth::user()->id)
        ->get();
        foreach ($properties as $property) {
            dd();
            $property->image = Image::select('url')->whereProperty_id($property->id)->wherePrincipal(1)->first()->url;
        }
        return view('images_property',['property'=>$property,'id'=>$id]);
    }
}