<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProducttypeInterface;
use Illuminate\Support\Facades\DB;

class ProducttypeController extends Controller
{
    protected $ProducttypeRepository;

    public function __construct(ProducttypeInterface $ProducttypeRepository)
    {
        $this->ProducttypeRepository = $ProducttypeRepository;
    }

    public function index()
    {
        $Productype = $this->ProducttypeRepository->allProducttype();

        return response()->json([
            'status' => 'success',
            'message' => 'Producttype view successfully!',
            'productype' => $Productype,
        ]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'subcategory_id' => 'required'
            ]);
            $this->ProducttypeRepository-> storeProducttype($data);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Producttype added successfully!'
            ]);
        }catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'danger',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
       
    }
}
