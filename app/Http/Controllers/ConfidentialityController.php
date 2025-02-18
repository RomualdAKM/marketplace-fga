<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confidentiality;
use Illuminate\Support\Facades\Validator;

class ConfidentialityController extends Controller
{
    public function edit_confidentiality(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'shop_id' => 'required|exists:shops,id'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }
    
        $confidentiality = Confidentiality::where('shop_id', $request->shop_id)->first();

        if ($confidentiality) {
            $confidentiality->title = $request->title;
            $confidentiality->description = $request->description;
            $confidentiality->shop_id = $request->shop_id;
            $confidentiality->save();
        } else {
            $confidentiality = Confidentiality::create([
                'title' => $request->title,
                'description' => $request->description,
                'shop_id' => $request->shop_id
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'success'
        ], 200);
    }

    public function get_confidentiality(Request $request){
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $confidentiality = Confidentiality::where('shop_id', $request->shop_id)->first();
        return response()->json([
            'success' => true,
            'data' => $confidentiality
        ], 200);
    }
}
