<?php

namespace App\Models;

use App\Models\ProductVariationOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;
    

    protected $guarded = [];

    public function productvariationoptions():HasMany
    {
        return $this->hasMany(ProductVariationOption::class);
    }
}
