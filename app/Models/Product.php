<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'cross_price',
        'desc',
        'brand_id',
        'category_id',
        'sub_cat_id',
        'status',
        'stock',
        
    ];

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,"carts");
    }
}
