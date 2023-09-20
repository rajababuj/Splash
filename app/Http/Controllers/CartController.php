<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = auth()->user()->id;
        $productId = request('product_id');

        // dd($userId, $product);
        $existingCartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity++;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return response()->json('Product added successfully');
    }
    public function showCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        return view('cart', compact('cartItems'));
    }
}
