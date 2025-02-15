<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryCountry;
use Illuminate\Support\Facades\Validator;

class DeliveryCountryController extends Controller
{
    public function save_country(Request $request){

        $validator = Validator::make($request->all(), [
            'country_name' => 'required',
           
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
      

        $country = new DeliveryCountry();
        $country->country_name =  $request->country_name;
      
        $country->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function update_country(Request $request,$id){
    
        $validator = Validator::make($request->all(), [
            'country_name' => 'required',
         
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
        
        $country = DeliveryCountry::find($id);
        $country->country_name =  $request->country_name;
    
        $country->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function get_countries(){
    
        $countries = DeliveryCountry::all();
    
        return $countries;
    
       }
    
       public function get_country($id){
    
        $country = DeliveryCountry::find($id);
    
        return $country;
    
    
       }
       public function delete_country($id){
    
        $country = DeliveryCountry::find($id);
    
        $country->delete();
    
       }


}
