<?php

namespace App\helpers;

use Illuminate\Http\Request;


function imageUpload(Request $request)
{
    if ($request->hasFile('image')) {
        $ext = $request->file('image')->extension();
        $imageName = date('YmdHis') . '.' . $ext;
        $request->file('image')->move(public_path('uploads/image/'), $imageName);
        $imageUrl = $imageName;
        return $imageUrl;
    }

    return null;
    function image(Request $request)
    {
        if ($request->hasFile('image')) {
            $ext = $request->file('image')->extension();
            $imageName = date('YmdHis') . '.' . $ext;
            $request->file('image')->move(public_path('uploads/image/'), $imageName);
            $imageUrl = $imageName;
            return $imageUrl;
        }
    
        return null;
    }
}
