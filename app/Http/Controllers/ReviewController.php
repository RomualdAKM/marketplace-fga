<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function get_reviews($productId){
       // dd($productId);
        $reviews = Review::where('product_id', $productId)->get();

        return $reviews;
    }
    public function get_all_reviews(){
      
        $reviews = Review::with('product')->get();

        return $reviews;
    }

    public function store_review(Request $request){

        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',  
            'email' => 'required',  
            'username' => 'required',  
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
    
        $review = new Review();
        $review->product_id =  $request->product_id['productId'];
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->email = $request->email;
        $review->username = $request->username;
   
        $review->save();
    
        $response = [
            'success' => true,
            'message' => 'Succés'
        ];    
    
        return response()->json(
            $response,
            200
        );
       }
}
