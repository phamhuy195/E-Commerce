<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'name',
        'slug',
        'sku',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'quantity',
        'description',
        'discount_price',
        'offer_start_date',
        'offer_end_date',
        'details',
        'product_type',
        'price',
        'is_top',
        'is_best',
        'is_featured',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productImageGalleries()
    {
        return $this->hasMany(ProductImageGallery::class);
    }


}
