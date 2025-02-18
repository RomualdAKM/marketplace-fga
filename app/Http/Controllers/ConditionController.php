<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConditionController extends Controller
{
    public function edit_condition(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'shop_id' => 'required|exists:shops,id'
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
    
        $condition = Condition::where('shop_id', $request->shop_id)->first();

        if ($condition) {
            $condition->title = $request->title;
            $condition->description = $request->description;
            $condition->shop_id = $request->shop_id;
            $condition->save();
        } else {
           $condition = new Condition();
           $condition->title = $request->title;
           $condition->description = $request->description;
           $condition->shop_id = $request->shop_id;
           $condition->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'success'
        ], 200);
    }

    public function get_condition(Request $request){
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $condition = Condition::where('shop_id', $request->shop_id)->first();
        return response()->json([
            'success' => true,
            'data' => $condition
        ], 200);
    }
}
