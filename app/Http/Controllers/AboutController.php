<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Swap;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AboutController extends Controller
{

   public function index()
   {
      return view('about');
   }
   // public function view()
   // {
   //    if (Auth::check()) {
   //       return redirect()->route('user.home'); 
   //    }
   //    $check = Swap::where('to_users_id', Auth::id())->with(['fromProduct', 'toProduct'])->get();
   //    return view('swap', compact('check'));
   // }

   public function view()
   {

      $user_id = Auth()->user()->id;

      $check = Swap::with(['fromProduct', 'toProduct'])->where('from_users_id', $user_id)->get();
      return view('swap', compact('check'));
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


   public function cart()
   {
      return view('cart');
   }



   public function checkout()
   {
      return view('checkout');
   }
   public function thankyou()
   {
      return view('thankyou');
   }


   public function removeData(Request $request, $id)
   {

      $swap = Swap::find($id);
      if ($swap) {
         $swap->delete();
         return response()->json(['message' => 'Data deleted successfully.']);
      } else {
         return response()->json(['message' => 'Failed to delete data.'], 400);
      }
   }
}
