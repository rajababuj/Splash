<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Yajra\Datatables\Datatables;
use App\Models\Producttype;
use App\Http\Requests\ProducttypeRequest;
use Illuminate\Support\Facades\Validator;

class ProducttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        if (request()->ajax()) {
            $data = Producttype::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc(' . $data->id . ')" data-original-title="Edit" class="edit btn btn-success">Edit</a>';
                    $button .= '<a href=javascript:void(0)" data-toggle="tooltip" onclick="deleteFunc(' . $data->id . ')" data-original-tittle="Delete" class="delete btn btn-danger">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.producttype', compact('subcategories'));
    }
    public function create()
    {
        //
    }


    public function store(ProducttypeRequest $request)
    {
        $existingProducttype = Producttype::where('name', $request->name)->first();
        if ($existingProducttype) {
            return response()->json(['error' => 'Producttype name already exists.'], 422); 
        }
        $form_data = [
            'name' => $request->name,
            'subcategory_id' => $request->subcategory_id,
        ];
        Producttype::create($form_data);
        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $producttype = Producttype::find($id);
        return response()->json($producttype);
    }
    public function update(Request $request)
    {
        $rules = array(
            'id' => 'required',
            'name' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $producttype = Producttype::findOrFail($request->id);
        $producttype->name = $request->name;
        $producttype->Update();
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function destroy($id)
    {
        $data = Producttype::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
