<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;


use function App\helpers\imageUpload;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            // return datatables()->of(Category::select('*'))
            $data = Category::all();
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
        return view('admin.category.category');
    }

    public function store(CategoryRequest $request)
    {
        $existingCategory = Category::where('name', $request->name)->first();
        if ($existingCategory) {
            return response()->json(['error' => 'Category name already exists.'], 422);
        }

        $request->validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = imageUpload($request);
        if ($image) {
            $form_data = [
                'name' => $request->name,
                'image' => $image,
            ];

            Category::create($form_data);
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['error' => 'Image upload failed.'], 500);
        }
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/i',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path('uploads/image/') . $category->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = imageUpload($request);
            if ($image) {
                $category->image = $image;
            }
        }
        $category->save();
        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function destroy($id)
    {
        $data = Category::find($id);
        $imagePath = public_path('uploads/image/' . $data->getRawOriginal('image'));
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
