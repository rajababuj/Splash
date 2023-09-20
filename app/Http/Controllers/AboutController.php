<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AboutController extends Controller
{

   public function index()
   {
      return view('about');
   }

   public function home()
   {
      $category = Category::all();
      return view('index', compact('category'));
   }

   public function cart()
   {
      return view('cart');
   }

   public function shop()
   {
      $category = Category::all();
      return view('shop', compact('category'));
   }
   public function product()
   {
      return view('product');
   }


   public function addInterest(Request $request)
   {
      $validatedData = $request->validate([
         'interest_id' => 'required',
      ]);
   
   
      return response()->json(['message' => 'Interest added successfully.']);
   }
   
   public function interests()
   {
      $category = Category::all();
      return view('interests', compact('category'));
   }






   public function contact()
   {
      return view('contact');
   }
   public function checkout()
   {
      return view('checkout');
   }
   public function thankyou()
   {
      return view('thankyou');
   }
}
