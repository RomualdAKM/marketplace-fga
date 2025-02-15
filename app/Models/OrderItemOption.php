<?php

namespace App\Models;

use App\Models\ProductVariationOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItemOption extends Model
{
    use HasFactory;

    protected $fillable = ['order_item_id', 'variation_option_id', 'additional_price'];


    public function variationOption()
    {
        return $this->belongsTo(ProductVariationOption::class, 'variation_option_id');
    }

}
