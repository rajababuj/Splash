<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{

    public function allmyproduct()
    {
        return Product::all();
    }
    public function home()
    {
        return Product::all();
    }
    public function index()
    {
        return Product::all();
    }
    public function store($data)
    {
        return Product::create($data);
    }

}