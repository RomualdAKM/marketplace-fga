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
        //dd($request->all());
        $user = Auth::user();
        
        $order = Order::create([
            //'user_id' => '1',
            'user_id' => $user->id,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);
    
        foreach ($request->items as $item) {
            $product = $item['product'];
            $productId = $product['id'];
            $basePrice = $product['base_price'];
            $quantity = $item['quantity'];
    
            // Vérifier si la quantité demandée est disponible
            $productModel = Product::find($productId);
            if ($productModel->stock < $quantity) {
                return response()->json(['success' => false, 'message' => "La quantité demandée pour le produit {$productModel->name} n'est pas disponible."], 400);
            }
    
            // Déduire la quantité du stock
            $productModel->stock -= $quantity;
            $productModel->save();

          // Vérifier si le stock a atteint le niveau d'alerte
            if ($productModel->stock_alert == $productModel->stock) {
                $admin = User::where('id', 1)->first(); 
                // $admin = User::where('role', 'admin')->first(); 
                Mail::to($admin->email)->send(new AdminAlertStockProductMail($productModel, $admin));
            }
    
            $optionsTotal = collect($item['selectedOptions'])->sum('additional_price');
            $price = $basePrice + $optionsTotal;
    
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
    
            foreach ($item['selectedOptions'] as $option) {
                OrderItemOption::create([
                    'order_item_id' => $orderItem->id,
                    'variation_option_id' => $option['id'],
                    'additional_price' => $option['additional_price'],
                ]);
            }
        }

        $deliveryDetail = new DeliveryDetail(); 
        $deliveryDetail->order_id = $order->id;
        $deliveryDetail->full_name = $request->fullName;
        $deliveryDetail->email = $request->email;
        $deliveryDetail->phone = $request->phone;
        $deliveryDetail->address = $request->address;
        $deliveryDetail->delivery_country_id = $request->country_id;
        $deliveryDetail->delivery_city_id = $request->city_id;
        $deliveryDetail->user_id = $user->id;
        $deliveryDetail->save();

        // Générer et envoyer la facture par e-mail
    $this->sendInvoice($order);

     // Envoyer une notification à l'admin
     $this->notifyAdmin($order);
    
        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    private function sendInvoice(Order $order)
    {
        $user = $order->user;
       // dd($user);
        $orderItems = $order->items()->with('product', 'options.variationOption')->get();
        $deliveryDetail = $order->deliveryDetail;
        $shop = Shop::first();
    
        $pdf = PDF::loadView('pdfs.invoice', [
            'order' => $order,
            'shop' => $shop,
            'user' => $user,
            'orderItems' => $orderItems,
            'deliveryDetail' => $deliveryDetail
        ]);
    
        $pdfContent = $pdf->output();
    
        Mail::to($user->email)
            ->send(new InvoiceMail($order, $pdfContent, $shop));

    }

    private function notifyAdmin(Order $order)
        {
            $admin = User::first();
            // $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Mail::to($admin->email)->send(new AdminOrderNotification($order));
            }
        }
    

    public function get_orders_auth_user()
    {
        $auth_user = Auth::user();
        $orders = Order::where('user_id',$auth_user->id)->get();

        return $orders;         
    }
    public function get_orders()
    {
      
        $orders = Order::all();

        return $orders;         
    }
    

    public function get_order($id)

    {

        $order = Order::where('id',$id)->with('items','items.options','items.options.variationOption','items.product','items.product.productimages','deliveryDetail','deliveryDetail.deliveryCity','deliveryDetail.deliveryCountry')->get();

        return $order;         
    }


}
