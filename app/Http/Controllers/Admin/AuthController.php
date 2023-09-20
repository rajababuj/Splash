<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }


    public function postLogin(Request $request)
    {
        // dd(Auth::guard());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // $validated=Auth::guard('admin')->attempt([
        //     'email'=>$request->email,
        //     'password'=>$request->password,
        //     // 'is_admin'=>1
        // ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credential)) {
            return redirect()->route('dashboard')->with('success', 'Login Successfull');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        // if($validated){
        //     return redirect()->route('dashboard')->with('success','Login Successfull');
        // }else{
        //     return redirect()->back()->with('error','Invalid credentials');
        // }
    }
}
