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
       // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required',
            'stock' => 'required',
            'stock_alert' => 'required',
            'category_id' => 'required|string|max:255',
            // 'variations' => 'required|array',
            // 'variations.*.name' => 'required|string|max:255',
            // 'variations.*.options' => 'required|array',
            // 'variations.*.options.*.name' => 'required|string|max:255',
            // 'variations.*.options.*.additional_price' => 'required|numeric|min:0',
            'images' => 'required|array',
            'images.*' => 'image',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        // Créer le produit
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->base_price = $request->base_price;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->stock_alert = $request->stock_alert;
        $product->category_id = $request->category_id;
        $product->save();

        // Ajouter les variations et les options
        foreach ($request->variations as $variation) {
            $productVariation = new ProductVariation();
            $productVariation->product_id = $product->id;
            $productVariation->name = $variation['name'] ?? 'Aucune';
            $productVariation->save();

            foreach ($variation['options'] as $option) { 
                $variationOption = new ProductVariationOption();
                $variationOption->product_variation_id = $productVariation->id;
                $variationOption->name = $option['name'] ?? 'Aucune';
                $variationOption->additional_price = $option['additional_price'] ?? '0';
                $variationOption->save();
            }
        }

        // Gérer les images du produit
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                ]);
            }
        }

        $response = [
            'success' => true,
            'message' => 'Succès'
        ];

        return response()->json($response, 200);
    }
    public function update_product(Request $request,$id)
    {
    //dd($request->existing_images);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'status' => 'required',
            'stock' => 'required',
            'stock_alert' => 'required',
            'category_id' => 'required|string|max:255',
            // 'variations' => 'required|array',
            // 'variations.*.name' => 'required|string|max:255',
            // 'variations.*.options' => 'required|array',
            // 'variations.*.options.*.name' => 'required|string|max:255',
            // 'variations.*.options.*.additional_price' => 'required|numeric|min:0',
            'existing_images' => 'required|array',
            // 'existing_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        // Créer le produit
        $product =  Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->base_price = $request->base_price;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->stock_alert = $request->stock_alert;
        $product->category_id = $request->category_id;
        $product->save();

        // Ajouter les variations et les options
        // Récupère tout les variations du produit
        $productVariations = ProductVariation::where('product_id', $product->id)->get();

        // Supprime les variations qui ne sont plus dans la liste des variations existantes
        foreach ($productVariations as $productVariation) {
            if (!in_array($productVariation->id, array_column($request->variations, 'id'))) {
                $productVariation->delete();
            }
        }

        // Ajouter les nouvelles variations
        foreach ($request->variations as $variation) {
            if (isset($variation['id']) && ($productVariation = ProductVariation::find($variation['id']))) {
                $productVariation->name = $variation['name'] ?? 'Aucune';
                $productVariation->save();
            } else {
                $productVariation = ProductVariation::create([
                    'product_id' => $product->id,
                    'name' => $variation['name'] ?? 'Aucune',
                ]);
            }

            // Récupère tout les options de la variation
            $productVariationOptions = ProductVariationOption::where('product_variation_id', $productVariation->id)->get();

            // Supprime les options qui ne sont plus dans la liste des options existantes
            foreach ($productVariationOptions as $productVariationOption) {
                if (!in_array($productVariationOption->id, array_column($variation['options'], 'id'))) {
                    $productVariationOption->delete();
                }
            }

            // Ajouter les nouvelles options
            foreach ($variation['options'] as $option) { 
                if (isset($option['id']) && ($variationOption = ProductVariationOption::find($option['id']))) {
                    $variationOption->name = $option['name'] ?? 'Aucune';
                    $variationOption->additional_price = $option['additional_price'] ?? '0';
                    $variationOption->save();
                } else {
                    ProductVariationOption::create([
                        'product_variation_id' => $productVariation->id,
                        'name' => $option['name'] ?? 'Aucune',
                        'additional_price' => $option['additional_price'] ?? '0',
                    ]);
                }
            }
        }

      

        // Gérer les nouvelles images du produit
        // Récupère tout les images du produit
        $productImages = ProductImage::where('product_id', $product->id)->get();

        // Supprime les images qui ne sont plus dans la liste des images existantes
        foreach ($productImages as $productImage) {
            if (!in_array($productImage->image_url, $request->existing_images)) {
                $productImage->delete();
            }
        }

        // Ajoute les nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                ]);
            }
        }

        $response = [
            'success' => true,
            'message' => 'Succès'
        ];

        return response()->json($response, 200);
    }


    public function get_products() {

        $products = Product::with('category','productimages')->latest()->get();

        return  $products;
    }

    public function get_new_products() {

        $products = Product::where('status', 'true')->with('category', 'productimages','reviews','productvariations.productvariationoptions')
            ->latest()
            ->limit(8)
            ->get();

        return  $products;
    }
    
    public function get_all_products() {

        $products = Product::where('status', 'true')->with('category','reviews', 'productimages','productvariations.productvariationoptions')
            ->latest()
            ->get();

        return  $products;
    }


    public function delete_product($id) {

        $product = Product::find($id);
        
        $product->delete();
       
    }

    public function get_product($id) {

        $product = Product::where('id', $id)->with('category', 'productimages','reviews','productvariations','productvariations.productvariationoptions')
            ->first();

            // SEO::set('title', $product->name);
            // SEO::set('description', $product->description);
            // SEO::set('image', $product->image_url);

        return  $product;

    }
}
