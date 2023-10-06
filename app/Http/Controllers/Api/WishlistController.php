<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WishlistInterface;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    protected $WishlistRepository;

    public function __construct(WishlistInterface $WishlistRepository)
    {
        $this->WishlistRepository = $WishlistRepository;
    }

    public function favorite()
    {
        $favorite = $this->WishlistRepository->allFavorite();

        return response()->json([
            'status' => 'success',
            'message' => 'Favorite view successfully!',
            'favorite' => $favorite,
        ]);
    }
    public function favoriteAdd(Request $request)
    {
        $user_id = Auth::user()->id;

        $data = [
            'user_id' => $user_id, 
            'product_id' => $request->product_id,
        ];

        $this->WishlistRepository->favoriteAdd($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Wishlist added successfully!',
        ]);
    }
}
