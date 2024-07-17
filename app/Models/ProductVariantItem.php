<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_variant_id',
        'price',
        'is_default',
        'status',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
