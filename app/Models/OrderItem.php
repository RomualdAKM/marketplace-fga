<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItemOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];


    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function options()
    {
        return $this->hasMany(OrderItemOption::class);
    }
    

    public function getOrderItemOptionNameAttribute()
    {
        return $this->product->name;
    }

   
}
