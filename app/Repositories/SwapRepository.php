<?php

namespace App\Repositories;
use App\Repositories\Interfaces\SwapInterface;
use App\Models\Swap;

class SwapRepository implements SwapInterface
{

    public function allSwap()
    {
        return Swap::all();
    }

    public function swapProduct($data)
    {
        return Swap::create($data);
    }
}