<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'description', 'category_id', 'subcategory_id', 'product_type_id', 'image','exchange_option', 
    ];
    
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id' );
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategory::class, 'subcategory_id', 'id' );
    }
    public function product_type_id()
    {
        return $this->belongsTo(product_type::class, 'product_type_id', 'id' );
    }
    public function getImageAttribute($image)
    {
        return asset('uploads/image/' . $image);
    }
}
