<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\DeliveryDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'total_price', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryDetail()
    {
        return $this->hasOne(DeliveryDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    


}
