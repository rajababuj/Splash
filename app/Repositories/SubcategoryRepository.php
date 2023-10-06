<?php

namespace App\Repositories;
use App\Repositories\Interfaces\SubcategoryInterface;
use App\Models\Subcategory;

class SubcategoryRepository implements SubcategoryInterface
{

    public function allSubcategory()
    {
        return SubCategory::all();
    }

    public function storeSubcategory($data)
    {
        return Subcategory::create($data);
    }

    public function findSubcategory($id)
    {
        return Subcategory::find($id);
    }

    public function updateSubcategory($data, $id)
    {
       
    }

    public function destroySubcategory($id)
    {
       
    }
}