<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Interfaces\SwapInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Swap;
use Illuminate\Support\Facades\Auth;


class SwapController extends Controller
{
    protected $SwapRepository;

    public function __construct(SwapInterface $SwapRepository)
    {
        $this->SwapRepository = $SwapRepository;
    }
    public function View()
    {
        $Swap = $this->SwapRepository->allSwap();

        return response()->json([
            'status' => 'success',
            'message' => 'Swap view successfully!',
            'Swap' => $Swap,
        ]);
    }

    public function swapProduct(Request $request)
    { 
        // dd($request->all());
        $user_id = Auth::user()->id;
        $data = [
            'from_users_id' => $user_id, 
            'from_product_id' => $request->from_product_id,
            'to_users_id' => $request->to_users_id,
            'to_product_id' => $request->to_product_id,
        ];

        $this->SwapRepository->swapProduct($data);

        
        return response()->json(['message' => 'Product swapped successfully']);
    }
    
    
}
