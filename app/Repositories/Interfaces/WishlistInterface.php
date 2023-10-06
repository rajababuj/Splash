<?php
namespace App\Repositories\Interfaces;

Interface WishlistInterface{
    
    public function allfavorite();
    public function favoriteAdd($id);
    public function destroyfavoriteRemove($id);

}