<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        if (request()->ajax()) {
            $data = SubCategory::all();
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
        return view('admin.category.subcategory', compact('categories'));
    }

    public function create()
    {
    }

    public function store(SubCategoryRequest $request)
    {
        $existingSubCategory = SubCategory::where('name', $request->name)->first();
        if ($existingSubCategory) {
            return response()->json(['error' => 'SubCategory name already exists.'], 422); 
        }
        $form_data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
        ];

        SubCategory::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        return response()->json($subcategory);
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
        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->name = $request->name;
        $subcategory->Update();
        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function destroy($id)
    {
        $data = SubCategory::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
