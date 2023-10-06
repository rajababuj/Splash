<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
      
        $categories = $this->categoryRepository->allCategory();

        return response()->json([
            'status' => 'success',
            'message' => 'Categories view successfully!',
            'categories' => $categories,
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required',
            ]);
            $this->categoryRepository->storeCategory($data);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Category added successfully!',
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
