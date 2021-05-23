<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider_home;

class SliderHomeController extends Controller
{
    public function index(){
        $slider= Slider_home::get();
        
        return response()->json([
            'sliders' => $slider,
            ]); 
        }
    public function store(Request $request){
            
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name=$file->getClientOriginalName();
            $file->move( 'images/', $file->getClientOriginalName());

            $slide = new Slider_home();
            $slide->image = '/images/'.$name;
            $slide->url = $request->url;
            $slide->title = $request->title;
            $slide->subtitle = $request->subtitle;
            $slide->button = $request->button;
            $slide->save();

            return response()->json("success", 200);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $slide = Slider_home::find($id);
        $slide->url = $request->url;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->button = $request->button;
        $slide->save();
        return response()->json("success", 200);

    }
    public function destroy($id){
        $slide = Slider_home::find($id);
        $file_old= public_path(). $slide->image;
        $slide->delete();
        unlink($file_old);
        return response()->json("success", 200);
    }
}
