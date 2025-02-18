<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Mail\InvoiceMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\DeliveryDetail;
use App\Models\OrderItemOption;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\AdminOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminAlertStockProductMail;

class OrderController extends Controller
{
    public function store_order(Request $request)
    {
        $user = Auth::user();
        $shop = Shop::find($request->shop_id);

        if (!$shop) {
            return response()->json(['success' => false, 'message' => 'Boutique non trouvée'], 404);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $product = $item['product'];
            $productId = $product['id'];
            $basePrice = $product['base_price'];
            $quantity = $item['quantity'];

            $productModel = Product::where('id', $productId)
                                 ->where('shop_id', $shop->id)
                                 ->first();

            if (!$productModel) {
                return response()->json(['success' => false, 'message' => 'Produit non trouvé dans cette boutique'], 404);
            }

            if ($productModel->stock < $quantity) {
                return response()->json(['success' => false, 'message' => "La quantité demandée pour le produit {$productModel->name} n'est pas disponible."], 400);
            }

            $productModel->stock -= $quantity;
            $productModel->save();

            if ($productModel->stock_alert == $productModel->stock) {
                $shopAdmin = User::where('id', $shop->user_id)->first();
                Mail::to($shopAdmin->email)->send(new AdminAlertStockProductMail($productModel, $shopAdmin));
            }

            $optionsTotal = collect($item['selectedOptions'])->sum('additional_price');
            $price = $basePrice + $optionsTotal;

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'shop_id' => $shop->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);

            foreach ($item['selectedOptions'] as $option) {
                OrderItemOption::create([
                    'order_item_id' => $orderItem->id,
                    'shop_id' => $shop->id,
                    'variation_option_id' => $option['id'],
                    'additional_price' => $option['additional_price'],
                ]);
            }
        }

        $deliveryDetail = new DeliveryDetail();
        $deliveryDetail->order_id = $order->id;
        $deliveryDetail->shop_id = $shop->id;
        $deliveryDetail->full_name = $request->fullName;
        $deliveryDetail->email = $request->email;
        $deliveryDetail->phone = $request->phone;
        $deliveryDetail->address = $request->address;
        $deliveryDetail->delivery_country_id = $request->country_id;
        $deliveryDetail->delivery_city_id = $request->city_id;
        $deliveryDetail->user_id = $user->id;
        $deliveryDetail->save();

        $this->sendInvoice($order);
        $this->notifyAdmin($order);

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    private function sendInvoice(Order $order)
    {
        $user = $order->user;
        $orderItems = $order->items()->with('product', 'options.variationOption')->get();
        $deliveryDetail = $order->deliveryDetail;
        $shop = $order->shop;

        $pdf = PDF::loadView('pdfs.invoice', [
            'order' => $order,
            'shop' => $shop,
            'user' => $user,
            'orderItems' => $orderItems,
            'deliveryDetail' => $deliveryDetail
        ]);

        Mail::to($user->email)->send(new InvoiceMail($order, $pdf->output(), $shop));
    }

    private function notifyAdmin(Order $order)
    {
        $shopAdmin = User::find($order->shop->user_id);
        if ($shopAdmin) {
            Mail::to($shopAdmin->email)->send(new AdminOrderNotification($order));
        }
    }

    public function get_orders_auth_user()
    {
        $auth_user = Auth::user();
        return Order::where('user_id', $auth_user->id)->with('shop')->get();
    }

    public function get_orders()
    {
        $user = Auth::user();
        return Order::where('shop_id', $user->shop->id)->get();
    }

    public function get_order($id)
    {
        $user = Auth::user();
        return Order::where('id', $id)
                   ->where('shop_id', $user->shop->id)
                   ->with([
                       'items',
                       'items.options',
                       'items.options.variationOption',
                       'items.product',
                       'items.product.productimages',
                       'deliveryDetail',
                       'deliveryDetail.deliveryCity',
                       'deliveryDetail.deliveryCountry',
                       'shop'
                   ])
                   ->get();
    }


}
