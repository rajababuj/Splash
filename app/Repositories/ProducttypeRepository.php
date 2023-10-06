<?php

namespace App\Repositories;
use App\Repositories\Interfaces\ProducttypeInterface;
use App\Models\ProductType;

class ProducttypeRepository implements ProducttypeInterface
{

    public function allProducttype()
    {
        return Producttype::all();
    }

    public function storeProducttype($data)
    {
        return Producttype::create($data);
    }

    public function  findProducttype($id)
    {
        return Producttype::find($id);
    }

    public function updateProducttype($data, $id)
    {
       
    }

    public function  destroyProducttype($id)
    {
       
    }
}