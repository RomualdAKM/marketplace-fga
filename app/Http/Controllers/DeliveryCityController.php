<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryCityController extends Controller
{
    public function save_city(Request $request){

        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
            'city_price' => 'required',
            'country_id' => 'required',
           
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
      

        $city = new DeliveryCity();
        $city->city_name =  $request->city_name;
        $city->city_price =  $request->city_price;
        $city->delivery_country_id =  $request->country_id;
      
        $city->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function update_city(Request $request,$id){
    
        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
            'city_price' => 'required',
            'delivery_country_id' => 'required',
         
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
        
        $city = DeliveryCity::find($id);
        $city->city_name =  $request->city_name;
        $city->city_price =  $request->city_price;
        $city->delivery_country_id =  $request->delivery_country_id;
        $city->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
    
       public function get_cities(){
    
        $cities = DeliveryCity::with('country')->get();
    
        return $cities;
    
       }
    
       public function get_city($id){
    
        $city = Deliverycity::find($id);
    
        return $city;
    
    
       }
       public function delete_city($id){
    
        $city = DeliveryCity::find($id);
    
        $city->delete();
    
       }

       public function get_cities_by_country($country_id){
        $cities = DeliveryCity::where('delivery_country_id',$country_id)->get();
        return $cities;
       }


}
