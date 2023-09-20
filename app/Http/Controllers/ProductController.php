<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\SubCategory;
use Yajra\Datatables\Datatables;
use App\helpers\image;
use App\Http\Requests\ProductRequest;

// use function App\helpers\image;

class ProductController extends Controller
{
    public function index()
    {
        $product_types = ProductType::all();
        $subcategories = SubCategory::all();
        $categories = Category::all();
        return view('product', compact('categories', 'subcategories', 'product_types'));
    }

    public function getdata()
    {
        $products = Product::all();
        // $products = Product::select(['id', 'product_name', 'description', 'category_id', 'subcategory_id', 'product_type_id', 'exchange_option']);

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<a href="#" class="btn btn-xs btn-primary edit" id="' . $product->id . '"><i class="bi bi-pencil-square"></i> Edit</a> <a href="#" class="btn btn-xs btn-danger delete" id="' . $product->id . '"><i class="bi bi-backspace-reverse-fill"></i> Delete</a>';
            })
            ->editColumn('category_id',  function ($data) {
                return optional($data->category)->name;
            })
            ->editColumn('subcategory_id',  function ($data) {
                return optional($data->subcategory)->name;
            })
            ->editColumn('product_type_id',  function ($data) {
                return optional($data->product_type_id)->name;
            })
            ->addColumn('checkbox', '<input type="checkbox" name="product_checkbox[]" class="product_checkbox" value="{{$id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }

    public function store(ProductRequest $request)
    {
        $imageUrl = image($request);

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->product_type_id = $request->input('product_type_id');
        $product->exchange_option = $request->input('exchange_option');
        $product->image = $imageUrl;

        $product->save();

        return response()->json(['message' => 'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
