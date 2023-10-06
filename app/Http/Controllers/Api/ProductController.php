<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductInterface $ProductRepository)
    {
        $this->productRepository = $ProductRepository;
    }

    public function myproduct()
    {

        $products = $this->productRepository->allmyproduct();

        return response()->json([
            'status' => 'success',
            'message' => 'product view successfully!',
            'product' => $products,
        ]);
    }

    public function home()
    {

        $products = $this->productRepository->home();

        return response()->json([
            'status' => 'success',
            'message' => 'home view successfully!',
            'product' => $products,

        ]);
    }
    public function index()
    {
        $products = $this->productRepository->index();

        return response()->json([
            'status' => 'success',
            'message' => 'index view successfully!',
            'product' => $products,
        ]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());

            $user_id = Auth::user()->id;
            $data = [
                'user_id' => $user_id,
                'product_name' =>  $request->product_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_type_id' => $request->product_type_id,
                'price' => $request->price,
                'exchange_option' => $request->exchange_option,
                'image' => $request->image,

            ];
            $this->productRepository->store($data);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully!'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'danger',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }
}
