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
    
        $imagePath = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;

        $category = new Category();
        $category->name =  $request->name;
        $category->description = $request->description;
        $category->image =  $imagePath;
    
        $category->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function update_category(Request $request,$id){
    
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
    
        $imagePath = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;

        
        $category = Category::find($id);
        $category->name =  $request->name;
        $category->description = $request->description;
        if($imagePath){
            $category->image =  $imagePath;
        }
        $category->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function get_categories(){
    
        
        $categories = Category::withCount('products')->get()->toArray();
    
        return $categories;
    
       }
    
       public function get_category($id){
    
        $category = Category::find($id);
    
        return $category;
    
    
       }
       public function delete_category($id){
    
        $category = Category::find($id);
    
        $category->delete();
    
       }
}
