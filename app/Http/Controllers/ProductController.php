<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\ProductVariationOption;
use Illuminate\Support\Facades\Validator;
use ArchTech\SEO\SEO;

class ProductController extends Controller
{
    public function add_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required',
            'stock' => 'required',
            'stock_alert' => 'required',
            'category_id' => 'required|string|max:255',
            'shop_id' => 'required|exists:shops,id',
            'images' => 'required|array',
            'images.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        // Verify user owns the shop
        $shop = Shop::findOrFail($request->shop_id);
        if ($shop->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to this shop'
            ], 403);
        }

        // Create product
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->base_price = $request->base_price;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->stock_alert = $request->stock_alert;
        $product->category_id = $request->category_id;
        $product->shop_id = $request->shop_id;
        $product->save();

        // Add variations and options
        if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                $productVariation = ProductVariation::create([
                    'product_id' => $product->id,
                    'name' => $variation['name'] ?? 'Aucune',
                    'shop_id' => $request->shop_id
                ]);

                foreach ($variation['options'] as $option) {
                    ProductVariationOption::create([
                        'product_variation_id' => $productVariation->id,
                        'name' => $option['name'] ?? 'Aucune',
                        'additional_price' => $option['additional_price'] ?? '0',
                        'shop_id' => $request->shop_id
                    ]);
                }
            }
        }

        // Handle product images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("shops/{$shop->id}/products", 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'shop_id' => $request->shop_id
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté avec succès'
        ], 200);
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check if user owns the shop
        if ($product->shop->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required',
            'stock' => 'required',
            'stock_alert' => 'required',
            'category_id' => 'required|string|max:255',
            'existing_images' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'status' => $request->status,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert,
            'category_id' => $request->category_id
        ]);

        // Handle variations
        if ($request->has('variations')) {
            $product->productvariations()->whereNotIn('id', 
                collect($request->variations)->pluck('id')->filter()
            )->delete();

            foreach ($request->variations as $variation) {
                $productVariation = ProductVariation::updateOrCreate(
                    [
                        'id' => $variation['id'] ?? null,
                        'product_id' => $product->id
                    ],
                    [
                        'name' => $variation['name'] ?? 'Aucune',
                        'shop_id' => $product->shop_id
                    ]
                );

                if (isset($variation['options'])) {
                    $productVariation->productvariationoptions()->whereNotIn('id',
                        collect($variation['options'])->pluck('id')->filter()
                    )->delete();

                    foreach ($variation['options'] as $option) {
                        ProductVariationOption::updateOrCreate(
                            [
                                'id' => $option['id'] ?? null,
                                'product_variation_id' => $productVariation->id
                            ],
                            [
                                'name' => $option['name'] ?? 'Aucune',
                                'additional_price' => $option['additional_price'] ?? '0',
                                'shop_id' => $product->shop_id
                            ]
                        );
                    }
                }
            }
        }

        // Handle images
        $product->productimages()->whereNotIn('image_url', $request->existing_images)->delete();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("shops/{$product->shop_id}/products", 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'shop_id' => $product->shop_id
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit mis à jour avec succès'
        ], 200);
    }

    public function get_products()
    {
        // If admin, get all products, else get only shop products
        if (auth()->user()->isAdmin()) {
            $products = Product::with(['category', 'productimages', 'shop'])->latest()->get();
        } else {
            $products = Product::whereIn('shop_id', auth()->user()->shops->pluck('id'))
                ->with(['category', 'productimages', 'shop'])
                ->latest()
                ->get();
        }
        return $products;
    }

    public function get_new_products()
    {
        return Product::where('status', 'true')
            ->with(['category', 'productimages', 'reviews', 'productvariations.productvariationoptions', 'shop'])
            ->latest()
            ->limit(8)
            ->get();
    }

    public function get_all_products()
    {
        return Product::where('status', 'true')
            ->with(['category', 'reviews', 'productimages', 'productvariations.productvariationoptions', 'shop'])
            ->latest()
            ->get();
    }

    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        
        // Check if user owns the shop
        if ($product->shop->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Produit supprimé avec succès'
        ], 200);
    }

    public function get_product($id)
    {
        $product = Product::where('id', $id)
            ->with(['category', 'productimages', 'reviews', 'productvariations.productvariationoptions', 'shop'])
            ->firstOrFail();

        return $product;
    }
}
