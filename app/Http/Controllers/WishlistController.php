<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Favorite;

class WishlistController extends Controller
{
    public function favoriteAdd($id)
    {
        $user = auth()->user();
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'This product is already in your favorites.'], 400);
        }

        $favorite = new Favorite([
            'user_id' => $user->id,
            'product_id' => $id,
        ]);

        $favorite->save();

        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();

        return response()->json(['sucess' => true, 'favorites' => $favorites], 200);

        
    }


    public function favoriteRemove($id)
    {
        $result = [
            'success' => false,
            'message' => 'Failed to remove from wishlist.',
        ];

        $favorite = Favorite::where([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
        ])->first();

        if ($favorite) {
            $favorite->delete();
            $result['success'] = true;
            $result['message'] = 'Successfully removed from wishlist.';
        }

        return response()->json($result);
    }
}
