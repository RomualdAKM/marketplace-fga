<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function save_category(Request $request){
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
    
        $imagePath = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imagePath;
        $category->shop_id = $request->shop_id;
        $category->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Succés'
        ], 200);
    }
    
    public function update_category(Request $request, $id){
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
    
        $imagePath = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;
        
        $category = Category::where('id', $id)
            ->where('shop_id', $request->shop_id)
            ->firstOrFail();
            
        $category->name = $request->name;
        $category->description = $request->description;
        if($imagePath){
            $category->image = $imagePath;
        }
        $category->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Succés'
        ], 200);
    }
    
    public function get_categories(Request $request){
        $categories = Category::where('shop_id', $request->shop_id)
            ->withCount('products')
            ->get()
            ->toArray();
    
        return $categories;
    }
    
    public function get_category($id, Request $request){
        $category = Category::where('id', $id)
            ->where('shop_id', $request->shop_id)
            ->firstOrFail();
    
        return $category;
    }

    public function delete_category($id, Request $request){
        $category = Category::where('id', $id)
            ->where('shop_id', $request->shop_id)
            ->firstOrFail();
    
        $category->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Supprimé avec succès'
        ], 200);
    }
}
