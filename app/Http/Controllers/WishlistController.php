<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function add_wishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'shopId' => 'required',
        ]);
    
        if ($validator->fails() || !Auth::user()) {
            return response()->json([
                'success' => false,
                'message' => $validator->fails() ? $validator->errors() : 'User not authenticated'
            ], 400);
        }
      
        $user = Auth::user();
        
        // Check if wishlist already exists
        $existingWishlist = Wishlist::where('product_id', $request->productId)
            ->where('user_id', $user->id)
            ->where('shop_id', $request->shopId)
            ->first();

        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist'
            ], 400);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->productId;
        $wishlist->user_id = $user->id;
        $wishlist->shop_id = $request->shopId;
        $wishlist->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Successfully added to wishlist'
        ], 200);
    }

    public function get_wishlists(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $query = Wishlist::where('user_id', Auth::user()->id)
            ->with(['product', 'product.productimages', 'shop']);

        // Filter by shop if shopId is provided
        if ($request->has('shopId')) {
            $query->where('shop_id', $request->shopId);
        }

        $wishlists = $query->get();

        return response()->json([
            'success' => true,
            'data' => $wishlists
        ], 200);
    }

    public function remove_wishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'shopId' => 'required',
        ]);

        if ($validator->fails() || !Auth::user()) {
            return response()->json([
                'success' => false,
                'message' => $validator->fails() ? $validator->errors() : 'User not authenticated'
            ], 400);
        }

        $deleted = Wishlist::where('product_id', $request->productId)
            ->where('user_id', Auth::user()->id)
            ->where('shop_id', $request->shopId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully removed from wishlist'
        ], 200);
    }
}
