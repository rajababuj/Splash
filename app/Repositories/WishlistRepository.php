<?php

namespace App\Repositories;
use App\Repositories\Interfaces\CategoryInterface;
use App\Models\Favorite;
use App\Repositories\Interfaces\WishlistInterface;

class WishlistRepository implements WishlistInterface
{

    public function allfavorite()
    {
        return Favorite::all();
    }

    public function favoriteAdd($data)
    {
        return Favorite::create($data);
    }

    

    public function destroyfavoriteRemove($id)
    {
       
    }
}