<?php

namespace App\Models;

use App\Models\Review;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function productimages():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function reviews():HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function productvariations():HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }
   
}
