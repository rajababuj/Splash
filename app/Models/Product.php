<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'description', 'category_id', 'subcategory_id', 'product_type_id', 'image', 'price','exchange_option','user_id', 
    ];
    public function getImageAttribute($image)
    {
        $data=explode(',',$image);
        $arr=[];
        foreach($data as $image){
            array_push($arr,asset('uploads/image/' . $image));
        }
        return $arr;
    }
}
