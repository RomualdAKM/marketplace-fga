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
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $imagePath = $request->file('image') ? $request->file('image')->store('banners', 'public') : null;

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->description = $request->description;
        $banner->image = $imagePath;
        $banner->shop_id = $request->shop_id;
        $banner->save();

        return response()->json([
            'success' => true,
            'message' => 'Succès'
        ], 200);
    }

    public function update_banner(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found'
            ], 404);
        }

        $imagePath = $request->file('image') ? $request->file('image')->store('banners', 'public') : null;

        $banner->name = $request->name;
        $banner->description = $request->description;
        $banner->shop_id = $request->shop_id;
        if($imagePath){
            $banner->image = $imagePath;
        }
        $banner->save();

        return response()->json([
            'success' => true,
            'message' => 'Succès'
        ], 200);
    }

    public function get_banners(){
        $banners = Banner::with('shop')->get();
        return response()->json($banners);
    }

    public function get_banner($id){
        $banner = Banner::with('shop')->find($id);
        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found'
            ], 404);
        }
        return response()->json($banner);
    }

    public function get_shop_banners($shop_id){
        $banners = Banner::where('shop_id', $shop_id)->get();
        return response()->json($banners);
    }

    public function delete_banner($id){
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found'
            ], 404);
        }
        $banner->delete();
        return response()->json([
            'success' => true,
            'message' => 'Banner deleted successfully'
        ], 200);
    }
    }
