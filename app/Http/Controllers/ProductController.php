<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\SubCategory;
use App\Models\Swap;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('userAuth:web')->except('home');
    }

    public function index()
    {
        $categories = Category::get(["name", "id"]);

        return view('product', compact('categories'));
    }

    public function fetchSubcategory(Request $request)
    {
        $categories['subcategory'] = Subcategory::where("category_id", $request->category_id)
            ->get(["name", "id"]);

        return response()->json($categories);
    }

    public function fetchProducttype(Request $request)
    {
        $categories['producttype'] = ProductType::where("subcategory_id", $request->subcategory_id)
            ->get(["name", "id"]);

        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $Images = [];
        if ($request->has('images')) {
            foreach ($request->images as $image) {

                $name = time() . rand(1, 100) . '.' . $image->extension();
                $path = public_path() . '/uploads/image';
                $image->move($path, $name);
                $Images[] = $name;
            }
            $product = new Product();
            $product->product_name = $data['product_name'];
            $product->description = $data['description'];
            $product->category_id = $data['category_id'];
            $product->subcategory_id = $data['subcategory_id'];
            $product->product_type_id = $data['product_type_id'];
            $product->price = $data['price'];
            $product->exchange_option = $data['exchange_option'];
            $product->image =  implode(',', $Images);
            $product->user_id = Auth::id();

            $product->save();
            if (Auth::id() === 1) {
                return redirect()->route('user.myproduct');
            } else {
                return redirect()->route('user.home');
            }
        }
    }
    public function productoffer($id)
    {
        $product = Product::findOrFail($id);

        $category = Category::find($product->category_id);
        $subcategory = SubCategory::find($product->subcategory_id);
        $productType = ProductType::find($product->product_type_id);
        return view('productoffer', compact('product', 'category', 'subcategory', 'productType'));
    }
    public function swapProduct(Request $request)
    {
        $mainId = $request->productId;
        $productId = $request->parentId;
        $user = auth()->user();


        $product = Product::findOrFail($productId);


        $swap = new Swap([
            'from_users_id' => $user->id,
            'from_product_id' => $mainId,
            'to_users_id' => $product->user_id,
            'to_product_id' => $product->id,
        ]);
        $swap->save();
        return response()->json(['message' => 'Product swapped successfully',]);
    }

    public function swap()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return response()->json($products);
    }
    public function home()
    {
        $product = Product::where('user_id', '!=', Auth::id())->get();
        return view('home', compact('product'));
    }

    public function myproduct()
    {

        $product = Product::where('user_id', Auth::id())->get();
        return view('myproduct', compact('product'));
    }
    public function acceptOrRejectSwap($id)
    {
        $status = request('status');
        $swap = Swap::find($id);

        if (!$swap) {
            return response()->json(['success' => false, 'message' => 'Swap not found.']);
        }

        $swap->status = ($status === 'accept') ? 'accepted' : 'rejected';
        $swap->save();

        $message = ($status === 'accept') ? 'Swap accepted successfully.' : 'Swap rejected successfully.';

        return response()->json(['success' => true, 'message' => $message]);
    }
}
