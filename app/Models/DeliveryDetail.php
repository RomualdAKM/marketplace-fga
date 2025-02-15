<?php

namespace App\Models;

use App\Models\DeliveryCity;
use App\Models\DeliveryCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryDetail extends Model
{
    use HasFactory;

    public function deliveryCity()
    {
        return $this->belongsTo(DeliveryCity::class);
    }
    
    public function deliveryCountry()
    {
        return $this->belongsTo(DeliveryCountry::class);
    }
}
