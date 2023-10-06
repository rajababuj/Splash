<?php
namespace App\Repositories\Interfaces;

Interface SubcategoryInterface{
    
    public function allSubcategory();
    public function storeSubcategory($data);
    public function findSubcategory($id);
    public function updateSubcategory($data, $id); 
    public function destroySubcategory($id);

}