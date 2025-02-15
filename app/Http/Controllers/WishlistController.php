<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function add_wishlist(Request $request){

      //dd($request->all());

        $validator = Validator::make($request->all(), [
            'productId' => 'required',
        ]);
    
        if ($validator->fails() && Auth::user()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,
                200
            );
        }
      
        $user = Auth::user();
        
        $wishlist = new Wishlist();
        $wishlist->product_id =  $request->productId;
        $wishlist->user_id = $user->id;
        $wishlist->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }

       public function get_wishlists(){

        $wishlists = Wishlist::where('user_id', Auth::user()->id)->with('product','product.productimages')->get();

        return $wishlists;
       }
}
