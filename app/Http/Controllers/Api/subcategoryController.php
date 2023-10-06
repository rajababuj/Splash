<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SubcategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subcategoryController extends Controller
{
    protected $SubcategoryRepository;

    public function __construct(SubcategoryInterface $SubcategoryRepository)
    {
        $this->SubcategoryRepository = $SubcategoryRepository;
    }

    public function index()
    {
        $Subcategory = $this->SubcategoryRepository->allSubcategory();

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory view successfully!',
            'Subcategory' => $Subcategory,
        ]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required'
            ]);
            // dd($data);
            $this->SubcategoryRepository->storeSubcategory($data);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Subcategory added successfully!'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'danger',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->SubcategoryRepository->updateSubcategory($request->all(), $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory updated successfully!'
        ]);
    }
    public function destroy(string $id)
    {
        $this->SubcategoryRepository->destroySubcategory($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory deleted successfully!'
        ]);
    }
}
