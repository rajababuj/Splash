<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',  'image',
    ];

    
    public function getImageAttribute($image)
    {
        // Assuming the image is stored in the public folder under 'uploads/image'
        return asset('uploads/image/' . $image);
    }
}