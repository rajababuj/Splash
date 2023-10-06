<?php
namespace App\Repositories\Interfaces;

Interface CategoryInterface{
    
    public function allCategory();
    public function storeCategory($data);
    public function findCategory($id);
    public function updateCategory($data, $id); 
    public function destroyCategory($id);

}