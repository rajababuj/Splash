<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Favorite;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function favorite()
    {
        $user = auth()->user();
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();
        
        return view('wishlist', compact('favorites'));
    }
    
    // public function favoriteAdd(Request $request){

    //     $favorite = new Favorite();
    //     $favorite->user_id = Auth::user()->id;
    //     $favorite->product_id = $request->input('product_id');
    //     $favorite->save();
    //     return response()->json(['success' => true], 200);
    // }
    
    public function favoriteAdd(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingFavorite) {
         
            $existingFavorite->delete();
            return response()->json(['success' => true, 'message' => 'Removed from Wishlist'], 200);
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->product_id = $productId;
            $favorite->save();
            return response()->json(['success' => true, 'message' => 'Added to Wishlist successfully'], 200);
        }
    }
    
    // public function favoriteRemove($id)
    // {
    //     $result = [
    //         'success' => false,
    //         'message' => 'Failed to remove from wishlist.',
    //     ];

    //     $favorite = Favorite::where([
    //         'user_id' => auth()->user()->id,
    //         'product_id' => $id,
    //     ])->first();

    //     if ($favorite) {
    //         $favorite->delete();
    //         $result['success'] = true;
    //         $result['message'] = 'Successfully removed from wishlist.';
    //     }

    //     return response()->json($result);
    // }
    
}
