<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function get_reviews($productId, $shopId){
        $reviews = Review::where('product_id', $productId)
                        ->where('shop_id', $shopId)
                        ->get();
        return $reviews;
    }

    public function get_all_reviews($shopId = null){
        $query = Review::with(['product', 'shop']);
        
        if ($shopId) {
            $query->where('shop_id', $shopId);
        }
        
        return $query->get();
    }

    public function store_review(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'shop_id' => 'required',
            'comment' => 'required',
            'rating' => 'required|numeric|min:1|max:5',  
            'email' => 'required|email',  
            'username' => 'required',  
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }
    
        $review = new Review();
        $review->product_id = $request->product_id['productId'];
        $review->shop_id = $request->shop_id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->email = $request->email;
        $review->username = $request->username;
   
        $review->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Review added successfully',
            'data' => $review
        ], 201);
    }

    public function get_shop_rating($shopId){
        $average = Review::where('shop_id', $shopId)
                        ->avg('rating');
        
        return response()->json([
            'success' => true,
            'average_rating' => round($average, 2),
            'shop_id' => $shopId
        ]);
    }
}
