<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function save_banner(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',  
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }
    
        $imagePath = $request->file('image') ? $request->file('image')->store('banners', 'public') : null;

        $banner = new Banner();
        $banner->name =  $request->name;
        $banner->description = $request->description;
        $banner->image =  $imagePath;
    
        $banner->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function update_banner(Request $request,$id){
    
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',  
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }
    
        $imagePath = $request->file('image') ? $request->file('image')->store('banners', 'public') : null;

        
        $banner = Banner::find($id);
        $banner->name =  $request->name;
        $banner->description = $request->description;
        if($imagePath){
            $banner->image =  $imagePath;
        }
        $banner->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function get_banners(){
    
        $banners = Banner::all();
    
        return $banners;
    
       }
    
       public function get_banner($id){
    
        $banner = Banner::find($id);
    
        return $banner;
    
    
       }
       public function delete_banner($id){
    
        $banner = Banner::find($id);
    
        $banner->delete();
    
       }

}
