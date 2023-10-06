<?php

namespace App\Repositories\Interfaces;

Interface ProducttypeInterface{
    public function allProducttype();
    public function storeProducttype($data);
    public function findProducttype($id);
    public function updateProducttype($data, $id); 
    public function destroyProducttype($id);
}


