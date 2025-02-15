<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConditionController extends Controller
{
    public function edit_condition(Request $request){

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',          
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
    
        $condition = Condition::find('1');

        

        if ($condition) {
            $condition->title = $request->title;
            $condition->description = $request->description;
            $condition->save();
        } else {
           $condition = new Condition();
           $condition->title = $request->title;
            $condition->description = $request->description;
           $condition->save();

        }

        $response = [
            'success' => true,
            'message' => 'success'
        ];

        return response()->json(
            $response,
            200
        );

    }

    public function get_condition(){

        $condition = Condition::first();

        return $condition;
    }

}
