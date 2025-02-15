<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
{
    public function save_code(Request $request){

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'percentage' => 'required',
           
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
      

        $code = new Code();
        $code->code =  $request->code;
        $code->percentage = $request->percentage;
     
        $code->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function update_code(Request $request,$id){
    
        $validator = Validator::make($request->all(), [
            'percentage' => 'required',
            'code' => 'required',
           
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
        
        $code = code::find($id);
        $code->code =  $request->code;
        $code->percentage = $request->percentage;
       
        $code->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function get_codes(){
    
        $codes = Code::all();
    
        return $codes;
    
       }
    
       public function get_code($id){
    
        $code = Code::find($id);
    
        return $code;
    
    
       }
       public function delete_code($id){
    
        $code = Code::find($id);
    
        $code->delete();
    
       }

}
