<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confidentiality;
use Illuminate\Support\Facades\Validator;

class ConfidentialityController extends Controller
{
    public function edit_confidentiality(Request $request){

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
    
        $confidentiality = Confidentiality::find('1');

        

        if ($confidentiality) {
            $confidentiality->title = $request->title;
            $confidentiality->description = $request->description;
            $confidentiality->save();
        } else {
           $confidentiality = new Confidentiality();
           $confidentiality->title = $request->title;
            $confidentiality->description = $request->description;
           $confidentiality->save();

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

    public function get_confidentiality(){

        $confidentiality = Confidentiality::first();

        return $confidentiality;
    }
}
