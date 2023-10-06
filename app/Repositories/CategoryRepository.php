<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function allCategory()
    {
        return Category::all();
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::find($id);
    }

    public function updateCategory($data, $id)
    {
       
    }

    public function destroyCategory($id)
    {
       
    }
}