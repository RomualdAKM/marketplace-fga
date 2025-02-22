<?php

namespace App\Models;

use App\Models\DeliveryCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryCity extends Model
{
    use HasFactory;

    public function country():BelongsTo
    {
        return $this->belongsTo(DeliveryCountry::class, 'delivery_country_id');
    }
}
