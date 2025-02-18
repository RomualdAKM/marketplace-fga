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
            'store_id' => 'required|exists:stores,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $country = new DeliveryCountry();
        $country->country_name = $request->country_name;
        $country->store_id = $request->store_id;
        $country->save();

        return response()->json([
            'success' => true,
            'message' => 'Succès'
        ], 200);
    }

    public function update_country(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'country_name' => 'required',
            'store_id' => 'required|exists:stores,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $country = DeliveryCountry::find($id);
        $country->country_name = $request->country_name;
        $country->store_id = $request->store_id;
        $country->save();

        return response()->json([
            'success' => true,
            'message' => 'Succès'
        ], 200);
    }

    public function get_countries($store_id){
        $countries = DeliveryCountry::where('store_id', $store_id)->get();
        return response()->json($countries);
    }

    public function get_country($id){
        $country = DeliveryCountry::find($id);
        return response()->json($country);
    }

    public function delete_country($id){
        $country = DeliveryCountry::find($id);
        $country->delete();
        return response()->json([
            'success' => true,
            'message' => 'Supprimé avec succès'
        ]);
    }
}
