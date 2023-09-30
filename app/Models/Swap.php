<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Swap extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_users_id',
        'from_product_id',
        'to_users_id',
        'to_product_id'
    ];

    public function fromProduct() : BelongsTo {
        return $this->belongsTo(Product::class, 'from_product_id');
    }

    public function toProduct() : BelongsTo {
        return $this->belongsTo(Product::class, 'to_product_id');
    }
    
  
}
