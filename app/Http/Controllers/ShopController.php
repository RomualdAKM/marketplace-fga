<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function edit_shop(Request $request){

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'description' => 'required',
            'logo' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'devise' => 'required',
           
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
    
        $shop = Shop::find('1');

        $photoPath = $request->file('logo') ? $request->file('logo')->store('logo', 'public') : null;
        

        if ($shop) {
            $shop->name = $request->name;
            $shop->address = $request->address;
            $shop->phone = $request->phone;
            $shop->email = $request->email;
            $shop->devise = $request->devise;
            $shop->youtube_link = $request->youtube_link;
            $shop->instagram_link = $request->instagram_link;
            $shop->tiktok_link = $request->tiktok_link;
            $shop->facebook_link = $request->facebook_link;
            $shop->description = $request->description;

            if($photoPath){

                $shop->logo = $photoPath;

            }
            
            $shop->save();
        } else {
           $shop = new Shop();
           $shop->name = $request->name;
           $shop->address = $request->address;
           $shop->phone = $request->phone;
           $shop->email = $request->email;
           $shop->devise = $request->devise;
           $shop->youtube_link = $request->youtube_link;
           $shop->instagram_link = $request->instagram_link;
           $shop->tiktok_link = $request->tiktok_link;
           $shop->facebook_link = $request->facebook_link;
           $shop->description = $request->description;
          
           $shop->logo = $photoPath;
           
           $shop->save();

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

    public function get_shop(){

        $shop = Shop::first();

        return $shop;
    }

    public function info_shop(){

        $shop = Shop::first();

        return view('welcome',compact('shop'));

    }
}
